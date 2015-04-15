<?php

return array(

  // Alerts
  'login_required' => 'Anmeldung erforderlich!',

	// Buttons
	'login' => 'Anmelden',

  // Intros
  'how_title' => 'Wie melde ich mich an?',
  'how_description' => '<p>Ganz einfach mit dem vorhandenen <a href="http://www.openstreetmap.org">OpenStreetMap <span class="glyphicon glyphicon-new-window"></span></a>-Account per <a href="http://en.wikipedia.org/wiki/OAuth">OAuth <span class="glyphicon glyphicon-new-window"></span></a>.</p>',

  'why_title' => 'Warum eine Anmeldung?',
  'why_description' => 'Um sicherzustellen, dass jeder auch nur einmal eine Umfrage beantwortet.',

  'which_title' => 'Welche Daten werden genutzt?',
  'which_description' => 'Nach erfolgreicher Anmeldung bei OpenStreetMap wird eine <a href="http://api.openstreetmap.org/api/0.6/user/details">User-Details Anfrage <span class="glyphicon glyphicon-new-window"></span></a> durchgeführt, und folgende Daten genutzt:
          <ul>
            <li>id: für die Eindeutigkeit <sup>1</sup></li>
            <li>display_name: für die persönliche Begrüßung <sup>2</sup></li>
            <li>changesets: für die Auswertung nach Erfahrung <sup>1, </sup><sup>3</sup></li>
            <li>account_created: für die Auswertung nach Erfahrung <sup>1, </sup><sup>3</sup></li>
          </ul>
          <sup>1</sup> wird gespeichert
          <sup>2</sup> wird nur angezeigt
          <sup>3</sup> kann nur als Annäherungswert in Relation gesehen werden',
  
);
