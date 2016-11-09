<a href="/recipie/item/{{$res->id}}">
    <article class="col-12">
        <div class="recipie-preview" style="background-image: url('/assets/img/recipis/{{$res->image}}');">
            
        </div>
        <div class="recipie-text">{{ $res->name}}</div>

    </article>
</a>