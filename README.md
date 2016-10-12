# Todo:

## Backend
### PHP

* [ ] User Authentication
    * [ ] Login
    * [ ] Register
    * [ ] Porfile Settings
    * [ ] Secutiry Settings
    * [ ] Last login IP check?
* [ ] Mail System
* [ ] Image Compressor Class
* [ ] Image uploader
* [ ] Recipe Class
* [ ] User Class
* [ ] Unit Convertion Class
* [ ] Auto Migrate when database is not found
* [x] Restfull routing
* [x] base MVC
* [ ] Better sepecies opservation migration from Artskart API
* [ ] Frontpage recipe algorythem
* [ ] Recipe rating?

### Database / MySQL

* [ ] Recipe table
* [ ] User table
* [ ] Units table
* [x] Species table
* [x] Species opservations table

## Frontend
### HTML / CSS

* [ ] Profile Page
* [ ] Vision Page
* [ ] Recipe page
* [ ] Settings for Nearby Species
* [ ] Mail Template

### JS

* [ ] Implement OOP

### Images

* [ ] Frontpage header images
* [ ] Placeholder image for user
* [ ] Generic Icons


## Data

* [ ] Sort data by edible species
* [ ] Text for our vision


# CSS Grid Documentation
We built our own css grid stystem with sass, its on aproxemetly 50 lines and works greit.

All grid names can be changes to your liking alongside the size of the gird. For now we use col-(breakpoint)-(stage)

The grid is names Iron-grid since its a building shell framework(iron bars), its robust and a little inspiration from polymer

```sass

$iron-grid-columns:                  12     !default
$iron-grid-col-name:                 col    !default
$iron-grid-row-name:                 row    !default
$iron-grid-gutter:                   12px   !default

$iron-grid-breakpoint-small-name:    s      !default
$iron-grid-breakpoint-small:         480px  !default

$iron-grid-breakpoint-medium-name:   m      !default
$iron-grid-breakpoint-medium:        768px  !default

$iron-grid-breakpoint-large-name:    l      !default
$iron-grid-breakpoint-large:         1200px !default

```

# Backend Documentation

We also built our own backend framework. Very simple and easy to learn.


## Logic and Basic Template - App/Controllers

```php
    namespace App\Controllers;
    
    use View, BaseController;

    class MainController extends BaseController {
    
      public function index(){
        return View::make('index', [
          'var' => 'value',
        ]);
      }
    
    }
```    

View Logic is run here then passed as variables to the views.

## Setup a view - App/Routing/RouteSetup.php
### Get Requests
This wil run the index method in the MainController class.
```php
    Direct::get("/", 'MainController@index');
    Direct::get("/item/{id}", 'MainController@item');
```

### Post Requests
This wil run the submit method in the MainController class when a post request is made to /submit
it will set two get variables $_GET['mail'] and $_GET['text'] to whatever the url says.
```php
    Direct::post("/submit/{mail}/{text}", 'MainController@submit');
```
Or you could just use normal $_POST variables
```php
    Direct::post("/submit", 'MainController@submit');
```

## Views and HTML
Views are stores in view/
Please don't write any logic in a view, use the controller and pas data to the view as variables.
```html
    @layout('layout.head')

    <h1>Basic intruction; how to use this.</h1>
    
    
    <h2>Echo php stuff</h2>
    {{ $var }}
    
    <h2>Echo Raw Code</h2>
    {!  $user !}
    
    <h2>if</h2>
    
    @if(1 == 1)
    
    <h3>yay 1 = 1</h3>
    
    @endif
    
    <h2>foreach loop</h2>
    
    @foreach($arr as $key => $value)
    
    <div>
        <h3>{{ $key }}</h3>
        <p>{{ $value }}</p>
    </div>
    
    @endforeach
    
    
    <h2>for loop</h2>
    
    @for($i = 0; $i > count($arr); $i++)
    
    <div>
        <h3>{{ $i }}</h3>
        <p>{{ $arr[$i] }}</p>
    </div>
    
    @endfor
    
    
    @layout('layout.foot')
```
