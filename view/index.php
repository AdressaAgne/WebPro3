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