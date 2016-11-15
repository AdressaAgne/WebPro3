 <a href="/recipie/item/{{$recipe->id}}">
    <article class="row food-preview">
        <div class="col-12 food-preview__image" style="background-image: url('{{$recipe->image}}');"></div>
        <div class="col-12 food-preview__text">
            <div class="content">
                <h1 class="page-header underline">{{ $recipe->name }}</h1>
                <p>{{ substr($recipe->desc, 0 , 170) }}...</p>
            </div>
        </div>
    </article>
</a>