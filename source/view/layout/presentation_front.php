<a href="/recipie/item/{{$recipe->id}}">
    <article class="food-preview">
        <div class="no-padding col-6 col-m-12 front-article-img">
            <div class="recipie-preview col-12" style="background-image: url('{{$recipe->image}}');"></div>
        </div>
        <div class="no-padding col-6 col-m-12">
            <div class="no-padding col-12">
                <h4 class="uppercase">{{ $recipe->name }}</h4>
                <p>Skrevet av {{$recipe->getUser()->username}}</p>
                <p>{{ substr($recipe->desc, 0 , 50) }}...</p>
            </div>
        </div>
    </article>
</a>