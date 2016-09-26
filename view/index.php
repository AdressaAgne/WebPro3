@layout('layout.head')


<main>
    
    <nav class="nav">
        <div class="container">
            <ul class="nav--left">
                <li class="nav__item"><a href="#"><i class="icon-knife--white icon--small icon--text"></i> Hjem</a></li>
                <li class="nav__item"><a href="#"><i class="icon-pan--white icon--small icon--text"></i> Oppskrifter</a></li>
                <li class="nav__item"><a href="#"><i class="icon-fish--white icon--small icon--text"></i> Arter i Nærheten</a></li>
                <li class="nav__item"><a href="#"><i class="icon-wheat--white icon--small icon--text"></i> Visjon</a></li>
            </ul>
            <ul class="nav--right">
                <li class="nav__item"><a href="#">Profil</a></li>
            </ul>
        </div>
    </nav>
    
    
    <section class="row primary-header" style="background-image: url('/assets/img/recipis/reindeer_large.jpg')">
        <div class="container">
            <i class="icon-soup--white icon--gigantic icon--center"></i>
        </div>
    </section>
    
    <section class="row secondary-header">
        <div class="container">
            <i class="icon-wheat--white icon--small"></i>
            <i class="icon-wheat--white"></i>
            <i class="icon-wheat--white icon--large"></i>
            <a href="/no-gluten">
                <section class="container__side">
                    <h1 class="page-header center">Gluten free recipies</h1>
                    <i class="icon-no_gluten--white icon--large icon--center icon--margin"></i>
                </section>
            </a>
        </div>
    </section>
    
    <div class="container">
        <article class="row food-preview">
            <div class="col-6 food-preview__text">
                <h1 class="page-header underline">Hjemme Laget Pasta</h1>
                <p>The best pasta recipie you wil ever taste</p>
            </div>
            <div class="col-6 food-preview__image" style="background-image: url('/assets/img/recipis/pasta.jpg');"></div>
        </article>
        
        
    </div>
</main>


@layout('layout.foot')