@layout('layout.head')

<main>

    <section class="row primary-header" style="background-image: url('/assets/img/recipis/lask.jpg')">
        <div class="background-overlay">
            <div class="row">
                <div class="col-12">
                    <i class="icon-logo--white icon--gigantic icon--center"></i>
                    <div class="search col-l-4 col-4 col-m-8 col--center">
                        <label class="search-box" for="search">
                            <input type="search" placeholder="Søk etter art eller oppskrift..." value="">
                        </label>
                        <label class="search-icon searchbtn">
                            <a href="#"><i class="icon-search--theme icon--small icon--center"></i></a>
                        </label>
                        <label class="search-icon geobtn">
                            <a href="/nearby"><i class="icon-geo--theme icon--small icon--center"></i></a>
                        </label>

                        <div class="search-result" hidden="">
                            <ul id="search-result">

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="container">
     <div class="row">
             
          <div class="col-6">
               <h3 class="page-header center uppercase">Nyeste Oppskrifter</h3>
               @foreach($newest as $recipe)
                    <div class="col-12">
                        @layout('layout.presentation_front', ['recipe' => $recipe])
                    </div>
               @endforeach
           </div>
           <div class="col-6">    
               <h3 class="page-header center uppercase">Best rangerte oppskrifter</h3>

               @foreach($ratings as $recipe)
                    <div class="col-12">
                        @layout('layout.presentation_front', ['recipe' => $recipe])
                    </div>
               @endforeach
         </div>
     </div>
    </section>
    <section class="container">
       
        <div class="row">
            <div class="col-12 col--center">
                <h2 class="page-header center uppercase" id="news">Nyheter</h2>
            </div>
        </div>

        <div class="col-10 col-m-12 col--center">
            <div class="row news clearfix">
                <div class="col-4 col-m-6">
                    <img src="assets/img/news/bent.jpg"/>
                </div>
                <div class="col-8 col-m-6">
                    <a href="#news"><h3 class="sub-header uppercase"> Nyttige tips fra kokken </h3></a>
                    <p>Jesper Victor, Kokk ved Restaurant Østersen,  gir deg 
                    sine beste tips for å tilbedre Regnbueørret. There are many
                     variations of passages of Lorem Ipsum available, but the
                     majority have suffered alteration in some form, by injected 
                     humour, or randomised words which don't look even slightly 
                     believable.
                    </p>
                    <p><a href="#news"><strong>LES MER</strong></a></p>
                </div>
            </div>

            <div class="row news clearfix">
                <div class="col-4 col-m-6">
                    <img src="assets/img/news/osters.jpg"/>
                </div>
                <div class="col-8 col-m-6">
                    <a href="#news"><h3 class="sub-header uppercase"> Stadig mer Stillehavsøsters </h3></a>
                    <p>Det har blitt gjort mange ere observasjoner
                        av Stillehavsøsters det siste året. Økningen er
                        på omtrent 30 prosent, og det er i Oslofjordområdet
                        økningen er størst. Dette bekymrer havforsker Agne Ødegaard.
                    </p>
                    <p><a href="#news"><strong>LES MER</strong></a></p>
                </div>
            </div>
        </div>
    </section>
</main>
@layout('layout.scripts')

<script src="assets/js/min/search-min.js"></script>
@layout('layout.foot')
