<html>
            <head>
              <meta charset="UTF-8">
              <meta name="viewport" content="width=device-width, initial-scale=1.0">
              <title>Display a map</title>
              <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/ol@v8.2.0/ol.css">
              <script src="https://cdn.jsdelivr.net/npm/ol@v8.2.0/dist/ol.js"></script>

              <style>
                body {
                  margin: 0;
                  padding: 0;
                  display: flex;
                   background-color: #9980d2;
                }
                #map{
                  border: 2px solid #4B0082;
                  margin: 1vi;
                  padding: 2vi;
                  width: 60%; 
                  display: inline-block;
                  list-style: none;
                  background-color: #e7e1f8;
                }
#info ul{
  overflow: scroll;
  border: 2px solid #4B0082;
  margin: 1vi;
  padding: 2vi;
  width: 40%; 
  height:90%;
  display: inline-block;
  list-style: none;
  background-color: #e7e1f8;
  font-family: 'Courier New', Courier, monospace;
}

#info li {
  padding: 0.6vi;
  text-align: left;
}

#info li:nth-child(even) {
  background-color: #ddd2f4;
  color:#363286;
}

#info li:nth-child(odd) {
  background-color: #e7e1f8;
  color:#7b66bf;
}

#info li:first-child {
  background-color:  rgb(96, 92, 204);
  color: white;
  font-weight: bold;
}

                
                .popup, #popup {
                    background-color: white;
                    padding: 5px;
                    border-radius: 5px;
                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
                    white-space: nowrap;
                  }
            
                  .popup-closer {
                    position: absolute;
                    top: 0;
                    right: 0;
                    padding: 10px;
                    cursor: pointer;
                  }
              </style>
            </head>
            <body>
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
        echo "<li>Latitude: $latitude, Longitude: $longitude </li>";
        return [$longitude, $latitude];
    } else {
        // Handle the case where the request was not successful
        echo "Geocoding request failed. Error: " . $data['message'];
}
}



$servername = "mysql-neverlanes.alwaysdata.net";
$username = "336043";
$password = "m.2a*Z!#mV!9vWH";
$dbname = "neverlanes_database";

$link = mysqli_connect($servername, $username, $password, $dbname);

if (!$link) {
    echo "Error: Unable to connect to MySQL.";
    exit;
}

if(count($_POST)>0) {
    if (isset($_POST['route'])) {
        $selectedRoute = $_POST['route'];
        $query = "SELECT * FROM ROUTES where route_name = '".$selectedRoute."';";
        $rez = $link->query($query);

        if (!$rez) {
            echo "Error executing query: " . $link->error;
            exit;
        }

        $row = $rez->fetch_assoc();
        echo '<div id="info"><ul>';
        echo "<li>Selected route: " . $selectedRoute . ". Length of route: " . $row['length']."</li>";
        echo "<li>Number of stops: ". $row['no_stops']."</li><li></li>";
        $route_id=$row['route_id'];

        $query2 = "SELECT * FROM STOPS s join LOCATIONS l on (l.location_id = s.location_id) where route_id = '".$route_id."' ORDER BY l.location_id;";
        $coordinates_array =[];
        $stop_names_array =[];
        foreach ($link->query($query2) as $row) {
            echo  "<li>".$row['stop_name']."</li>";
            array_push($stop_names_array, $row['stop_name']);
            //$coordinates = find_coordinates($row['adress']);
            array_push($coordinates_array,find_coordinates($row['adress']));
        }
            echo '</ul></div>';//print_r($coordinates_array);
            $center_lat =0;
            $center_long =0;
            $stops =[];
            for ($i =0; $i<sizeof($coordinates_array);$i++){
                array_push($stops,["stop_name" => $stop_names_array[$i], "coordinates" => $coordinates_array[$i]]);
                $center_lat += $coordinates_array[$i][1];
                $center_long += $coordinates_array[$i][0];
            }
            $center_lat/=sizeof($coordinates_array);
            $center_long/=sizeof($coordinates_array);
            
        // echo '<iframe width="1000" height="800" src="https://api.maptiler.com/maps/streets-v2/?key=CiOlVnwrxtBxK8VQfwEg#0.7/17.27178/2.91944markers=14.4,50.1,red|8.6,47.4,rgba(118,31,232,1)|2.4,48.9,%23ffaa00"></iframe>';
            echo '
            
            <!-- Popup container -->
            <div id="popup" class="ol-popup">
            <a href="#" id="popup-closer" class="ol-popup-closer">×</a>
            <div id="popup-content"></div>
            </div>
              <div id="map"></div>
              <script>
                const key = "CiOlVnwrxtBxK8VQfwEg";
          
                const attribution = new ol.control.Attribution({
                  collapsible: false,
                });
          
                const source = new ol.source.TileJSON({
                  url: `https://api.maptiler.com/maps/streets-v2/tiles.json?key=${key}`,
                  tileSize: 512,
                  crossOrigin: "anonymous"
                });
          
                const map = new ol.Map({
                  layers: [
                    new ol.layer.Tile({
                      source: source
                    })
                  ],
                  controls: ol.control.defaults.defaults({attribution: false}).extend([attribution]),
                  target: "map",
                  view: new ol.View({
                    constrainResolution: true,
                    center: ol.proj.fromLonLat(['.$center_long.', '.$center_lat.']),
                    zoom: 1
                  })
                });

                const stops = '.json_encode($stops).'
            
                  const vectorSource = new ol.source.Vector();
            
                  // Add features for each stop
                  stops.forEach(stop => {
                    const feature = new ol.Feature({
                      geometry: new ol.geom.Point(ol.proj.fromLonLat(stop.coordinates)),
                      name: stop.stop_name
                    });
                    vectorSource.addFeature(feature);
                  });


                const layer = new ol.layer.Vector({
                            source: vectorSource,
                            style: new ol.style.Style({
                                        image: new ol.style.Icon({
                                            anchor: [0.5, 1],
                                            crossOrigin: "anonymous",
                                            src: "3-marker-icon.png",
                                            size: [100, 100],
                                        })
                                })
                            });
                map.addLayer(layer);

                // Add a popup overlay for showing stop names
                const popup = new ol.Overlay({
                    element: document.getElementById("popup"),
                    positioning: "bottom-center",
                    stopEvent: false,
                });
                map.addOverlay(popup);

                // Display the stop name when clicking on a marker
                map.on("click", function (event) {
                    map.forEachFeatureAtPixel(event.pixel, function (feature) {
                    const coordinates = feature.getGeometry().getCoordinates();
                    const name = feature.get("name");

                    const content = document.getElementById("popup-content");
                    content.innerHTML = name;

                    popup.setPosition(coordinates);
                    });
                });
                // Close the popup when clicking on the close button
                const popupCloser = document.getElementById("popup-closer");
                popupCloser.onclick = function () {
                    popup.setPosition(undefined);
                    popupCloser.blur();
                    return false;
                };

              </script>';
              
            
    } else {
        echo "No route selected.";
    }
    
    exit();

}
mysqli_close($link);

?>
</body>
          </html>
