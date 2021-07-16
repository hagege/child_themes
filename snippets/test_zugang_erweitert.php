<?php
// Mit dem Script wird getestet, ob dei Zugangsdaten korrekt sind
// https://de.wordpress.org/support/topic/problem-bei-der-einrichtung-von-wordpress-scheitere-an-account-anlegung-admin/#post-111761
define ("MYSQL_HOST",     "hostname");
define ("MYSQL_USER",     "benutzer");
define ("MYSQL_PASSWORD", "passwort");
define ("MYSQL_DATABSE",  "database");

/* Beispiel für Testseite:
define ("MYSQL_HOST",     "frischeswp.test");
define ("MYSQL_USER",     "root");
define ("MYSQL_PASSWORD", "");
define ("MYSQL_DATABSE",  "frischeswp");
*/

$link = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABSE);

if (mysqli_connect_errno()) 
    printf("Connect failed: %s\n", mysqli_connect_error());
else
{
    $query = "show tables";
    
    $result = mysqli_query($link, $query);
    
    if (mysqli_num_rows($result))
    {
       echo "Folgende Tabellen sind vorhanden:<br>";
       
       while ($table = mysqli_fetch_row($result))
         echo $table[0] . "<br>";
    }
    else
      echo "Keine Tabellen vorhanden";
}
?>