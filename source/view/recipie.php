@layout('layout.head')


<main>
    <section class="row primary-header" style="background-image: url('/assets/img/recipis/reindeer_large.jpg')"></section>
    <section class="container">

        <div class="row recipie-view">
            <div class="row">
                <div class="col-4">
                    <img src="{{$recipie->image}}"/>

                    <div class="col-12">
                        <h3 class="sub-header">Vurder</h3>
                        @form('', 'update')
                        <span class="star-rating">
                            <input type="radio" name="rating" value="1"><i></i>
                            <input type="radio" name="rating" value="2"><i></i>
                            <input type="radio" name="rating" value="3"><i></i>
                            <input type="radio" name="rating" value="4"><i></i>
                            <input type="radio" name="rating" value="5"><i></i>
                        </span>
                        @formend()
                    </div>

                    <div class="col-12">
                        <h3>Ingredients</h3>
                        <ul class="ingredients">
                            @foreach($recipie->getIngrediets() as $key => $i)
                                <li>{! $i !}</li>
                            @endforeach
                        </ul>
                    </div>
                 </div>
                 <div class="col-8 col-m12">
                    <div class="col-12 res-desc">
                        <h1 class="sub-header">{{$recipie->name}}</h1>
                        <h3>Description</h3>
                        <p>@format($recipie->desc)</p>
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
                                    <a href="/users/{{$comment->user->username}}"><div class="image" style="background-image: url('{{$comment->user->avatar_thumb}}');"></div></a>
                                    <div class="name"><h3><a href="/users/{{$comment->user->username}}">{{$comment->user->username}}</a></h3></div>
                                    <div class="content">{{ $comment->content }}</div>
                                </div>


                        @endforeach
                    </div>

                </div>
            </div>
        </div>
        <div class="row">
            <ul class="list-simple--horisontal">

                @foreach($recipie->getCategories() as $key => $cat)

                    <li>{{$cat}}</li>

                @endforeach

            </ul>


        </div>

    </section>

</main>

@layout('layout.scripts')

<script>
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
      }
    });
  });
</script>

@layout('layout.foot')
