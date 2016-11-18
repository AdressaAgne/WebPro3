@layout('layout.head')

<main>

    <section class="row primary-header" style="background-image: url('/assets/img/recipis/grilledkingcrab.jpg')">
        <div class="background-overlay">
            <div class="row">
                <div class="col-12">
                    <i class="icon-logo--white icon--gigantic icon--center"></i>

                    <div class="search col-l-4 col-4 col-m-8 col--center">
                        <label class="search-box" for="search">
                            <input type="search" placeholder="Finn arter nær deg" value="">
                        </label>
                        <label class="search-icon searchbtn">
                            <a href="#"><i class="icon-search--theme icon--small icon--center"></i></a>
                        </label>
                        <label class="search-icon geobtn">
                            <a href="/nearby"><i class="icon-geo--theme icon--small icon--center"></i></a>
                        </label>

                        <div class="search-result">
                            <ul id="search-result">

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="container">
     <div class="row mainsite">
             
          <div class="no-padding col-6 front-content">
              <div class="first-col">
               <h3 class="page-header center uppercase">Nyeste Oppskrifter</h3>
               @foreach($food as $recipe)
                    <div class="no-padding col-12 front-article">
                        @layout('layout.presentation_front', ['recipe' => $recipe])
                    </div>
               @endforeach
               </div>
           </div>
           <div class="no-padding col-6 front-content"> 
              <div class="second-col"> 
               <h3 class="page-header center uppercase">Best rangerte oppsrkifter</h3>

               @foreach($food as $recipe)
                    <div class="no-padding col-12 front-article">
                        @layout('layout.presentation_front', ['recipe' => $recipe])
                    </div>
               @endforeach
               </div> 
         </div>
     </div>
    </section>
</main>
@layout('layout.scripts')

<script src="assets/js/min/search-min.js"></script>
@layout('layout.foot')
