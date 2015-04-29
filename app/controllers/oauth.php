<?php namespace controllers;

require_once(__DIR__.'/../helpers/oauth/library/OAuthStore.php');
require_once(__DIR__.'/../helpers/oauth/library/OAuthRequester.php');
use OAuthStore,
    OAuthRequester,
    OAuthException2,
    DateTime,
    \helpers\session,
    \helpers\url;

/*
 * @author David Carr - dave@daveismyname.com - http://www.daveismyname.com
 * @version 2.1
 * @date June 27, 2014
 */
class OAuth extends \core\controller{

  private $config;

	public function __construct(){
		parent::__construct();
    
    require_once(__DIR__.'/../core/oauth-config.php');
    $this->config = $config;

    $store = OAuthStore::instance("MySQL", $this->config );
    $servers = $store->listServers(null, session_id());
    if(sizeof($servers)<1){
      $store->updateServer($this->config, session_id());
    }

	}

	public function authorize() {
    $request_token_info = OAuthRequester::requestRequestToken($this->config['consumer_key'], session_id());
		header('Location: '.$this->config['authorize_uri']."?oauth_token=".$request_token_info['token']);
    exit;
	}

  public function callback() {
    if(isset($_GET['oauth_token'])) {
      try {
        OAuthRequester::requestAccessToken($this->config['consumer_key'], $_GET['oauth_token'], session_id());
        $this->getUserDetails();
        $redirect=session::get('referer');
        \helpers\url::redirect($redirect);
      } catch(OAuthException2 $E) {
        echo("<pre>Exception:\n");
        var_dump($E);
        echo '</pre>';
      }
      
    } else {
       exit("Error! There is no OAuth token!");
    }
    exit(1);	
  }
  
  public function getUserDetails() {
    try {
        $params = array();
        $user_details_request = new OAuthRequester($this->config['server_uri'], 'GET', $params);
        $user_details = $user_details_request->doRequest(session_id());

        $xml = simplexml_load_string($user_details['body']);
        session::set('osm_user_id',strval($xml->user['id']));
        session::set('osm_user_display_name', strval($xml->user['display_name']));
        session::set('osm_user_changesets', intval($xml->user->changesets['count']));
        session::set('osm_user_account_created', strval($xml->user['account_created']));
        session::set('lastcheck', new DateTime('now'));
        $availableLanguages = unserialize(LANGUAGES);
        foreach($xml->user->languages->lang as $isocode){
          if(preg_match('/^[a-z]{2}$/',strval($isocode)) && array_key_exists(strval($isocode), $availableLanguages)) {
            session::set('language', strval($isocode));
            break;
          }
        }
        session::set('logged_in', true);
    } catch(OAuthException2 $E) {
        if ($E->getCode()==401 || $E->getCode()==-1) {
            $main = new \controllers\main();
            $main->logout();
        } else {
            echo("<pre>Exception:\n");
            var_dump($E);
            echo '</pre>';
        }
    }
  }

  public function updateUserDetails() {
    try {
        $lastcheck = session::get('lastcheck');
        if(!$lastcheck || $lastcheck->diff(new DateTime("now")) > 3600){
          $user_details_request = new OAuthRequester($this->config['server_uri'], 'GET', array());
          $user_details = $user_details_request->doRequest(session_id());

          $xml = simplexml_load_string($user_details['body']);
          session::set('osm_user_display_name', strval($xml->user['display_name']));
          session::set('osm_user_changesets', intval($xml->user->changesets['count']));
          session::set('lastcheck', new DateTime('now'));
        }
    } catch(OAuthException2 $E) {
        if ($E->getCode()==401 || $E->getCode()==-1) {
            $main = new \controllers\main();
            $main->logout();
        } else {
            echo("<pre>Exception:\n");
            var_dump($E);
            echo '</pre>';
        }
    }
  }  
  
}
