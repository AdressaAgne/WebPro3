@layout('layout.head')

<main>
    <section class="map_info">
        <div class="col-12">
            <h2 class="page-heeader center"></h2>
        </div>
        
        
        <div class="bottom">
            <label for="">Søke Radius i km
                <input id="map_range" type="range" min="1" max="50" value="25">
            </label>
        </div>
    </section>
    <div id="map" class="full_map"></div>
</main> 
    <script src="/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="/assets/js/min/googleMapsStyle-min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key={{$google_key}}&callback=initMap" async defer></script>
    <script src="/assets/js/min/Maps-min.js"></script>

</body>
</html>