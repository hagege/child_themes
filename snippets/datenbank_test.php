<!DOCTYPE html>
<html lang="de">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Datenbank prüfen</title>
    <style>
      #container {
          width:500px;
          margin: 0 auto;
      }
      input[type=text], input[type=password] {
          width: 250px;
      }
    </style>
  </head>
  <body>
  <div id="container">
<?php
  if (isset($_POST['hostname']))
  {
      if (empty($_POST['hostname']) || empty($_POST['user']) || empty($_POST['password']) || empty($_POST['database']))
          die ("Nicht alle Felder ausgefüllt");
      
      $link = mysqli_connect($_POST['hostname'], $_POST['user'], $_POST['password']);

      if (mysqli_connect_errno()) 
         printf("Connect failed: %s\n", mysqli_connect_error());
      else
      {
         mysqli_select_db($link, $_POST['database'])
           or die ("Datenbank " . $_POST['database'] . " existiert nicht");
           
         $query = "show tables";
    
         $result = mysqli_query($link, $query)
                   or  die ("Fehler mit $query<br>: " . mysqli_error($link));
    
         if (mysqli_num_rows($result))
         {
            echo "<h3>Folgende Tabellen sind vorhanden:</h3>";
          
            while ($table = mysqli_fetch_row($result))
            {
                $output = $table[0];
                
                if (isset($_POST['count']))
                {
                    $query = "select count(*) from `" . $table[0] . "`";
                    
                    $result1 = mysqli_query($link, $query)
                         or  die ("Fehler mit $query<br>: " . mysqli_error($link));
                    
                    $count = mysqli_fetch_row($result1)[0];
                    
                    $output .= ", Anzahl Datensätze: $count";
                }
                            
                echo "$output<br>";
            }
         }
         else
            echo "Keine Tabellen vorhanden";
     }
  }
  else
  {
?>
<h3>Daten für Datenbankzugriff eingeben</h3>
<form action="" method="post">
  <label for="hostname">Hostname:</label><br>
  <input type="text" id="hostname" name="hostname" required ><br><br>
  <label for="user">Benutzer</label><br>
  <input type="text" id="user" name="user" required ><br><br>
  <label for="password">Passwort</label><br>
  <input type="password" id="password" name="password" required ><br><br>
  <label for="database">Datenbank</label><br>
  <input type="text" id="database" name="database" required ><br><br>
  <input type="checkbox" id="count" name="count">
   <label for="count">Anzahl Datensätze anzeigen</label><br><br>
  <input type="submit" value="Submit">
</form>
<?php
  }
?>
</div>
</body>
</html>