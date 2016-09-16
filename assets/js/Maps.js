// google maps api key: AIzaSyC7i0o5mdEYSbG_wqoWAx53tAP1xxTKVQo 

var map;
function initMap() {
    map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: Number(json[0].lat), lng: Number(json[0].lng)},
        zoom: 5,
        styles: styleArray,
        disableDefaultUI: true,
    });
    var markers = [];
    var popups = [];
    for (var i = 0; i < json.length; i++) {
        var data = json[i];
        markers[i] = new google.maps.Marker({
            map: map,
            position: {lat: Number(data.lat), lng: Number(data.lng)},
            title: (data.locality + ', ' + data.municipality + ', ' + data.country)
        });
    }
}