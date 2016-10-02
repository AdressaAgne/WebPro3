// google maps api key: AIzaSyC7i0o5mdEYSbG_wqoWAx53tAP1xxTKVQo 

function getLocation() {
    if(!navigator.geolocation)  return;
    navigator.geolocation.getCurrentPosition(showPosition, showError);
}
getLocation();

var map;

function initMap(){ 
    map = new google.maps.Map(document.getElementById('map'), {
        center: {lat : 59.911491, lng : 10.757933},
        zoom: 5,
        styles: styleArray,
        disableDefaultUI: true,
    });
}


function showPosition(pos) {
    setMap({lat : pos.coords.latitude, lng : pos.coords.longitude})
}

function showError(error) {
    switch(error.code) {
        case error.PERMISSION_DENIED:
            log("User denied the request for Geolocation.");
            break;
        case error.POSITION_UNAVAILABLE:
            log("Location information is unavailable.");
            break;
        case error.TIMEOUT:
            log("The request to get user location timed out.");
            break;
        case error.UNKNOWN_ERROR:
            log("An unknown error occurred.");
            break;
    }
}

function log(i){
    console.info(i);
}

function setMap(pos) {
    var zoom = 10;
    map = new google.maps.Map(document.getElementById('map'), {
        center: pos,
        zoom: zoom,
        styles: styleArray,
        disableDefaultUI: true,
    });
    var markers = [];
    var popups = [];
    
    $.get({
      url: '/nearby_api/'+pos.lat+'/'+pos.lng,
      success: function(taxons){
        for (var i = 0; i < taxons.length; i++) {
            var data = taxons[i];
            var markerCords = {lat: Number(data.lat), lng: Number(data.lng)};
            image = '/assets/img/icons/carrot.png';
            markers[i] = new google.maps.Marker({
                map: map,
                position: markerCords,
                title: data.navn
            });
            
        }
      },
      dataType: 'json',
    });
}