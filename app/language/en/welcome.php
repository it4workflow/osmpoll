<?php

return array(

  // Alerts
  'login_required' => 'Login required!',

	// Buttons
	'login' => 'Sign on',

  // Intros
  'how_title' => 'How to sign in?',
  'how_description' => '<p>Simply with your <a href="http://www.openstreetmap.org">OpenStreetMap <span class="glyphicon glyphicon-new-window"></span></a>-account over <a href="http://en.wikipedia.org/wiki/OAuth">OAuth <span class="glyphicon glyphicon-new-window"></span></a>.</p>',

  'why_title' => 'Why sign in?',
  'why_description' => 'To ensure that each answer a survey or question only once.',

  'which_title' => 'What data will be used?',
  'which_description' => 'Nach erfolgreicher Anmeldung bei OpenStreetMap wird eine <a href="http://api.openstreetmap.org/api/0.6/user/details">User-Details Anfrage <span class="glyphicon glyphicon-new-window"></span></a> durchgeführt, und folgende Daten genutzt:
          <ul>
            <li>id: für die Eindeutigkeit <sup>1</sup></li>
            <li>display_name: für die persönliche Begrüßung <sup>2</sup></li>
            <li>changesets: für die Auswertung nach Erfahrung <sup>1, </sup><sup>3</sup></li>
            <li>account_created: für die Auswertung nach Erfahrung <sup>1, </sup><sup>3</sup></li>
          </ul>
          <sup>1</sup> will be saved
          <sup>2</sup> wird nur angezeigt
          <sup>3</sup> kann nur als Annäherungswert in Relation gesehen werden',
);
