@layout('layout.head')


<main>

    <section class="row primary-header" style="background-image: url('/assets/img/recipis/banner.jpg')">

        <h1 class="primary-header-text center">Oppskrifter</h1>

    </section>
    <div class="container">
        <div class="row row--line">
            <div class="col-8">
		       <ul class="list-simple--horisontal">
		           <li><a href="/recipie/insert">Lag Ny Oppskrift</a></li>
		       </ul>
	        </div>
	        <div class="col--right">
		       <ul class="list-simple--horisontal" id="sortering">
		           <li><a href="#Nyeste" name="sorting" value="nyeste">Nyeste</a></li>
		           <li><a href="#Bestrangert" name="sorting" value="beste">Best rangert</a></li>
		           <li><a href="#aa" name="sorting" value="alfabetisk">A - Å</a></li>
		       </ul>
	        </div>
        </div>

	    <div class="row">
	        <div class="col-4">
                <div class="search col-8">
                    <label class="search-box" for="search">
                        <input class="search-one" type="search" placeholder="Søk..." value="">
                    </label>
                    <label class="search-icon">
                        <a><i class="icon-search--white icon--small icon--center"></i></a>
                    </label>
                </div>


	            <div class="res-categorie">
	                <h2> RÅVARE </h2>
	                <ul>
                        @foreach($category_zero as $cat)
                            <li>
                                <input type="checkbox" name="" id="cat-{{$cat['id']}}" value="{{$cat['id']}}">
                                <label class="checkbox" for="cat-{{$cat['id']}}">{{ ucfirst($cat['name']) }}</label>
                            </li>
                        @endforeach
	                </ul>
	            </div>
	            <div class="res-categorie">
	                <h2> TYPE RETT </h2>
	                <ul>
	                    @foreach($category_one as $cat)
                            <li>
                                <input type="checkbox" name="" id="cat-{{$cat['id']}}" value="{{$cat['id']}}">
                                <label class="checkbox" for="cat-{{$cat['id']}}">{{ ucfirst($cat['name']) }}</label>
                            </li>
                       @endforeach
	                </ul>
	            </div>
	        </div>
	        <div class="col-8">
	            @foreach($food as $res)
	                        <div class="col-4 col-m-6">
	                            @layout('layout.recipie', ['res' => $res])
	                        </div>
	            @endforeach
	         </div>
	    </div>
    </div>
</main>

@layout('layout.scripts')

<script>
  $("#sortering li a").on("click", function(e){
    e.preventDefault();
    $.post({
      url : "recipie/rating",
      data : $(this).attr("value")
    });
  });
</script>

@layout('layout.foot')
