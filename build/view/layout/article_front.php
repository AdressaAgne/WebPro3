 
<a href="/recipie/item/{{$v['id']}}">
    <article class="row food-preview">
        <div class="col-6 food-preview__text">
            <div class="content">
                <h1 class="page-header underline">{{ $v['name'] }}</h1>
                <p>{{ substr($v['description'], 0 , 170) }}...</p>
            </div>
        </div>
        <div class="col-6 food-preview__image" style="background-image: url('/assets/img/recipis/{{$v['image']}}');"></div>
    </article>
</a>