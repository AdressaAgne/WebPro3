# Documentation

We built our own backend framework. Very simple and easy to learn.


## Logic and Basic Template - App/Controllers


    namespace App\Controllers;
    
    use View, BaseController;

    class MainController extends BaseController {
    
      public function index(){
        return View::make('index', [
          'var' => 'value',
        ]);
      }
    
    }
    

View Logic is run here then passed as variables to the views.

## Setup a view - App/Routing/RouteSetup.php
### Get Requests
This wil run the index method in the MainController class.

    Direct::get("/", 'MainController@index');
    Direct::get("/item/{id}", 'MainController@item');


### Post Requests
This wil run the submit method in the MainController class when a post request is made to /submit
it will set two get variables $_GET['mail'] and $_GET['text'] to whatever the url says.

    Direct::post("/submit/{mail}/{text}", 'MainController@submit');

Or you could just use normal $_POST variables

    Direct::post("/submit", 'MainController@submit');


## Views and HTML
Views are stores in view/
Please don't write any logic in a view, use the controller and pas data to the view as variables.

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
