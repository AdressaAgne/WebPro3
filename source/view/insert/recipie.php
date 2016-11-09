@layout('layout.head')

<style>
    h3, .info-text{
        color: #009688;
    }
    .info-text{
        display: block;
    }
    .pie-chart > text {
        fill: #009688;
    }
    .pie-chart > circle.front {
        stroke: #009688;
    }
</style>
<main>
<form action="/recipie/insert" method="post">
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
            <label for="">Oppskrifts navn
                <input type="text" name="name" placeholder="Oppskrifts navn" class="dark">
            </label>
           
       </div>
        <div class="row">
            <div class="col-6">
               <h3>Ingredienser</h3>
                <div class="ingredients" id="ingredients">
                    <div class="col-12" id="template">
                        <div class="col-4">
                            <label for="">Mengde
                                <input type="text" name="amount[]" placeholder="Mengde" class="dark">
                            </label>
                        </div>

                        <div class="col-4">
                            <label for="">Volum/Vekt
                                <select name="unit[]" id="">
                                    <option value="" disabled selected>Velg</option>
                                    <option value="" disabled>Volum</option>
                                    <option value="dl">Desiliter</option>
                                    <option value="l">Liter</option>
                                    <option value="oz">Øse</option>
                                    <option value="" disabled>Vekt</option>
                                    <option value="g">Gram</option>
                                    <option value="kg">KiloGram</option>
                                </select>
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

            <div class="col-6">
                <h3>Beskrivelse</h3>
                <textarea name="description" id="" placeholder="Beskrivelse av oppskrift" class="dark"></textarea>

                <h3>Hvordan</h3>
                <textarea name="how" id="" cols="30" rows="10" placeholder="Hvordan lager du oppskriften" class="dark"></textarea>
            </div>
        </div>
        <input type="submit" value="Ferdig">
    </section>
</form>
</main>

<script src="/assets/js/min/uploader-min.js"></script>
<script>
    var html = elm('#template').innerHTML;
    elm('#add').addEventListener('click', function(){
        var template = document.createElement('div');
        template.innerHTML = '<div class="col-12" id="template">'+html+'</div>';
        elm('#ingredients').appendChild(template);
        
    });

</script>
@layout('layout.foot')