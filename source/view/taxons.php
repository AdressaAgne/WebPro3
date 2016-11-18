@layout('layout.head')


<main>

    <section class="row primary-header" style="background-image: url('/assets/img/arter/banner.jpg')">

        <h1 class="primary-header-text center">Arter</h1>
    </section>
    <div class="container">
        <div class="row row--line">
            <div class="col--right">
    	       <ul class="list-simple--horisontal">
    	       		<div class="dropdown">
	    	           <li class="dropbtn"><a href="#">Alle kategorier</a>
	    	           		<div class="dropdown-content"><ul>
	    	           			@foreach($categories as $key => $cat)       
	    	           			    <li><a href="#">{{ ucfirst($cat['name'])}}</a></li>
	    	           			@endforeach 		
	    	           		</ul></div></li>
    	           		</div>
    	           <li><a href="#">Høyeste risiko</a></li>
    	           <li><a href="#">A - Å</a></li>   
    	           <li><input type="search" id="artsearchfield" style="display: none;"></li>
    	           <li id="artsearch">SØK</li>
    	       </ul>
            </div>
        </div>
    
    <div class="container col-8">
        @foreach($taxon as $tax)
			<div class="col-4 col-m-6">
            	@layout('layout.taxon', ['tax' => $tax])
			</div>
        @endforeach
    </div>
</main>
@layout('layout.scripts')

<script src="/assets/js/min/artsearch-min.js"></script>

@layout('layout.foot')

