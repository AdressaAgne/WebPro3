// google maps api key: AIzaSyC7i0o5mdEYSbG_wqoWAx53tAP1xxTKVQo 

function getLocation() {
    //if(!navigator.geolocation)  return;
    navigator.geolocation.getCurrentPosition(showPosition, showError);
}
getLocation();

var map;
var lat;
var lng;

function initMap(){ 
    map = new google.maps.Map(document.getElementById('map'), {
        center: {lat : 59.911491, lng : 10.757933},
        zoom: 6,
        styles: styleArray,
        disableDefaultUI: true,
        disableDoubleClickZoom : true,
    });
}


function showPosition(pos) {
    lat = pos.coords.latitude;
    lng = pos.coords.longitude;
    setMap({lat : lat, lng : lng, dist : 25})
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

$("#map_range").change(function(){
    setMap({lat : lat, lng : lng, dist : this.value})
});

function setMap(pos) {
    var zoom = 10;
    var markers = [];
    var popups = [];
    
    $.get({
        url: '/api/nearby/'+pos.lat+'/'+pos.lng+"/"+pos.dist,
        dataType: 'json',
        success: function(taxons){
            console.log(taxons);
                for (var i = 0; i < taxons.length; i++) {
                    var data = taxons[i];
                    var markerCords = {lat: Number(data.lat), lng: Number(data.lng)};
                    image = '/assets/img/icons/fish.png';
                    markers[i] = new google.maps.Marker({
                        map: map,
                        position: markerCords,
                        title: data.navn,
                    });
                }
                map.setZoom(9);
                map.panTo(pos);

        },
    });
}