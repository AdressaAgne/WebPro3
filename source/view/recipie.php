@layout('layout.head')


<main>

    <section class="container"> 
   
        <div class="row recipie-view">
            <div class="col-4 col-m-6">
               <img src="{{$recipie->image}}"/>
            
            
            <p>Lagre som favoritt </p>
            <p>Vurder denne oppskriften</p>
            <p>2 Kommentarer </p>
            </div>

            <div class="col-8 col-m-6">
		            <div class="col-12 res-des">
		            	<h1>{{$recipie->name}}</h1>     	
			            <h3>Description</h3>
			            <p>{{$recipie->desc}}</p> 	
		            </div>
                
                	<div class="row">
                		<div class="col-4 col-m-12">
							<h3>Ingredients</h3>
							 <ul class="ingredients">
							     @foreach($recipie->getIngrediets() as $key => $i)
							         <li>{{ $i }}</li>
							     @endforeach
							 </ul>
						 </div>
						 <div class="col-8 col-m12">
			                <h3>What to do</h3>
			                <p>{{$recipie->how}}</p>
		                </div>
	                </div>
            </div>
        </div> 

    </section>

</main>


@layout('layout.foot')