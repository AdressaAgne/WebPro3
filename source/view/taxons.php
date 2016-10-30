@layout('layout.head')


<main>

    <section class="row primary-header" style="background-image: url('/assets/img/recipis/kingcrab.jpg')">

        <h1 class="primary-header-text center">Arter</h1>
        

    </section>
    <div class="container">
        @foreach($taxon as $tax)

            @layout('layout.taxon', ['tax' => $tax])

        @endforeach
    </div>
</main>


@layout('layout.foot')