//NAMESPACE google.maps.ALGO


navigator.geolocation.getCurrentPosition(fn_ok,fn_error);
var divMapa=document.getElementById('map');
//var divMapa=$('#map');
function fn_error(){
    divMapa.innerHTML='Hubo un problema solicitando los datos';
}

function fn_ok(respuesta){
    var map=new google.maps.Map(document.getElementById("map"));
    var bounds = new google.maps.LatLngBounds();
    // Multiple markers location, latitude, and longitude
    var markers = [
        ['Sede Javier Prado',-12.089218091755795, -77.01574868971116],
        ['Sede 28 de Julio',-12.063226877463787, -77.03352476099145],
        ['Sede Atocongo',-12.156600691212441, -76.98371335902573],
        ['Sede Terminal Plaza Norte',-12.005051785087128, -77.05494476760562],
        ['Sede Arequipa Central',-16.42303396711053, -71.5453360854306],
        ['Sede Arequipa Camaná',-16.585170973998583, -72.70553736332874],
        ['Sede Piura Loreto',-5.201091472336525, -80.63118770328701],
        ['Sede Piura Talara',-4.586560718171606, -81.27041074562112],

        ['Sede Abancay', -13.639179280953257, -72.88528518972556],
        ['Sede Terminal Bagua Grande', -5.610295414784535, -78.43606746099624],
        ['Sede Terminal Cajamarca', -7.17104578365114, -78.50138495686839],
        ['Sede Terminal Bolognesi Chiclayo', -6.775742750626063, -79.83828664670624],
        ['Sede Terminal Cusco', -13.533136022933917, -71.97171081885351],
        ['Sede Terminal Huaraz', -9.525636997019953, -77.52745021214375],
        ['Sede Terminal Ica', -14.063957987457615, -75.73318988968508]
    ];

    // Add multiple markers to map
    var infoWindow = new google.maps.InfoWindow(), marker, i;

    // Place each marker on the map  
    for( i = 0; i < markers.length; i++ ) {
        var position = new google.maps.LatLng(markers[i][1], markers[i][2]);
        bounds.extend(position);
        marker = new google.maps.Marker({
            position: position,
            map: map,
            title: markers[i][0]
        });
        
        // Add info window to marker    
        google.maps.event.addListener(marker, 'click', (function(marker, i) {
            return function() {
                infoWindow.setContent(infoWindowContent[i][0]);
                infoWindow.open(map, marker);
            }
        })(marker, i));

        // Center the map to fit all markers on the screen
        map.fitBounds(bounds);
    }

    const directionsService = new google.maps.DirectionsService();
    const directionsRenderer = new google.maps.DirectionsRenderer();
    directionsRenderer.setMap(map);
    document.getElementById("submit").addEventListener("click", () => {
      calculateAndDisplayRoute(directionsService, directionsRenderer);
    });

    function calculateAndDisplayRoute(directionsService, directionsRenderer) {
      const waypts = [];
      const checkboxArray = document.getElementById("waypoints");
      
        for (let i = 0; i < checkboxArray.length; i++) {
          if (checkboxArray.options[i].selected) {
            waypts.push({
              location: checkboxArray[i].value,
              stopover: true,
            });
          }
        }
      
        directionsService
          .route({
            origin: document.getElementById("start").value,
            destination: document.getElementById("end").value,
            waypoints: waypts,
            optimizeWaypoints: false,
            travelMode: google.maps.TravelMode.DRIVING,
          })
          .then((response) => {
            directionsRenderer.setDirections(response);
      
            const route = response.routes[0];
            const summaryPanel = document.getElementById("directions-panel");
      
            summaryPanel.innerHTML = "";
      
            // For each route, display summary information.
            for (let i = 0; i < route.legs.length; i++) {
              const routeSegment = i + 1;
      
              summaryPanel.innerHTML += 
              `<div class="ruta">
                <h3 class="numeroRuta">Segmento de ruta: ${routeSegment}</h3>
                <div class="ruta-descripcion"
                  <span>${route.legs[i].start_address}<b> hacia</b></span> 
                  <span>${route.legs[i].end_address}</span>
                  <p class="distancia">Distancia: ${route.legs[i].distance.text}</p>
                </div>
              </div>`
            }
          })
          .catch((e) => window.alert("Solicitud de indicaciones fallida debido a " + status));
      }

    
}
