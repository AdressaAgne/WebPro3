@layout('layout.head', $user)

<main>
    
    <section class="row primary-header" style="background-image: url('/assets/img/recipis/oyster.jpg')">
        <div class="background-overlay">
            <div class="container">
                <i class="icon-logo icon--gigantic icon--center"></i>

                <div class="search col-l-4 col-6 col-m-8 col--center">
                    <label class="search-box" for="search">
                        <input type="search" placeholder="Finn arter nær deg" value="">
                    </label>
                    <label class="search-icon">
                        <a href="#"><i class="icon-search--white icon--small icon--center"></i></a>
                    </label>
                    <label class="search-icon">
                        <a href="/nearby"><i class="icon-geo--white icon--small icon--center"></i></a>
                    </label>
                    
                    <div class="search-result">
                        <ul id="search-result">

                        </ul>   
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <section class="container">
       <h1 class="page-header underline center">Oppskrifter</h1>
       @foreach($food as $v)
       
           @layout('layout.article_front', ['v' => $v])
       
       @endforeach
       
       <h1 class="page-header underline center">Nyheter</h1>
       
       @foreach($food as $v)
       
           @layout('layout.article_front', ['v' => $v])
       
       @endforeach
    </section>
</main>
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<script src="assets/js/min/search-min.js"></script>
@layout('layout.foot')