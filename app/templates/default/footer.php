
  <div class="container">
    <a href="#top" class="glyphicon glyphicon-chevron-up pull-right"></a>
    <hr>    
  </div>

  <footer class="container">
    © Harald Hartmann 2015 - based on <a href="http://simplemvcframework.com/" target="_blank">Simple MVC Framework <span class="glyphicon glyphicon-new-window"></span></a>,
    <a href="http://getbootstrap.com/" target="_blank">bootstrap <span class="glyphicon glyphicon-new-window"></span></a>, 
    <a href="https://jquery.com/" target="_blank">jQuery <span class="glyphicon glyphicon-new-window"></span></a>,
    <a href="https://highcharts.com/" target="_blank">highcharts <span class="glyphicon glyphicon-new-window"></span></a>,
    <a href="https://datatables.net/" target="_blank">dataTables <span class="glyphicon glyphicon-new-window"></span></a> 
    - use of cookies and javascript
  </footer>

<!-- JS -->
<?php
  helpers\assets::js(array(
    helpers\url::template_path() . 'js/jquery.js',
    helpers\url::template_path() . 'js/bootstrap.min.js',
    helpers\url::template_path() . 'js/jquery.dataTables.min.js',
    helpers\url::template_path() . 'js/dataTables.bootstrap.js',
    helpers\url::template_path() . 'js/highcharts.js',
    helpers\url::template_path() . 'js/dataTables.js',
    helpers\url::template_path() . 'js/stats.js',
    helpers\url::template_path() . 'js/custom.js'
  ))
?>    
</body>
</html>
