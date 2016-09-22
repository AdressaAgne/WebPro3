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
               <p class="text">Det er ei lita dyrevise som du nå får høre, 
               om dyrene i Afika og alt de har å gjøre. 
               Ojajaja ohaha, ojajaja ohaha, 
               om dyrene i Afrika og alt de har å gjøre. </p>
               <p>
               Høyt oppi trærne vokser kokosnøtter og bananer, 
               og der bor mange fornemme og fine bavianer. 
               Ojajaja ohaha, ojajaja ohaha, 
               der bor mange fornemme og fine bavianer.</p>
               <p>
               Og ungene blir vogget i en palmehengekøye, 
               og barnepika er en gammel skravlepapegøye. 
               Ojajaja ohaha, ojajaja ohaha, 
               barnepika er en gammel skravlepapegøye.</p>
               <p>
               Den store elefanten han er skogens brannkonstabel, 
               og blir det brann så slukker han den med sin lange snabel. 
               Ojajaja ohaha, ojajaja ohaha, 
               blir det brann så slukker han den med sin lange snabel.</p>
               <p>
               Men dronningen og kongen det er løven og løvinna, 
               og dronninga er sulten støtt, og kongen er så sinna. 
               Ojajaja ohaha, ojajaja ohaha, 
               dronninga er sulten støtt, og kongen er så sinna.</p>
               <p>
               I trærne sitter fuglene og synger hele dagen, 
               og flodhesten slår tromme ved å dunke seg på magen. 
               Ojajaja ohaha, ojajaja ohaha, 
               flodhesten slår tromme ved å dunke seg på magen.</p>
               <p>
               Og strutsen danser samba med den peneste sjimpansen, 
               og snart er alle andre dyra også med i dansen. 
               Ojajaja ohaha, ojajaja ohaha, 
               snart er alle andre dyra også med i dansen.</p>
               <p>
               Den store krokodillen var så dårlig her om dagen, 
               den hadde spist en apekatt og fått så vondt i magen. 
               Ojajaja ohaha, ojajaja ohaha, 
               den hadde spist en apekatt og fått så vondt i magen.</p>
               <p>
               Og nede i sjiraffenland der var det sorg i valsen, 
               for åtte små sjiraffer hadde fått så vondt i halsen. 
               Ojajaja ohaha, ojajaja ohaha, 
               åtte små sjiraffer hadde fått så vondt i halsen.</p>
               <p>
               Men da kom doktor nesehorn med hatt og stokk og briller, 
               og så fikk alle hostesaft og sorte små pastiller. 
               Ojajaja ohaha, ojajaja ohaha, 
               så fikk alle hostesaft og sorte små pastiller.</p>
               <p>
               Den stakkars krokodillen måtte doktor´n operere, 
               og enda er det mange vers, men jeg kan ikke flere. 
               Ojajaja ohaha, ojajaja ohaha, 
               enda er det mange vers, men jeg kan ikke flere.</p>
           </div>
           <div class="six wide column">
                <div id="map" class="ui segment"></div>  
           </div>
       </div>
   </main>


    <script src="/assets/css/Semantic-UI-CSS-master/semantic.min.js"></script>
    <script src="/assets/js/googleMapsStyle.js"></script>
    <script src="/assets/js/testJson.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC7i0o5mdEYSbG_wqoWAx53tAP1xxTKVQo&callback=initMap" async defer></script>
    <script src="/assets/js/Maps.js"></script>
@layout('layout.foot')