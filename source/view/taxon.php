@layout('layout.head')


<main>

    <section class="row primary-header" style="background-image: url('{{$taxon['image']}}')">

    </section>
    <div class="container">
        <h1 class="page-header underline center">{{ ucfirst($taxon['navn']) }}</h1> 
        
        <div class="row">
            <div class="col-6">
                <h2>Om {{ $taxon['navn'] }}</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsum repellat ad rerum distinctio, nobis nostrum quam sequi quisquam cum obcaecati dolorum, esse excepturi, numquam eaque dolore eveniet nulla eius assumenda!</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laboriosam amet molestias veritatis, necessitatibus deserunt dolores eveniet quis sed eos inventore reiciendis, ipsum incidunt in dolorem optio ut, delectus. Atque, optio.</p>
            </div>
            <div class="col-6">
                @if(!empty($taxon['gruppe']))
                    <div class="col-12">
                        {{ ucfirst($taxon['navn']) }} er i gruppen {{ strtolower($taxon['gruppe']) }}
                    </div>
                @endif
                <div class="col-12">Latin: <em>{{ $taxon['scientificName'] }}</em> </div>
                <div class="col-12">På Svalbard: {{ ($taxon['svalbard'] == 0 ? 'Nei' : 'Ja') }} </div>
                <div class="col-12">Risiko: {{ $taxon['risiko'] }} </div>
            </div>
            
            <div class="col-12">
                @if(count($oppskrift) > 0)
                    <h1 class="page-header underline center">Oppskrifter med {{ $taxon['navn'] }}</h1>
                @endif
                
                @foreach($oppskrift as $recipe)

                    @layout('layout.article_front', ['recipe' => $recipe])

                @endforeach
            </div>
            <div class="col-12">
                <h1 class="page-header underline center">Hvor finner jeg {{ $taxon['navn'] }}</h1>
            </div>
        </div>
        
    </div>
</main>

 

<div id="map" class="taxon-map"></div>

@layout('layout.scripts')

<script src="/assets/js/min/googleMapsStyle-min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key={{$google_key}}&callback=initMap" async defer></script>
<script>

    // google maps api key: AIzaSyC7i0o5mdEYSbG_wqoWAx53tAP1xxTKVQo 

var map;

function initMap(){ 
    map = new google.maps.Map(document.getElementById('map'), {
        center: {lat : 65.2, lng : 10.757933},
        zoom: 4,
        styles: styleArray,
        disableDefaultUI: true,
        disableDoubleClickZoom : true,
        scrollwheel: false,
        navigationControl: false,
        mapTypeControl: false,
        scaleControl: false,
        draggable: false,
    });
    
    setMap();
}


function log(i){
    console.info(i);
}

function setMap() {
    var zoom = 10;
    var markers = [];
    var popups = [];
    
    $.get({
        url: '/api/taxon/{{$taxon['taxonID']}}',
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
        },
    });
}
    
</script>

@layout('layout.foot')