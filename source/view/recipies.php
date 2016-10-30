@layout('layout.head')


<main>

    <section class="row primary-header" style="background-image: url('/assets/img/recipis/kingcrab.jpg')">

        <h1 class="primary-header-text center">Oppskrifter</h1>
        

    </section>
    <div class="container">
        @foreach($food as $v)

            @layout('layout.article_front', ['v' => $v])

        @endforeach
    </div>
</main>


@layout('layout.foot')