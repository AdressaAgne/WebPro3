@layout('layout.head')

<main>
    
    <div class="container">
        
        <h1 class="page-header">Admin Panel</h1>
        
        <div class="col-12">
            <h3 class="sub-header">Arter</h3>
            <table>
                <thead>
                    <tr>
                        <td>Navn</td>
                        <td>Latin</td>
                        <td>Oppskrifter</td>
                        <td>Image</td>
                        <td>Spiselig</td>
                    </tr>    
                </thead>
                @foreach($sepcies as $specie)
                <tbody>
                    <tr id="specie-{{$specie['id']}}">
                        <td>{{$specie['navn']}}</td>
                        <td>{{$specie['scientificName']}}</td>
                        <td>{{$specie['recipes']}}</td>
                        <td class="image" style="background-image: url('{{$specie['small']}}');"></td>
                        <td>
                            <input type="checkbox" id="{{$specie['scientificName']}}" {{ ($specie['canEat'] == 1) ? 'checked' : '' }}>
                            <label class="checkbox" for="{{$specie['scientificName']}}"></label>
                        </td>
                    </tr>
                </tbody>
                @endforeach
                
                
            </table>
            
        </div>
        
    </div>
    
</main>

@layout('layout.foot')