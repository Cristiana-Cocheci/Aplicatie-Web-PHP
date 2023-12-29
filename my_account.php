<!DOCTYPE html>
<html>

<head>
   <link rel="stylesheet" href="neverlanes.css" type="text/css">

   <title>neverlanes</title>
   <meta charset="utf-8">
   <meta name="autor" content="cristi">
   <meta name="description" content="pagina web?">
   <meta name="keywords" content="neverlanes">
   <!--<link rel="icon" type="image/x-icon" href="C:\Users\Paula\Desktop\anul 1\sem2\tehnici web\Spongrio.webp">-->

   <!--<link rel="stylesheet" href="C:\Users\Paula\Desktop\anul 1\sem2\tehnici web\style.css" type="text/css">-->
</head>

<body>
   <div class="header">
      <h1>
         NEVERLANES
      </h1>
   </div>
   <ul>
   <li><a href="logout.php">LOGOUT</a></li>
   <?php 
        require "header.php";
        if($_SESSION["username"]==-1){
            print '<li><a href="login.php">Want to login? Click here!</a></li>';
        }
   ?>
   <li><a href="delete_acc.html">DELETE ACCOUNT</a></li>
   </ul>
   
   <div id="bilete">
      <?php
         if($_SESSION["username"]!=-1){
            print "<p>Here are your tickets: </p>";
         }
      ?>
      
      <ul id="tabel_bilete">
        
      <?php
            $link = mysqli_connect("mysql-neverlanes.alwaysdata.net", "336043", "m.2a*Z!#mV!9vWH", "neverlanes_database");
               if (!$link) {
                  echo "Error: Unable to connect to MySQL.";
                  exit;
            }

            $query = "SELECT * FROM TICKETS t JOIN TICKETS_TYPES tt ON (t.type_id=tt.type_id) WHERE client_id ='".$_SESSION["client_id"]."';";

            //echo $query;

            foreach ($link->query($query) as $row) {
               print '<ul>';
               print '<li>Ticket Type:<br> ' . $row['type_name'] . '</li>';
               print '<li>Valability: ' . $row['valability'] . '</li>';
               print '<li>Price: ' . $row['price'] . '</li>';
               print '<li>Purchase Date: ' . $row['purchase_date'] . '</li>';
               if($row['activation_date'] == NULL){
                  print '<li>Activation Date: -</li>';
                  print '<li>Expiry Date: -</li>';
               }
               else{
                  print '<li>Activation Date: ' . $row['activation_date'] . '</li>';
               print '<li>Expiry Date: ' . $row['expiry_date'] . '</li>';
               }
               print '</ul>';
            }
                 
            mysqli_close($link);
      ?>
      </ul>
   </div>
</body>

</html>
