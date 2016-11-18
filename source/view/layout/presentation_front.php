<a href="/recipie/item/{{$recipe->id}}">
    <article class="food-preview front-article">
        <div class="col-5 recipie-preview front-article-img" style="background-image: url('{{$recipe->image}}');"></div>
        <div class="col-6 front-article-text">
            <div class="content">
                <h4 class="uppercase">{{ $recipe->name }}</h4>
                <p>Skrevet av {{$recipe->getUser()->username}}</p>
                <p>{{ substr($recipe->desc, 0 , 70) }}...</p>
            </div>
        </div>
    </article>
</a>