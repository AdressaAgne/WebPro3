@layout('layout.head')

<main>
    
    <div class="container">
        
        <h1 class="page-header">Admin Panel</h1>
        
        <div class="col-12">
            <h3 class="sub-header">Arter</h3>
            <table>
                
                <tr>
                    <td>Navn</td>
                    <td>Latin</td>
                    <td>Oppskrifter</td>
                    <td>Image</td>
                    <td>Spiselig</td>
                </tr>
                
                @foreach($sepcies as $specie)
                <tr>
                    <td>{{$specie['navn']}}</td>
                    <td>{{$specie['scientificName']}}</td>
                    <td>{{$specie['recipes']}}</td>
                    <td><img src="{{$specie['small']}}" height="50px" alt=""></td>
                    <td>
                        <input type="checkbox" id="{{$specie['scientificName']}}" {{ ($specie['canEat'] == 1) ? 'checked' : '' }}>
                        <label class="checkbox" for="{{$specie['scientificName']}}"></label>
                    </td>
                </tr>
                @endforeach
                
                
            </table>
            
        </div>
        
    </div>
    
</main>

@layout('layout.foot')