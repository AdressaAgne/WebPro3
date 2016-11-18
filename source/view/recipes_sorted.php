<div class="col-8">
    @foreach($result as $res)
                <div class="col-4 col-m-6">
                    @layout('layout.recipie', ['res' => $res])
                </div>
    @endforeach
 </div>
