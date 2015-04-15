
  <div class="container">
    <a href="#top" class="glyphicon glyphicon-chevron-up pull-right"></a>
    <hr>    
  </div>

  <footer class="container">
    © Harald Hartmann 2015 - based on <a href="http://simplemvcframework.com/" target="_blank">Simple MVC Framework <span class="glyphicon glyphicon-new-window"></span></a>,
    <a href="http://getbootstrap.com/" target="_blank">bootstrap <span class="glyphicon glyphicon-new-window"></span></a>, 
    <a href="https://jquery.com/" target="_blank">jQuery <span class="glyphicon glyphicon-new-window"></span></a>,
    <a href="https://highcharts.com/" target="_blank">highcharts <span class="glyphicon glyphicon-new-window"></span></a>
  </footer>

<!-- JS -->
<?php helpers\assets::js(helpers\url::template_path() . 'js/jquery.js') ?>
<?php helpers\assets::js(helpers\url::template_path() . 'js/bootstrap.min.js') ?>
<?php helpers\assets::js(helpers\url::template_path() . 'js/highcharts.js') ?>
<?php helpers\assets::js(helpers\url::template_path() . 'js/stats.js') ?>

</body>
</html>
