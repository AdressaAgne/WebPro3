<?php require_once('App/App.php'); 

use \App\Api\Taxon as Taxon;
use \App\Api\Csv as Csv;
use \App\Database\Database as DB;


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
   <pre>
    <?php
        $db = new DB();
        $csv = new Csv();

        //print_r($csv->fetchAll());
        print_r(Taxon::byID('84141'));


    ?>
    </pre>
</body>
</html>
