<?php
 require "header.php";
   if(isset($_POST['download_EXCEL_clients'])){
      include_once 'exportexcel.php';
      exportexcel($_SESSION['excel_data']);
   }
   
   ?>
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
            include 'DBconnect.php';

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
         include 'DBconnect.php';

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
         print_r("<form method='post'>
         <input type='submit' name='download_EXCEL_clients' value='Download clients data as excel file'/>
      </form>");
      print_r('<form action="import_excel.php" method="POST" enctype="multipart/form-data">

      <input type="file" name="import_file" class="form-control" />
      <button type="submit" name="save_excel_data" class="btn btn-primary mt-3">Import</button>

  </form>');
         include 'DBconnect.php';
         //require_once 'PhpXLsxGenerator.php';
         $excel_fn = 'clients-data-'.date('d-m-Y').'.xlsx';
         //nume coloane
         $excelData[] = array('ID', 'USERNAME', 'FIRST NAME', 'LAST NAME', 'EMAIL', 'ROLE');

         $query = "SELECT * FROM CLIENTS ORDER BY client_id";
         $res = $link->query($query);
         print '<a> Client accounts number: '.$res->num_rows.'.</a><br>';
           
         foreach ($link->query($query) as $row) {
            //print_r($row);
            print "<ul>";
            print '<li>Client ID:<br> ' . $row['client_id'] . '</li>';
            print '<li>Username: ' . $row['username'] . '</li>';
            print '<li>Name: ' . $row['first_name'] .' '.$row['last_name']. '</li>';
            print '<li>Email: ' . $row['email'] . '</li>';
            print '<li>Role: ' . $row['role'] . '</li>';
            
             print "</ul>";
             $excelData[] = array($row['client_id'], $row['username'], $row['first_name'], $row['last_name'], $row['email'], $row['role']);
            /* $excelData[] = array("ID"=>$row['client_id'], "USERNAME"=>$row['username'], 
            "FIRST_NAME"=>$row['first_name'], "LAST_NAME"=> $row['last_name'],
            "EMAIL"=> $row['email'], "ROLE"=> $row['role']);*/
         }
         
        //print_r($excelData);
        $_SESSION['excel_data']=$excelData;
         // $xlsx = CodexWorld\PhpXlsxGenerator::fromArray( $excelData ); 
         // $xlsx ->downloadAS($fileName);
         mysqli_close($link);
      }
         
      ?>
   </div>
</body>

</html>
