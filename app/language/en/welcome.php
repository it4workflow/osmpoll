<?php

return array(

  // Alerts
  'login_required' => 'Login required!',

	// Buttons
	'login' => 'Sign on',

  // Intros
  'how_title' => 'How to sign in?',
  'how_description' => '<p>Sign in simply with your <a href="http://www.openstreetmap.org">OpenStreetMap<span class="glyphicon glyphicon-new-window"></span></a> account using <a href="http://en.wikipedia.org/wiki/OAuth">OAuth <span class="glyphicon glyphicon-new-window"></span></a>.</p>',

  'why_title' => 'Why sign in?',
  'why_description' => 'We request that people log in so that everyone can participate in each poll only once.',

  'which_title' => 'What data will be used?',
  'which_description' => 'After a successful OpenStreetMap login, this platform will execute a <a href="http://api.openstreetmap.org/api/0.6/user/details">user details <span class="glyphicon glyphicon-new-window"></span></a> request, and use the folloing:
          <ul>
            <li>id: for uniqueness <sup>1</sup></li>
            <li>display_name: for a personal greeting <sup>2</sup></li>
            <li>changesets: for a rough classification of user experience <sup>1, </sup><sup>3</sup></li>
            <li>account_created: also to judge user experience <sup>1, </sup><sup>3</sup></li>
          </ul>
          <sup>1</sup> will be saved
          <sup>2</sup> only shown, not saved
          <sup>3</sup> only a rough indicator of course',
);
