<html>
            <head>
              <meta charset="UTF-8">
              <meta name="viewport" content="width=device-width, initial-scale=1.0">
              <title>Display a map</title>
              <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/ol@v8.2.0/ol.css">
              <script src="https://cdn.jsdelivr.net/npm/ol@v8.2.0/dist/ol.js"></script>
              <?php
              //require 'header.php';
              print '<p class="secret_data" id="stops_data">'.$_SESSION['stops'].'</p>';
              print '<p class= "secret_data" id="route_names">'.$_SESSION['route_names'].'</p>';
              ?>
              <style>
                body {
                  margin: 0;
                  padding: 0;
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
            <!-- Popup container -->
            <div id="popup" class="ol-popup">
            <a href="#" id="popup-closer" class="ol-popup-closer">×</a>
            <div id="popup-content"></div>
            </div>
              <div id="map"></div>
              <script>
                let routes = JSON.parse(document.getElementById("route_names").innerText);
                console.log(routes);
                let stops = JSON.parse(document.getElementById("stops_data").innerText);
                console.log(stops);
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
                    center: [0,0],
                    zoom: 1
                  })
                });

                const styles = {};
                routes.forEach(route =>{
                    console.log(route+'-marker-icon.png');
                    styles[route] = new ol.style.Style({
                        image: new ol.style.Icon({
                            anchor: [0.5, 1],
                            crossOrigin: "anonymous",
                            src: route+'-marker-icon.png',//'marker-icon-medium.png',//route+'-marker-icon.png',
                            size: [40, 40],
                        })})});
                console.log(styles);
                
                  const vectorSource = new ol.source.Vector();

                  stops.forEach(stop => {
                     const feature = new ol.Feature({
                      geometry: new ol.geom.Point(ol.proj.fromLonLat(stop.coordinates)),
                      name: stop.stop_name,
                      route: stop.route_id
                    });
               feature.setStyle(styles[stop.route_id]);
               console.log(styles[stop.route_id]);
               vectorSource.addFeature(feature); });
            
               const layer = new ol.layer.Vector({source: vectorSource});


                // const layer = new ol.layer.Vector({
                //             source: vectorSource,
                //             style: new ol.style.Style({
                //                         image: new ol.style.Icon({
                //                             anchor: [0.5, 1],
                //                             crossOrigin: "anonymous",
                //                             src: "marker-icon-medium.png",
                //                         })
                //                 })
                //             });
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

              </script>
              
            </body>
          </html>