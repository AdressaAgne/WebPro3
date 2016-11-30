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
All Controllers extend DB, so you can do $this->query() instead.
### Queries
```php
// Basic query
DB::query($SQL, [$params]);
DB::query("SELECT name, username FROM users WHERE id = :id", ['id' => 3]);

//Select
DB::select([$rows...], $table, [$where], $join = 'AND');
DB::select(['name', 'username'], 'users', ['id' => 3, 'id' => 4], 'OR');

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
$db = new DB();

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
