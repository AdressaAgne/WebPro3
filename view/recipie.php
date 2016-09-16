@layout('layout.head')
  <body>
   <main class="ui container">
       <div class="ui grid">
           <div class="ui ten wide column top50">
               <h1 class="dividing">{{ $data['navn'] }} <small><em>{{ $data['scientificName'] }}</em></small></h1>
               <h3>{{ $groupName }}</h3>
               <div class="ui breadcrumb">                      
                  {! $groups !}
               </div>
                <div class="ui divider"></div>
               <p class="text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid facilis debitis voluptas rem explicabo, dolorum voluptate, quisquam esse quia laudantium aperiam dignissimos quaerat molestiae, mollitia adipisci at! Nesciunt, voluptatibus, suscipit!</p>
           </div>
           <div class="six wide column">
                <div id="map" class="ui segment"></div>  
           </div>
       </div>
   </main>


    <script src="assets/css/Semantic-UI-CSS-master/semantic.min.js"></script>
    <script src="assets/js/googleMapsStyle.js"></script>
    <script src="assets/js/testJson.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC7i0o5mdEYSbG_wqoWAx53tAP1xxTKVQo&callback=initMap" async defer></script>
    <script src="assets/js/Maps.js"></script>
@layout('layout.foot')