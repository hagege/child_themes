<?php
   $path = dirname(__FILE__);
   echo "Probleme mit symbolischen Links im Dateisystem und PHP?<br>";
   echo $path;   
   echo "<br><br>";
   echo readlink($path);
   echo "<br><br>";
   echo $_SERVER['DOCUMENT_ROOT'];
   phpinfo();
?>