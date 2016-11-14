@layout('layout.head')

	<main>
	    <section class="row primary-header" style="background-image: url('/assets/img/recipis/reindeer_large.jpg')">
        <h1 class="primary-header-text center">Din Profil</h1>
      </section>
  		<section class="container">
        <div class="row row--line">
            <div class="col-8">
           <ul class="list-simple--horisontal">
               <li><a href="/recipie/insert">Ny Oppskrift</a></li>
               <li><a href="#">Favoritter</a></li>
           </ul>
          </div>
          <div class="col--right">
           <ul class="list-simple--horisontal">
               <li><a href="#Nyeste">Rediger progil</a></li>

           </ul>
          </div>
        </div>

        <div class="row">
  		     <h1 class="page-header center underline">{{$user->username}}</h1>
        <!-- user image -->
          <div class="col-4 col--center">
            <input type="file" name="name" value="" id="file" hidden>
            <label for="file">
              <img src="../assets/img/recipis/banner.jpg" alt="" /><!-- Legg inn upload knapp i bildet -->
            </label>
          </div>
        </div>
        <div class="row">
          <h1 class="page-header underline center">Mine oppskrifter</h1>

            @foreach($user->getAllRecipes() as $recipe)

                  @layout('layout.article_front', ['recipe' => $recipe])

            @endforeach
        </div>
  		</section>
	<main>

@layout('layout.foot')
