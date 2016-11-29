@layout('layout.head')

<main>
@form('/recipie/insert','post')
    <section class="row primary-header" style="background-image: url('')">
        <label for="file" class="drop dropped" id="drop-container">
            <svg height="150" width="150" class="pie-chart" id="svg">
                <circle class="behind"cx="50%" cy="50%" r="40%" />
                <circle class="front" cx="50%" cy="50%" r="40%" data-percent="0" />
                <text y="80" transform="translate(80)">
                   <tspan x="0" text-anchor="middle">0%</tspan>
                </text>
            </svg>
            <span class="info-text">Klikk for a laste opp bilde</span>
        </label>
        <input type="file" id="file" hidden="">
        <input type="text" name="file" id="fileText" class="dark" hidden>
    </section>

    <section class="container">  
       <div class="row">
       		<div class="col-5 upload-res">
	            <label for=""><h2>Oppskriftens navn</h2>
	                <input type="text" name="name" placeholder="Oppskrifts navn" class="dark">
	            </label>
            </div>        
       </div>
        <div class="row">
            <div class="col-6 col-m-12">
               <h3>Ingredienser</h3>
                <div class="ingredients" id="ingredients">
                    <div class="col-12" id="template">
                        <div class="col-4">
                            <label for="">Mengde
                                <input type="text" name="amount[]" placeholder="Mengde" class="dark">
                            </label>
                        </div>

                        <div class="col-4">
                            <label for="units" class="select">Volum/Vekt
                                <select name="unit[]" id="units">
                                    <option value="" disabled selected>Velg</option>
                                    <option value="" disabled>Volum</option>
                                    <option value="dl">Desiliter</option>
                                    <option value="l">Liter</option>
                                    <option value="oz">Øse</option>
                                    <option value="ts">T-skje</option>
                                    <option value="ss">Spiseskje</option>
                                    <option value="" disabled>Vekt</option>
                                    <option value="mg">Milligram</option>
                                    <option value="g">Gram</option>
                                    <option value="h">Hekto</option>
                                    <option value="kg">Kilogram</option>
                                    <option value="" disabled>Andre</option>
                                    <option value="stk">Stykk</option>
                                    <option value="fedd">Fedd</option>
                                    <option value="stk">Bunt</option>
                                </select>
                                <label class="icon" for="units"><i class="icon-arrow_down--white icon--small"></i></label>
                            </label>
                        </div>

                        <div class="col-4">
                            <label for="">Ingrediens
                                <input type="text" name="ingredient[]" placeholder="Ingrediens" class="dark">
                            </label>
                        </div>
                    </div>
                    
                </div>
                <div class="col-12">
                    <button type="button" id="add">Legg til ny ingrediens</button>
                </div>
            </div>

            <div class="col-6 col-m-12">
                <h3>Beskrivelse</h3>
                <textarea name="description" id="" placeholder="Beskrivelse av oppskrift" class="dark"></textarea>

                <h3>Hvordan</h3>
                <textarea name="how" id="" cols="30" rows="10" placeholder="Hvordan lager du oppskriften" class="dark"></textarea>
            </div>
            
            <div class="col-12">
                <h2 class="page-header">Kategorier</h2>
                <ul class="tags list-simple--horisontal">
                    <li>
                        <select name="cat[]" id="cat">
                            <option value="none" selected disabled>Velg</option>
                            @foreach($cat as $c)
                            
                                <option value="{{$c['id']}}">{{$c['name']}} {{ ($c['type'] == 0 ? ' (Råvare)' : ' (Type Rett)') }}</option>
                            
                            @endforeach
                        </select>
                    </li>
                </ul>
            </div>
            
        </div>
        <div class="col-12">
            <input type="submit" value="Ferdig">
        </div>
    </section>
@formend()
</main>
@layout('layout.scripts')
<script src="/assets/js/min/uploader-min.js"></script>
<script>
    var html = elm('#template').innerHTML;
    elm('#add').addEventListener('click', function(){
        var template = document.createElement('div');
        template.innerHTML = '<div class="col-12" id="template">'+html+'</div>';
        elm('#ingredients').appendChild(template);
    });
    
    var cat = elm('#cat').innerHTML;
    
    function catEvent(){
        var cat_template = document.createElement('li');
        cat_template.innerHTML = '<select name="cat[]">'+cat+'</select>';
            this.removeEventListener('change', catEvent);
        
        cat_template.addEventListener('change', catEvent);
        elm('.tags').appendChild(cat_template);
    };
    elm('#cat').addEventListener('change', catEvent);                    
    
    var dragging = false;
    var mousedown;
    var y = 0;
    var oldY = 0;
    elm('#drop-container').addEventListener('mousedown', function(e){
        dragging = true;
        mousedown = e;
        oldy = y;
        elm('#drop-container').addEventListener('mousemove', function(e){
            elm('#drop-container').setAttribute('for', ''); 
            if(dragging){
                mousedown.preventDefault();
                y = (e.pageY - mousedown.pageY);
                elm('#drop-container').style.backgroundPositionY = y+"px";
            }
        });
    });
    
    document.addEventListener("mouseup", function() {
        dragging = false;
        setTimeout(function(){
            elm('#drop-container').setAttribute('for', 'file');         
        }, 0);
    
    });

</script>
@layout('layout.foot')