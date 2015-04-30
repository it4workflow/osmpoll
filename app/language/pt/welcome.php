<?php

return array(

  // Alerts
  'login_required' => 'Autenticação requerida!',

	// Buttons
	'login' => 'Entrar',

  // Intros
  'how_title' => 'Como logar?',
  'how_description' => '<p>Simplesmente autentique-se com sua conta do <a href="http://www.openstreetmap.org">OpenStreetMap<span class="glyphicon glyphicon-new-window"></span></a> usando <a href="http://en.wikipedia.org/wiki/OAuth">OAuth<span class="glyphicon glyphicon-new-window"></span></a>.</p>',

  'why_title' => 'Por que autenticar-se?',
  'why_description' => 'Nós precisamos que todos se autentiquem, para podermos minimamente garantir que cada um só participe uma vez de cada enquete.',

  'which_title' => 'Quais dados serão usados?',
  'which_description' => 'Depois de uma autenticação bem sucedida no site do OpenStreetMap, este sistema conhecerá os seus <a href="http://api.openstreetmap.org/api/0.6/user/details">detalhes de usuário<span class="glyphicon glyphicon-new-window"></span></a> e, dentre eles, usará os seguintes:
          <ul>
            <li>id: para identificar você unicamente <sup>1</sup></li>
            <li>display_name: para saudar você <sup>2</sup></li>
            <li>changesets: para sinalizar sua experiência como mapeador <sup>1, </sup><sup>3</sup></li>
            <li>account_created: entre outras coisas, para avaliar sua experiência <sup>1, </sup><sup>3</sup></li>
          </ul>
          <sup>1</sup> será salvo
          <sup>2</sup> somente será exibido em tela, não será salvo
          <sup>3</sup> é apenas um indicador bruto',
);
