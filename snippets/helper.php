<?php

/* helper Datei zum entpacken auf dem Server :-)
zip benennen in entpacken.zip
neue Datei auf dem ftp erstellen entpacken.php 
folgendes einfügen */

     $zip = new ZipArchive;
     $res = $zip->open('entpacken.zip');
     if ($res === TRUE) {
         $zip->extractTo('./'); // wohin soll es entpackt werden
         $zip->close();
         echo 'ok';
     } else {
         echo 'failed';
     }

/* speichern 
entpacken.php öffnen im browser 
fertig */

?>
