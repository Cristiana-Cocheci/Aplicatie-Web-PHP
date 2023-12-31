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
   
   <div id="date_client">
   <?php
         if($_SESSION["username"]!=-1){
            print '<a class ="client_data">Username: '.$_SESSION["username"].'</a>';
            print '<a class ="client_data">Name: '.$_SESSION["first_name"].' '.$_SESSION["last_name"].'</a>';
            print '<a class ="client_data">Account type: '.$_SESSION["role"].'</a>';
           
         }
      ?>
   </div>
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
            $exista_bilete = 0;
            foreach ($link->query($query) as $row) {
               $exista_bilete = 1;
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
            if($exista_bilete == 0){
               print '<ul><li> No tickets available </li></ul>';
            }
                 
            mysqli_close($link);
      ?>
      </ul>
   </div>
   <div id="tabel_trasee">
      <?php
      if($_SESSION['role']=="DRIVER"){
         $link = mysqli_connect("mysql-neverlanes.alwaysdata.net", "336043", "m.2a*Z!#mV!9vWH", "neverlanes_database");
         if (!$link) {
            echo "Error: Unable to connect to MySQL.";
            exit;
         }

         $query = "SELECT * FROM VEHICLES v JOIN ROUTES r ON (v.route_id=r.route_id)
                                            JOIN VEHICLE_TYPE vt ON (v.vehicle_type = vt.type_id)
                                            JOIN DRIVERS d ON (v.driver_id = d.driver_id)
                                            JOIN CLIENTS c ON (d.client_id = c.client_id)
                                            JOIN LOCATIONS l ON (l.location_id = v.position_id)
         WHERE c.client_id ='".$_SESSION["client_id"]."';";
         $result = $link->query($query);
         print '<a> You have '.$result->num_rows.' active route(s).</a><br>';
           
         foreach ($link->query($query) as $row) {
            //print_r($row);
            print "<ul>";
            print '<li>Route Name:<br> ' . $row['route_name'] . '</li>';
            print '<li>Route length: ' . $row['no_stops'] . '</li>';
            print '<li>Current location: ' . $row['location_name'] . '</li>';
            print '<li>Vehicle type: ' . $row['vehicle_name'] . '</li>';
            
             print "</ul>";
         }
         
        

         mysqli_close($link);
      }
         
      ?>
   </div>
   <div id="tabel_users">
   <?php
      if($_SESSION['role']=="ADMIN"){
         $link = mysqli_connect("mysql-neverlanes.alwaysdata.net", "336043", "m.2a*Z!#mV!9vWH", "neverlanes_database");
         if (!$link) {
            echo "Error: Unable to connect to MySQL.";
            exit;
         }

         $query = "SELECT * FROM CLIENTS ";
         $result = $link->query($query);
         print '<a> Client accounts number: '.$result->num_rows.'.</a><br>';
           
         foreach ($link->query($query) as $row) {
            //print_r($row);
            print "<ul>";
            print '<li>Client ID:<br> ' . $row['client_id'] . '</li>';
            print '<li>Username: ' . $row['username'] . '</li>';
            print '<li>Name: ' . $row['first_name'] .' '.$row['last_name']. '</li>';
            print '<li>Email: ' . $row['email'] . '</li>';
            print '<li>Role: ' . $row['role'] . '</li>';
            
             print "</ul>";
         }
         
        

         mysqli_close($link);
      }
         
      ?>
   </div>
</body>

</html>
