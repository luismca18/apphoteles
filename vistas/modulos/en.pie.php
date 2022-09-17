
<?php

$url_actual = "http://" . $_SERVER["SERVER_NAME"];

//.str_replace('plantillaadmin.php','',$_SERVER["REQUEST_URI"])
//$url_actual = "http://" . $_SERVER["SERVER_NAME"]."";

?>
<footer class="main-footer">
<img src="<?php $url_actual ?>img/logo.jpg" alt="HotelesApp" style="width:200px;" >
    <strong>Copyright © 
      <?php
        echo date("Y");
      ?>
       All rights reserved
  </footer>
  
  </body>
</html>