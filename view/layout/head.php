<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Farligt Godt</title>
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display|Roboto:300" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/main.css">
</head>

<body>


<nav class="nav">
    <div class="container">
        <ul class="nav--left">
            <li class="nav__item nav__item--burger"><a href="#"><i class="icon-meat--white icon--small icon--text"></i></a></li>
           
            <li class="nav__item @active_page('')"><a href="/"><i class="icon-knife--white icon--small icon--text"></i> Hjem</a></li>
            <li class="nav__item @active_page('recipie')"><a href="/recipie"><i class="icon-pan--white icon--small icon--text"></i> Oppskrifter</a></li>
            <li class="nav__item @active_page('nearby')"><a href="/nearby"><i class="icon-fish--white icon--small icon--text"></i> Arter i Nærheten</a></li>
            <li class="nav__item @active_page('about')"><a href="/about"><i class="icon-wheat--white icon--small icon--text"></i> Visjon</a></li>
           
        </ul>

       
       
       
       
        <ul class="nav--right">
            <li class="nav__item"><a href="/login">Profil</a></li>
        </ul>

    </div>
</nav>