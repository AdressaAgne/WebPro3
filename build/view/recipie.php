@layout('layout.head')


<main>

    <section class="row primary-header" style="background-image: url('/assets/img/recipis/kingcrab.jpg')">

        <h1 class="primary-header-text center">{{$taxon}}</h1>
   
    </section>

    <section class="container">
            <div class="col-4 col-m-6">
                <img src="/assets/img/recipis/kingcrab.jpg" alt="">
            </div>
            <div class="col-8 col-m-6">
                <h1 class="page-header">Kongekrabbe <small>Skrevet av navn etternavn</small></h1>
                
                <div class="col-6">
                    <ul>
                        <li>mat</li>
                        <li>kongekrabbe</li>
                    </ul>
                </div>
                
                <div class="col-6">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Praesentium pariatur rerum hic eos culpa placeat itaque sunt minima. Vitae corporis quis, consectetur et cumque similique repudiandae, necessitatibus porro eveniet tempora?</p>
                </div>
                
            </div>
    </section>

</main>


@layout('layout.foot')