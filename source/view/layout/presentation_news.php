<a href="/recipie/item/{{$recipe->id}}">
    <article class="">
        <div class="no-padding col-4 col-m-12 front-article-img">
            <div class="recipie-preview col-12" style="background-image: url('{{$recipe->image}}');"></div>
        </div>
        <div class="no-padding col-8 col-m-12">
            <div class="news-text">
                <h4 class="uppercase">{{ $recipe->name }}</h4>
                <p>{{ substr($recipe->desc, 0 , 120) }}...</p>
            </div>
        </div>
    </article>
</a>