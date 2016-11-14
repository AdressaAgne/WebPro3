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
          <div class="col-4 col-l-4 col-m-12">
            <img src="../assets/img/recipis/banner.jpg" alt="" />
          </div>
          <div class="col-8 col-l-8 col-m-12">
            <img src="../assets/img/recipis/banner.jpg" alt="" />
          </div>

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
