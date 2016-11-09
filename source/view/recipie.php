@layout('layout.head')


<main>

    <section class="row primary-header" style="background-image: url('{{$recipie->image}}')">

        <h1 class="primary-header-text center">{{$recipie->name}}</h1>
   
    </section>

    <section class="container">  
       
        <div class="row">
            <div class="col-3">
               <h3 class="center">Ingredients</h3>
                <ul class="ingredients">
                    @foreach($recipie->getIngrediets() as $key => $i)
                        <li>{{ $i }}</li>
                    @endforeach
                </ul>
            </div>

            <div class="col-9">
                <h3>Description</h3>
                <p>{{$recipie->desc}}</p>

                <h3>What to do</h3>
                <p>{{$recipie->how}}</p>
            </div>
        </div>

    </section>

</main>


@layout('layout.foot')