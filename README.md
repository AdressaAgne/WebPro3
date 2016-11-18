
1. [Todo](#todo)
2. [CSS Grid Documentation](#css-grid-documentation)
3. [Backend Documentation](#backend-documentation)
4. [live preview](https://farliggodt.agne.no)


# Todo:

## Backend
### PHP

* [ ] User Authentication
    * [x] Login
    * [x] Register
    * [ ] Porfile Settings
    * [ ] Secutiry Settings
    * [ ] Last login IP check?
* [ ] Mail System
* [x] Image Compressor Class
* [x] Image uploader
* [x] Recipe Class
* [x] User Class
* [x] Unit Convertion Class
* [ ] Auto Migrate when database is not found
* [x] Restfull routing
* [x] base MVC
* [x] Better sepecies opservation migration from Artskart API
* [ ] Frontpage recipe algorythem
* [ ] Recipe rating?
* [x] Convert image strings to image id's from image table
* [x] Edit Profile
* [ ] Admin Panel
* [ ] Recipe Sorting
* [ ] Rename Recipie to Recipe in all files....
* [x] Comments
* [ ] Images for Species
* [ ] Write Database class documentaion
* [x] Added Build and Source folder
* [x] 

### Database / MySQL

* [x] Recipe table
* [x] User table
* [x] Units table
* [x] Species table
* [x] Species opservations table

## Frontend
### HTML / CSS

* [x] Profile Page
* [x] Vision Page
* [x] Recipe page
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
* [x] Text for our vision


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

View Logic is run here then passed as variables to the views.
```php
namespace App\Controllers;

use View, BaseController;

class MainController extends BaseController {
   public function index($params){
      $username = $params['username'];
      return View::make('index', [
         'var' => $username,
      ]);
   }
}
```
$params is $_GET and $_POST merged together
To make a JSON API just return an array insted of a View.

## Setup a view - App/Routing/RouteSetup.php
### Get Requests
This wil run the index method in the MainController class.
```php
Direct::get("/", 'MainController@index');
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

### Other HTTP requests
```php
Direct::put("/page", 'controller@method');
Direct::delete("/page", 'controller@method');
Direct::update("/page", 'controller@method');
Direct::err("404", 'controller@method');
```

### Auth for HTTP requests
By using ->Auth() this will require a user to be logged inn. ->admin() requeris the logged inn user to be an admin
```php
Direct::get("/profile", 'controller@method')->auth($callback);
Direct::get("/admin", 'controller@method')->admin($callback);
```

## Database (App/Database/Database)

### Init
Use the App/Config.php to enter your database login information

### Queries
```php
// Basic query
DB:query($SQL, [$params]);
DB:query("SELECT name, username FROM users WHERE id = :id", ['id' => 3]);

//Select
DB:select([$rows...], $table, [$where], $join = 'AND');
DB:select(['name', 'username'], 'users', ['id' => 3, 'id' => 4], 'OR');

// Select everything
DB::all([$rows], $table);
DB::all(['name', 'username'], 'users');

//Insert rows
DB::insert([[$row => $value]], $table);
DB::insert([['name' => 'Frank'],['name' => 'George']], 'users');

//Update rows
DB::update([$rows], $table, [$where], $rowsjoin = '=', $wherejoin = 'AND');
DB::update(['name' => 'ron'], 'users', ['name' => 'Frank']);

//Delete a row
DB::deleteWhere($col = 'id', $val = 0, $table = null);
DB::deleteWhere('id', 10, 'users');
```

### Creating a table / Migrations (App/Database/Migration)
```php
$db->createTable('users', [
   new Row('id', 'int', null, true, true),
   new Row('username', 'varchar'),
   new Row('password', 'varchar'),
   new Row('mail', 'varchar'),
   new Timestamp(),
]);

new Row($name, $type, $default = null, $not_null = true, $auto_increment = false);
```


## Security
###  SQL injection & Secondary SQL injection
By using the DB class everything is escaped, so you dont need to worry about SQL injection, if you use this all the time you will be safe.
```php
DB::query("SELECT name, username FROM users WHERE id = :id", ['id' => 3])->fetchAll();
DB::select(['name', 'username'], 'users', ['id' => 3])->fetchAll();
```
### XSS Injection
Using {{ }} to echo out will add a htmlspecialchars() function around
```html
{{ $variable }}
```
Using {! !} will echo a raw string, without htmlspecialchars(). Be carefull with this one.
```html
{! $variable !}
```

### CSRF token
Cross-site Request Forgery token are added to prevent people from spamming post requests from other sites.
This will echo out a form with both _method and _token
```html
@form('/login', 'put', ['class' => 'login'])
   <input type="text" placeholder="username">   
   <input type="password" placeholder="password"> 
@formend()
```

Will output:

```html
<form action="/login" method="POST" class="login">
   <input type="hidden" name="_method" value="PUT">
   <input type="hidden" name="_token" value="ujbf23kd872niw9">
   <input type="text" placeholder="username">   
   <input type="password" placeholder="password"> 
</form>
```

This will echo out the csrf token
```html
   @csrf()
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

@else

<h3>boo 1 != 1</h3>

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
