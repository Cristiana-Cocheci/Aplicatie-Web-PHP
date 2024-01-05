var lightblue= "rgb(184,241,241)";
var lightpurple= "rgb(211,172,212)";
var pink="rgb(236, 158, 180)";
var red= "rgb(218, 88, 125)";
window.onload = function() {
   let routes = JSON.parse(document.getElementById("route_names").innerText);
   console.log(routes);
   let stops = JSON.parse(document.getElementById("stops_data").innerText);
   console.log(stops);
   const key = 'CiOlVnwrxtBxK8VQfwEg';
      const styleJson = `https://api.maptiler.com/maps/streets-v2/style.json?key=${key}`;

      const attribution = new ol.control.Attribution({
        collapsible: false,
      });

      const map = new ol.Map({
        target: 'harta',
        controls: ol.control.defaults.defaults({attribution: false}).extend([attribution]),
        view: new ol.View({
          constrainResolution: true,
          center: ol.proj.fromLonLat([0, 0]),
          zoom: 2
        })
      });
      olms.apply(map, styleJson);
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
                                            src: "marker-icon-medium.png",
                                        })
                                })
                            });
                map.addLayer(layer);
      /*const styles = {};
      routes.forEach(route =>{
         console.log(route+'-marker-icon.png');
         styles[route] = new ol.style.Style({
             image: new ol.style.Icon({
                 anchor: [0.5, 1],
                 crossOrigin: "anonymous",
                 src: 'marker-icon-medium.png',//route+'-marker-icon.png',
                 size: [32, 32],
             })})});
      console.log(styles);*/
//       const iconStyle = new ol.style.Style({
//          image: new ol.style.Icon({
//              anchor: [0.5, 1],
//              crossOrigin: 'anonymous',
//              src: 'marker-icon-medium.png',
//          }),
//      });
//      const marker = new ol.Feature({
//       geometry: new ol.geom.Point(ol.proj.fromLonLat([0, 0])),
//   });

//   marker.setStyle(iconStyle);
//   vectorSource.addFeature(marker);
/*
      stops.forEach(stop => {
                     const feature = new ol.Feature({
                      geometry: new ol.geom.Point(ol.proj.fromLonLat(stop.coordinates)),
                      name: stop.stop_name,
                      route: stop.route_id
                    });
               feature.setStyle(styles[stop.route_id]);
               console.log(styles[stop.route_id]);
               vectorSource.addFeature(feature); });
*/
      // const layer = new ol.layer.Vector({source: vectorSource});
      // map.addLayer(layer);

               //  // Add a popup overlay for showing stop names
               //  const popup = new ol.Overlay({
               //      element: document.getElementById("popup"),
               //      positioning: "bottom-center",
               //      stopEvent: false,
               //  });
               //  map.addOverlay(popup);

               //  // Display the stop name when clicking on a marker
               //  map.on("click", function (event) {
               //      map.forEachFeatureAtPixel(event.pixel, function (feature) {
               //      const coordinates = feature.getGeometry().getCoordinates();
               //      const name = feature.get("name");

               //      const content = document.getElementById("popup-content");
               //      content.innerHTML = name;

               //      popup.setPosition(coordinates);
               //      });
               //  });
               //  // Close the popup when clicking on the close button
               //  const popupCloser = document.getElementById("popup-closer");
               //  popupCloser.onclick = function () {
               //      popup.setPosition(undefined);
               //      popupCloser.blur();
               //      return false;
               //  };

}
