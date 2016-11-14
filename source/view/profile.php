@layout('layout.head')

	<main>
	    <section class="row primary-header" style="background-image: url('/assets/img/recipis/reindeer_large.jpg')">
          <h1 class="primary-header-text center">Din Profil</h1>
        </section>

  		<section  class="container">
  			<h1 class="page-header center underline">{{$user->username}}</h1>
  			<div class="col-6 col-l-8 col-m-4 col--center">
  			</div>
        <div class="row">
          <!-- user image -->
          <div class="col-4 col-l-4 col-m-12">
            <div class="col-12">
              <input type="file" name="name" value="" id="file" hidden>
              <label for="file">
                <img src="../assets/img/recipis/banner.jpg" alt="" /><!-- Legg inn upload knapp i bildet -->
              </label>
            </div>
          </div><!-- /user image -->
          <!-- User info-->
          <div class="col-8 col-l-8 col-m-12">

            <div class="col-6">

              <p>Epost:</p>
              <p>{{$user->mail}}</p>
            </div>
            <div class="col-6">
              <!--
              <p><i class="icon--small icon-meat icontext"></i>Last opp oppskrift</p>
              <p><i class="icon--small icon-meat"></i>Mine oppskrifter</p>
              <p><i class="icon--small icon-meat"></i>Favoritter</p>
            -->
            <ul class="list-simple">
              <li><i class="icon--small icon-meat icontext">Last opp oppskrift</i></li>
            </ul>
            </div>

          </div><!-- /User info-->

          <div class="row">
            <div class="col-12">
              @foreach($user->getAllRecipes() as $recipe)

                  @layout('layout.article_front', ['recipe' => $recipe])

              @endforeach
            </div>
          </div>
        </div><!-- article_front -->
  		</section>
	<main>

@layout('layout.foot')
