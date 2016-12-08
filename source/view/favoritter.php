@layout('layout.head')


@foreach($recipe as $res)
    <div class="col-4 col-m-6">
        @layout('layout.recipie', ['res' => $res])
    </div>
@endforeach




@layout('layout.scripts')
@layout('layout.foot')
