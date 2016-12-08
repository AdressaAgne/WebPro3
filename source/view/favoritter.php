@layout('layout.head')
<main>
    <section class="row primary-header" style="background-image: url('/assets/img/recipis/reindeer_large.jpg')">
        <h1 class="primary-header-text center">Din Profil</h1>
    </section>
	<section class="container">
		<div class="row row--line">
		    <div class="col-8">
		   <ul class="list-simple--horisontal">
		       <li><a href="/recipie/insert">Lag Ny Oppskrift</a></li>
		       <li><a href="/profile">Profil</a></li>
		   </ul>
		  </div>
		  <div class="col--right">
		   <ul class="list-simple--horisontal">
		       <li><a href="/profile/update">Rediger profil</a></li>
		   </ul>
		  </div>
		</div>
		<div class="row">
			<h3 class="page-header"> Dine favoritter </h3>
				@foreach($recipe as $res)
		    <div class="col-4 col-m-6">
		        @layout('layout.recipie', ['res' => $res])
	   		 </div>
			@endforeach
		</div>
</main>

@layout('layout.scripts')
@layout('layout.foot')
