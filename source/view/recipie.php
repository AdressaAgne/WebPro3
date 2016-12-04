@layout('layout.head')


<main>
    <section class="row primary-header" style="background-image: url('/assets/img/recipis/banner2.jpg')"></section>
    <section class="container">


        @if(Account::isLoggedIn())
          <div class="row row--line">
            <div class="col--right">
             <ul class="list-simple--horisontal">
               <li><a href="" id="favorite">Legg til som favoritt</a></li>
               @if($recipie->user_id == Account::get_id())
                  <li><a href="/edit/recipie/item/{{$recipie->id}}" id="{{$recipie->id}}">Rediger oppskrift</a></li>
               @endif
             </ul>
            </div>
          </div>
        @endif


        <div class="row recipie-view">
            <div class="row">
                <div class="col-4">
                    <img src="{{$recipie->image}}"/>

                    <div class="col-12">
                        <h3 class="sub-header">Vurder</h3>
                        @if(Account::isLoggedIn())
                            @form('', 'update')
                            <span class="star-rating">
                                <input type="radio" name="rating" value="1"><i></i>
                                <input type="radio" name="rating" value="2"><i></i>
                                <input type="radio" name="rating" value="3"><i></i>
                                <input type="radio" name="rating" value="4"><i></i>
                                <input type="radio" name="rating" value="5"><i></i>
                            </span>
                            @formend()
                        @else
                            <span>Login for a vurdere</span>
                        @endif
                        <ul class="ratings">
                             <p>Vurdert til {{ (int) $recipie->rating }} av {{ $recipie->total}} totalt vurderinger</p>
                        </ul>
                        <script>
                          document.querySelector('[name=rating]:nth-of-type({{ (int) $recipie->rating }})').setAttribute('checked', 'checked');
                        </script>
                    </div>

                    <div class="col-12">
                        <h3>Ingredients</h3>
                        <ul class="ingredients">
                            @foreach($recipie->getIngrediets() as $key => $i)
                                <li>{! $i !}</li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="col-12">
                    	<h3> Kategorier </h3>
                        <ul class="list-simple--horisontal">
                            @foreach($recipie->getCategories() as $key => $cat)
                                <li><a href="/recipie/category">{{ ucfirst($cat['name'])}}</a></li>
                            @endforeach
                        </ul>
                  	</div>
                 </div>
                 <div class="col-8 col-m12">
                    <div class="col-12 res-desc">
                        <h1 class="sub-header">{{$recipie->name}}</h1>
                        <h3></h3>
                        <p>@format($recipie->description)</p>
                    </div>

                    <div class="col-12 res-desc">
                        <h3 class="sub-header">Hvordan</h3>
                        <div class="col--center">@format($recipie->how)</div>
                    </div>

                    <div class="col-12 res-desc">

                        @if(Account::isLoggedIn())
                            @form('/recipie/comment', 'put')
                            <h3 class="sub-header">Skriv en kommentar</h3>
                            <textarea name="content" id="" cols="30" rows="5" class="dark" placeholder="Din kommentar her"></textarea>
                            <input type="hidden" name="id" value="{{$recipie->id}}">
                            <input type="submit" value="Send">
                            @formend()
                        @else
                            <h3 class="sub-header"><a href="/login">Login</a> og skriv en kommentar</h3>
                        @endif

                    </div>

                    <div class="col-12 res-desc" id="comments">
                        <h3 class="sub-header">Kommentarer</h3>
                        @foreach($recipie->getComments() as $key => $comment)

                            <div class="comment">
                                <a href="/users/{{$comment->user()->username}}"><div class="image" style="background-image: url('{{$comment->user()->avatar_thumb}}');"></div></a>
                                <div class="name"><h3><a href="/users/{{$comment->user()->username}}">{{$comment->user()->username}}</a></h3></div>
                                <div class="content">{{ $comment->content }}</div>
                            </div>

                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <h1 class="page-header underline center">Relatert til {{$recipie->name}}</h1>
            @foreach($recipie->getRelated() as $res)
                <div class="col-4 col-m-6">
                    @layout('layout.recipie', ['res' => $res])
                </div>
            @endforeach
        </div>
    </section>

</main>

@layout('layout.scripts')

<script>
  //Give rating
  $(".star-rating input").on("click", function(){
    console.log('ajax');
    $.post({
      url: "recipie/rating",
      data: {
        rating : $('[name=rating]:checked').val(),
        _method : 'update',
        _token : $('[name=_token]').val(),
        id : {{$recipie->id}}
      },
      success : function(data) {
        console.log(data);
      },
      error : function(){
        console.log("failed to update rating");
      }
    });
  });

  //favorite
  $('#favorite').on('click', function(e){
    e.preventDefault();
    $.post({
      url: "recipie/item/favorite",
      data: {
        _method : 'POST',
        _token : $('[name=_token]').val(),
        recipe_id : "{{$recipie->id}}"
      },
      success : function(data) {
        console.log(data);
      },
      error : function(){
        console.log("failed to favorize");
      }
    });
  });
</script>

@layout('layout.foot')
