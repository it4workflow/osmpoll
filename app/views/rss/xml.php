<?='<?xml version="1.0" encoding="utf-8"?>'?>

<rss version="2.0">
 
  <channel>
    <title><?=htmlspecialchars(core\language::show('title','rss'), ENT_COMPAT|ENT_XML1) ?></title>
    <link>http://osm.haraldhartmann.de/umfrage/</link>
    <description><?=htmlspecialchars(core\language::show('description','rss'), ENT_COMPAT|ENT_XML1) ?></description>
    <language>de-de</language>
    <copyright>Harald Hartmann &lt;osm@haraldhartmann.de&gt;</copyright>
    <pubDate><?php $date = new DateTime(); echo $date->format(DateTime::RFC822);?></pubDate>
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
        &lt;ul&gt;
        <?php foreach ($poll['answers'] as $answer ) {
          echo htmlspecialchars('<li><strong>'.$answer->antwort.'</strong> '.$answer->description.'</li>', ENT_COMPAT|ENT_XML1);
        } ?>
        &lt;/ul&gt;
      </description>
      <link>http://osm.haraldhartmann.de/umfrage/poll/<?=$poll['poll']->id?></link>
      <author><?=htmlspecialchars($poll['poll']->created_by, ENT_COMPAT|ENT_XML1) ?></author>
      <guid><?=$poll['poll']->id?></guid>
      <pubDate><?php $date = new DateTime($poll['poll']->startdate); echo $date->format(DateTime::RFC822); ?></pubDate>
    </item>
    <?php } ?>
  </channel>
</rss>
