<!DOCTYPE html>
<html>

<head>
   <link rel="stylesheet" href="home_page.css" type="text/css">
   <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=EB+Garamond&display=swap">
   <!--<script type="text/javascript" src="harta.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/ol@v8.2.0/dist/ol.js"></script>
      <script src="https://unpkg.com/ol-mapbox-style@12.1.1/dist/olms.js"></script>-->

   <title>neverlanes</title>
   <meta charset="utf-8">
   <meta name="autor" content="cristi">
   <meta name="description" content="pagina web?">
   <meta name="keywords" content="neverlanes">
   <!--<link rel="icon" type="image/x-icon" href="C:\Users\Paula\Desktop\anul 1\sem2\tehnici web\Spongrio.webp">-->

   <!--<link rel="stylesheet" href="C:\Users\Paula\Desktop\anul 1\sem2\tehnici web\style.css" type="text/css">-->
</head>

<body>
    <!-- Popup container -->
    
    <div class="coloana" id="coloana1"><img src="coloana.png" alt="greek column"></div>
    <div class="pagina">
        <div class="header">
            <h1>
                NEVERLANES
            </h1>
            
        </div>
        <!-- <div id="popup" class="ol-popup">
            <a href="#" id="popup-closer" class="ol-popup-closer">×</a>
            <div id="popup-content">

            </div> -->
   <?php require "header.php"; ?>
   <?php
   function find_coordinates($adress){
        $apiKey = 'CiOlVnwrxtBxK8VQfwEg';
        $geocodeUrl = "https://api.maptiler.com/geocoding/" . urlencode($adress) . ".json?key=" . $apiKey;

        $ch = curl_init($geocodeUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        $data = json_decode($response, true);
        //print_r($data);
        if (isset($data['features'][0]['geometry']['coordinates'])) {
            // Extract latitude and longitude from the response
            $latitude = $data['features'][0]['geometry']['coordinates'][1];
            $longitude = $data['features'][0]['geometry']['coordinates'][0];

            // Output the coordinates
            //echo "Latitude: $latitude, Longitude: $longitude <br>";
            return [$longitude, $latitude];
        } else {
            // Handle the case where the request was not successful
            echo "Geocoding request failed. Error: " . $data['message'];
}
}
            if(!isset($_SESSION['stops'])){
   
                        include_once 'DBconnect.php';
                       

                        $query = "SELECT * FROM ROUTES";
                        $route_names=[];
                        foreach ($link->query($query) as $row) {
                            array_push($route_names, $row['route_id']);
                        }

                        $query = "SELECT r.route_id, stop_name, adress FROM ROUTES r JOIN STOPS s ON (s.route_id = r.route_id) 
                                    JOIN LOCATIONS l ON (l.location_id = s.location_id)";

                                             

                        $stops =[];
                        foreach ($link->query($query) as $row) {
                            
                            array_push($stops, ["stop_name"=>$row['stop_name'],"route_id"=>$row['route_id'], "coordinates" =>find_coordinates($row['adress'])]);
                        }
                        $route_names = json_encode($route_names);
                        $stops = json_encode($stops);
                        print '<p class="secret_data" id="stops_data">'.$stops.'</p>';
                        print '<p class= "secret_data" id="route_names">'.$route_names.'</p>';
                        $_SESSION['stops']=$stops;
                        $_SESSION['route_names']=$route_names;
                        mysqli_close($link);
                    }
                    ?>
        <div class="menu">
            <ul>
                <li><a href="login.php">LOGIN</a></li>
                <li><a href="my_account_check.php">MY ACCOUNT</a></li>
                <li><a href="contact.php">CONTACT</a></li>
            </ul>
        </div>
      
        <FORM method="POST" action="show_route.php">
            <table>
                
                <tr>
                    <td>
                    <select name="route">
                        <?php
                        $link = mysqli_connect("mysql-neverlanes.alwaysdata.net", "336043", "m.2a*Z!#mV!9vWH", "neverlanes_database");

                        if (!$link) {
                            echo "Error: Unable to connect to MySQL.";
                            exit;
                        }

                        $query = "SELECT * FROM ROUTES";

                        echo $query;
                        /*$route_names = [];*/
                        foreach ($link->query($query) as $row) {
                            print '<option value="' . $row['route_name'] . '">' . $row['route_name'] . '</option>';
                            // array_push($route_names, $row['route_name']);
                        }
                        // print_r($route_names);
                        // $route_names_json = json_encode($route_names);
                        // print '<p class="secret_data" id="route_names">' . $route_names_json . '</p>';
                        mysqli_close($link);
                        ?>

                        <option SELECTED VALUE="">Choose a route!</option>
                    </select>
                    </td>
                </tr>
                <tr>
                    <td><INPUT TYPE="submit" VALUE="Check it out!"></td>
                </tr>
            </table>
        </FORM>
        <div class="harta" id="harta">
        <?php
            include 'harta2.php';
        ?>

        </div>
    </div>
   <div class="coloana" id="coloana2">
    <img src="coloana.png" alt="greek column">
   </div>
</body>

</html>
