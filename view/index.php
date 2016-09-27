@layout('layout.head')


<main>
    
    <section class="row primary-header" style="background-image: url('/assets/img/recipis/reindeer_large.jpg')">
        <div class="container">
            <i class="icon-logo icon--gigantic icon--center"></i>
        </div>
    </section>
    
   
    <section class="container__side--small visible-m">
        
        <div class="container">
            
            <h2 class="page-header"><i class="icon-no_gluten--white icon--header"></i> Gluten Fri Oppskrifter</h2>
            
        </div>
        
    </section>
    
    <section class="container">
       
       @foreach($food as $value)
       
           @layout('layout.article_front', ['title' => $value, 'text' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Non, necessitatibus.', 'image' => '/assets/img/recipis/pasta.jpg'])
       
       @endforeach
       
       
       @layout('layout.article_front_left', ['title' => 'Reinstyrs Gryte', 'text' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vero, tempora.', 'image' => '/assets/img/recipis/reindeer_large.jpg'])
        
    </section>
</main>


@layout('layout.foot')