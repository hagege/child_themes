<?php
// Mit dem Script wird getestet, ob dei Zugangsdaten korrekt sind
// https://de.wordpress.org/support/topic/problem-bei-der-einrichtung-von-wordpress-scheitere-an-account-anlegung-admin/#post-111761
define ("MYSQL_HOST",     "hostname");
define ("MYSQL_USER",     "benutzer");
define ("MYSQL_PASSWORD", "passwort");

/* Beispiel für Testseite:
define ("MYSQL_HOST",     "frischeswp.test");
define ("MYSQL_USER",     "root");
define ("MYSQL_PASSWORD", "");
*/

$link = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD);

if (mysqli_connect_errno()) 
    printf("Connect failed: %s\n", mysqli_connect_error());
else
    echo "Alles Paletti";
?>