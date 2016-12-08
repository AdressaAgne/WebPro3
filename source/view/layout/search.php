
@if(!empty($taxon))
<li class="search_title"><strong>Arter</strong></li>    
@endif

@foreach($taxon as $t)
    <li><a href="/taxon/item/{{$t['taxonID']}}">{{ $t['navn'] }}</a></li>
@endforeach


@if(!empty($recipe))
<li class="search_title"><strong>Oppskrifter</strong></li>    
@endif

@foreach($recipe as $t)
    <li><a href="/recipie/item/{{$t['id']}}">{{ $t['name'] }}</a></li>
@endforeach