 
<a href="/taxon/item/{{$tax['taxonID']}}">
    <article class="row food-preview">
        <div class="col-6 food-preview__text">
            <div class="content">
                <h1 class="page-header underline">{{ ucfirst($tax['navn']) }}</h1>
                <p><em>{{$tax['scientificName']}}</em></p>
            </div>
        </div>
        <div class="col-6 food-preview__image" style="background-image: url('/assets/img/recipis/kingcrab.jpg');"></div>
    </article>
</a>