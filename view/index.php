@layout('layout.head')


<main>
    
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
            
            <a href="/no-gluten" class="hidden-m">
                <section class="container__side">
                    <h2 class="page-header center">Gluten Fri Oppskrifter</h2>
                    <i class="icon-no_gluten--white icon--large icon--center icon--margin"></i>
                </section>
            </a>
        </div>
    </section>
    
    <section class="container__side--small visible-m">
        
        <div class="container">
            
            <h2 class="page-header"><i class="icon-no_gluten--white icon--header"></i> Gluten Fri Oppskrifter</h2>
            
        </div>
        
    </section>
    
    <section class="container">
       
       @layout('layout.article_front', ['title' => 'Hjemmelaget Pasta', 'text' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Non, necessitatibus.', 'image' => '/assets/img/recipis/pasta.jpg'])
       
       @layout('layout.article_front_left', ['title' => 'Reinstyrs Gryte', 'text' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vero, tempora.', 'image' => '/assets/img/recipis/reindeer_large.jpg'])
        
    </section>
</main>


@layout('layout.foot')