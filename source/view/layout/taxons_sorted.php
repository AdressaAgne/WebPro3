@foreach($taxons as $taxon)
    <div class="col-4 col-m-6">
        @layout('layout.taxon', ['tax' => $taxon])
    </div>
@endforeach
