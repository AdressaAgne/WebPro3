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
               <li><a href="#">Favoritter</a></li>
           </ul>
          </div>
          <div class="col--right">
           <ul class="list-simple--horisontal">
               <li><a href="/profile/update">Rediger profil</a></li>
           </ul>
          </div>
        </div>

        <div class="row">
  		     <h1 class="page-header center underline">{{$user->username}}</h1>
        <!-- user image -->
          <div class="col-4 col--center">
            <label for="file" class="circle-drop" id="drop-container" style="background-image: url('{{$user->avatar_thumb}}')">
                <svg height="150" width="150" class="pie-chart" id="svg">
                    <circle class="behind"cx="50%" cy="50%" r="40%" />
                    <circle class="front" cx="50%" cy="50%" r="40%" data-percent="0" />
                    <text y="80" transform="translate(80)">
                       <tspan x="0" text-anchor="middle">0%</tspan>
                    </text>
                </svg>
            </label>
            @form()
         <input type="file" id="file" hidden="">
         @formend()
          </div>
        </div>
        <div class="row">
            <h1 class="page-header underline center">Mine oppskrifter</h1>

            @foreach($user->getAllRecipes() as $recipe)
                <div class="col-4 col-m-6">
                    @layout('layout.recipie', ['res' => $recipe])
                </div>
            @endforeach
        </div>
  		</section>
	<main>
@layout('layout.scripts')
<script src="/assets/js/min/profile-min.js"></script>
@layout('layout.foot')
