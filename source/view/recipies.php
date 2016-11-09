@layout('layout.head')


<main>

    <section class="row primary-header" style="background-image: url('/assets/img/recipis/oppskriftbanner.jpg')">

        <h1 class="primary-header-text center">Oppskrifter</h1>
        
    </section>
    <div class="container">
        <div class="col-12" >
	        <div class="float res-nav">
		        <p>Nyeste</p>
		        <p>Best rangert </p>
		        <p> A - Å </p>
		       
	        </div>
	        <div class="line"></div>
        </div>
        
    <div class="container ">
    
	    <div class="col-4">
	    	<div class="res-search">
	    	   <input type="search" name="res-search" placeholder="søk i oppskrifter">
	    	</div>
	    	<div class="res-categorie">
	    		<h2> RÅVARE </h2>
	    		<ul>
		    		<li><label><input type="checkbox" name="" value="fisk">Fisk</label> </li>
		    		<li><label><input type="checkbox" name="" value="skalldyr">Skalldyr</label></li>
		    		<li><label><input type="checkbox" name="" value="urter">Urter</label></li>
		    		<li><label><input type="checkbox" name="" value="rovdyr">Rovdyr</label></li>
		    		<li><label><input type="checkbox" name="" value="insekter">Insekter</label></li>
		    		<li><label><input type="checkbox" name="" value="fruktogberry">Frukt og bær</label></li>
		    		<li><label><input type="checkbox" name="" value="vegetables">Grønnsaker</label></li>
		    		<li><label><input type="checkbox" name="" value="poultry">Fjærkre</label></li>
	    		</ul>
	    	</div>
	    	<div class="res-categorie">
	    		<h2> TYPE RETT </h2>
	    		<ul>
	    			<li><label><input type="checkbox" name="" value="frokost">Frokost</label> </li>
	    			<li><label><input type="checkbox" name="" value="lunsj">Lunsj</label></li>
	    			<li><label><input type="checkbox" name="" value="middag">Middag</label></li>
	    			<li><label><input type="checkbox" name="" value="snacks">Snacks</label></li>
	    			<li><label><input type="checkbox" name="" value="insekter">Insekter</label></li>
	    			<li><label><input type="checkbox" name="" value="tilbehor">Tilbehør</label></li>
	    		</ul>
	    	</div>
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