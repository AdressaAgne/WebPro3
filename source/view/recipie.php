@layout('layout.head')


<main>

    <section class="row primary-header" style="background-image: url('/assets/img/recipis/{{$r['image']}}')">

        <h1 class="primary-header-text center">{{$r['name']}}</h1>
   
    </section>

    <section class="container">  
       
        <div class="row">
            <div class="col-3">
               <h3 class="center">Ingredients</h3>
                <ul class="ingredients">
                    @foreach($i as $key => $ingre)
                        <li>{{ $ingre['amount'].$ingre['unit'] }} {{$ingre['name']}}</li>
                    @endforeach
                </ul>
            </div>

            <div class="col-9">
                <h3>Description</h3>
                <p>{{$r['description']}}</p>

                <h3>What to do</h3>
                <p>{{$r['how']}}</p>
            </div>
        </div>

    </section>

</main>


<!--@layout('layout.foot')-->