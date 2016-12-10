<a href="/recipie/item/{{$recipe->id}}">
    <article class="food-preview">
        <div class="col-6 col-m-12">
            <div class="recipie-preview col-12" style="background-image: url('{{$recipe->image}}');"></div>
        </div>
        <div class="col-6 col-m-12">
            <h4 class="uppercase">{{ $recipe->name }}</h4>    
            <small><i>Skrevet av {{$recipe->getUser()->username}}</i></small>
            <p>@sub($recipe->description).</p>
            
        </div>
    </article>
</a>