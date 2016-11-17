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
       <h1 class="page-header underline center">Oppskrifter</h1>
       @foreach($food as $recipe)

           @layout('layout.article_front', ['recipe' => $recipe])

       @endforeach

       <h1 class="page-header underline center">Nyheter</h1>

       @foreach($food as $recipe)

           @layout('layout.article_front', ['recipe' => $recipe])

       @endforeach
    </section>
</main>
@layout('layout.scripts')

<script src="assets/js/min/search-min.js"></script>
@layout('layout.foot')
