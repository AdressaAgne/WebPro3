@layout('layout.head')


<main>

    <section class="row primary-header" style="background-image: url('/assets/img/recipis/oppskriftbanner.jpg')">

        <h1 class="primary-header-text center">Oppskrifter</h1>
        

    </section>
    <div class="container">
	    <div class="col-4">
	    	search
	    </div>
	    <div class="col-8">
	        @foreach($food as $res)
				<div class="col-4">
		            @layout('layout.recipie', ['res' => $res])
				</div>
	        @endforeach
	     </div>
    </div>
</main>


@layout('layout.foot')