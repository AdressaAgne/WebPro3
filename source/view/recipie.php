@layout('layout.head')


<main>

    <section class="container">

        <div class="row recipie-view">
            <div class="col-4 col-m-6">
               <img src="{{$recipie->image}}"/>


            <p>Lagre som favoritt </p>
            <p>Vurder denne oppskriften</p>
            <p>2 Kommentarer </p>

            <!-- Rating btns -->
            <span class="star-rating">
              <input type="radio" name="rating" value="1"><i></i>
              <input type="radio" name="rating" value="2"><i></i>
              <input type="radio" name="rating" value="3"><i></i>
              <input type="radio" name="rating" value="4"><i></i>
              <input type="radio" name="rating" value="5"><i></i>
            </span>




          </div><!-- col -->




            <div class="col-8 col-m-6">
                <div class="col-12 res-desc">
                    <h1>{{$recipie->name}}</h1>
                    <h3>Description</h3>
                    <p>{{$recipie->desc}}</p>
                </div>

                <div class="row">
                    <div class="col-4 col-m-12">
                        <h3>Ingredients</h3>
                         <ul class="ingredients">
                             @foreach($recipie->getIngrediets() as $key => $i)
                                 <li>{{ $i }}</li>
                             @endforeach
                         </ul>
                     </div>
                     <div class="col-8 col-m12">
                        <h3>What to do</h3>
                        <p>{{$recipie->how}}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <ul class="list-simple--horisontal">

                @foreach($recipie->getCategories() as $key => $cat)

                    <li>{{$cat}}</li>

                @endforeach

            </ul>


        </div>

    </section>

</main>

@layout('layout.scripts')

<script>
  $(".star-rating input").on("click", function(){
    console.log($(this).val());
  });
</script>

@layout('layout.foot')
