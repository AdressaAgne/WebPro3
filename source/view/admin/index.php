@layout('layout.head')

<main>

    <div class="container">

        <h1 class="page-header">Admin Panel</h1>

        <div class="col-12">
            <h3 class="sub-header">Brukere</h3>
            <table>
                <thead>
                    <tr>
                        <td>ID</td>
                        <td>Username</td>
                        <td>Mail</td>
                        <td>Image</td>
                        <td>Rank</td>
                    </tr>
                </thead>
                @foreach($users as $user)
                <tbody>
                    <tr id="$user-{{$user['id']}}">
                        <td>{{$user['id']}}</td>
                        <td>{{$user['username']}}</td>
                        <td>{{$user['mail']}}</td>
                        <td class="image" style="background-image: url('{{$specie['small']}}');"></td>
                        <td>{{$user['rank']}}</td>
                    </tr>
                </tbody>
                @endforeach
            </table>
          </div>

            <div class="col-12">
                <h3 class="sub-header">Oppskrifter</h3>
                <table>
                    <thead>
                        <tr>
                            <td>Navn</td>
                            <td>Beskrivelse</td>
                            <td>Opplastet av</td>
                            <td>Moderer</td>
                        </tr>
                    </thead>
                    @foreach($recipes as $recipe)
                    <tbody>
                        <tr id="$recipe-{{$recipe['id']}}">
                            <td><a href="recipie/item/{{$recipe['id']}}">{{$recipe['name']}}</a></td>
                            <td>{{$recipe['description']}}</td>
                            <td>{{$recipe['username']}}</td>
                            <!-- if $recipe->approved > 0 addClass etc -->
                            <td><input type="checkbox" name="" value="" disabled></td>
                        </tr>
                    </tbody>
                    @endforeach
                </table>
            </div>

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
