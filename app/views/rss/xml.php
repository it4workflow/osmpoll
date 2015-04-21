<?php
header('Content-Type: application/rss+xml; charset=UTF-8');
echo '<?xml version="1.0" encoding="UTF-8"?>'
?>

<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom" xmlns:dc="http://purl.org/dc/elements/1.1/">
 
  <channel>
    <atom:link href="http://osm.haraldhartmann.de/umfrage/rss" rel="self" type="application/rss+xml" />
    <title><?=htmlspecialchars(core\language::show('title','rss'), ENT_COMPAT|ENT_XML1) ?></title>
    <link>http://osm.haraldhartmann.de/umfrage/</link>
    <description><?=htmlspecialchars(core\language::show('description','rss'), ENT_COMPAT|ENT_XML1) ?></description>
    <language>de-de</language>
    <copyright>Harald Hartmann, osm@haraldhartmann.de</copyright>
    <ttl>60</ttl>
    <pubDate><?php $date = new DateTime(); echo $date->format(DateTime::RSS);?></pubDate>
    <!--
    <image>
      <url>URL einer einzubindenden Grafik</url>
      <title>Bildtitel</title>
      <link>URL, mit der das Bild verknüpft ist</link>
    </image>
    -->
    <?php foreach ($data['polls'] as $poll) { ?>
    <item>
      <title><?=htmlspecialchars($poll['poll']->frage, ENT_COMPAT|ENT_XML1) ?></title>
      <description>
        <?=htmlspecialchars($poll['poll']->description, ENT_COMPAT|ENT_XML1) ?>
        &lt;ul&gt;
        <?php foreach ($poll['answers'] as $answer ) {
          echo htmlspecialchars('<li><strong>'.$answer->antwort.'</strong> '.$answer->description.'</li>', ENT_COMPAT|ENT_XML1);
        } ?>
        &lt;/ul&gt;
      </description>
      <link>http://osm.haraldhartmann.de/umfrage/poll/<?=$poll['poll']->id?></link>
      <dc:creator><?=htmlspecialchars($poll['poll']->created_by, ENT_COMPAT|ENT_XML1) ?></dc:creator>
      <guid>http://osm.haraldhartmann.de/umfrage/poll/<?=$poll['poll']->id?></guid>
      <pubDate><?php $date = new DateTime($poll['poll']->startdate); echo $date->format(DateTime::RSS); ?></pubDate>
    </item>
    <?php } ?>
  </channel>
</rss>
