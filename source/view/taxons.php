@layout('layout.head')


<main>

    <section class="row primary-header" style="background-image: url('/assets/img/arter/banner.jpg')">

        <h1 class="primary-header-text center">Arter</h1>
    </section>
    <div class="container">
        <div class="row row--line">
            <div class="col--right">
    	       <ul class="list-simple--horisontal">
    	           <li><a href="#">A - Å</a></li>   
    	           <li><input type="search" id="artsearchfield" style="display: none;"></li>
    	           <li id="artsearch">SØK</li>
    	       </ul>
            </div>
        </div>
        <div class="row">
        	<div class="col-3 res-categorie">
		        <h2> Kategorier </h2>
		        <ul>
		            @foreach($categories as $key => $cat)
		            <li>
		                <input type="checkbox" name="" id="cat-{{$cat['id']}}" value="{{$cat['id']}}">
		                <label class="checkbox" for="cat-{{$cat['id']}}">{{ ucfirst($cat['name']) }}</label>
		            @endforeach
		            </li>
		        </ul>
	        </div>
        
		    <div class="col-9">
		        @foreach($taxon as $tax)
					<div class="col-4 col-m-6">
		            	@layout('layout.taxon', ['tax' => $tax])
					</div>
		        @endforeach
		    </div>
		</div>
</main>
@layout('layout.scripts')

<script src="/assets/js/min/artsearch-min.js"></script>

@layout('layout.foot')

