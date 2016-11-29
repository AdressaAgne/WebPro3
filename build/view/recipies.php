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
               <input type="hidden" value="@csrf()" name="_token">
		           <li><a href="" name="sorting" data-value="nyeste">Nyeste</a></li>
		           <li><a href="" name="sorting" data-value="beste">Best rangert</a></li>
		           <li><a href="" name="sorting" data-value="alfabetisk">A - Å</a></li>
		       </ul>
	        </div>
        </div>

	    <div class="row">
	        <div class="col-3">
                <div class="search col-12">
                    <label class="search-box" for="search">
                        <input class="search-one" type="search" placeholder="Søk..." value="">
                    </label>
                    <label class="search-icon searchbtn">
                        <a><i class="icon-search--theme icon--small icon--center"></i></a>
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
          <div id='loading' style='display:none;'>
            <label for="file">
                <svg height="150" width="150" class="pie-chart processing" id="svg">
                  <circle class="behind"cx="50%" cy="50%" r="40%" />
                  <circle class="front" cx="50%" cy="50%" r="40%" data-percent="0" />
                </svg>
            </label>
          </div>
	        <div class="col-9" id="recipes">

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
  //Sortering
  var order = true;
  $("#sortering li a").on("click", function(e){
    $("#recipes").fadeOut(50, function(){});
    e.preventDefault();
    var _this = this;

    $('#loading').show();

    $.post({
      url : "/recipie/sort",
      data : {
        sortingMethod : $(_this).attr('data-value'),
        _token : $('[name=_token]').val(),
        _method : 'post',
        order   : order,
      },
      success : function(data){
        console.log(data);
        order = !order;
        $('#loading').hide();
        $("#recipes").fadeIn(200, function(){});
        $('#recipes').html(data);

        console.log("req done. Sorting by: " + $(_this).attr('data-value'));
      },
      error : function(){
        console.log("req fail");
      }
    });
  });
</script>

<script src="/assets/js/min/sortRecipes-min.js"></script>

@layout('layout.foot')
