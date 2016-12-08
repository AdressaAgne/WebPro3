@layout('layout.head')
<main>
  <section class="row primary-header" style="background-image: url('/assets/img/recipis/reindeer_large.jpg')">
        <h1 class="primary-header-text center">Dine Favoritter</h1>
    </section>

@foreach($recipe as $res)
    <div class="col-4 col-m-6">
        @layout('layout.recipie', ['res' => $res])
    </div>
@endforeach
</main>



@layout('layout.scripts')
@layout('layout.foot')
