<?php

namespace App\Database;

use DB;

class Migrations{

    public static function install(){
        //$name, $type, $default = null, $not_null = true, $auto_increment = false)
        $db = new DB();
        //$db->clearOut();

        // blacklisted species
        $db->createTable('blacklist', [
            new Row('id', 'int', null, true, true),
            new Row('scientificName', 'varchar'),
            new Row('navn', 'varchar'),
            new Row('svalbard', 'boolean', '0'),
            new Row('risiko', 'varchar'),
            new Row('taxonID', 'int'),
            new Row('canEat', 'boolean', '0'),
            new Row('family', 'varchar'),
            new Row('image', 'int'),
        ]);

        //lat lng locations for opserved species
        $db->createTable('artskart', [
            new Row('id', 'int', null, true, true),
            new Row('taxonID', 'int'),
            new Row('lat', 'FLOAT(10,6)'),
            new Row('lng', 'FLOAT(10,6)'),
        ], false);

        // a recipie
        $db->createTable('recipies', [
            new Row('id', 'int', null, true, true),
            new Row('name', 'varchar'),
            new Row('description', 'text'),
            new Row('image', 'int'),
            new Row('user_id', 'int'),
            new Row('how', 'text'),
        ]);

        // a ingredient for a recipie
        $db->createTable('ingredients', [
            new Row('id', 'int', null, true, true),
            new Row('name', 'varchar'),
            new Row('amount', 'float'),
            new Row('unit', 'varchar'),
            new Row('recipie_id', 'int'),
            new Row('taxonID', 'varchar'),
        ]);

        // User Account
        $db->createTable('users', [
            new Row('id', 'int', null, true, true),
            new Row('username', 'varchar'),
            new Row('password', 'varchar'),
            new Row('cookie', 'varchar'),
            new Row('image', 'int', '1'),
            new Row('mail', 'varchar'),
        ]);

        // connect the recipies and user
        $db->createTable('user_recipie', [
            new Row('id', 'int', null, true, true),
            new Row('user_id', 'int'),
            new Row('recipie_id', 'int'),
        ]);

        $db->createTable('places', [
            new Row('id', 'int', null, true, true),
            new Row('name', 'varchar(255)'),
            new Row('lat', 'FLOAT(10,6)'),
            new Row('lng', 'FLOAT(10,6)'),
        ]);

        $db->createTable('image', [
            new Row('id', 'int', null, true, true),
            new Row('user_id', 'int'),
            new Row('small', 'varchar'),
            new Row('big', 'varchar'),
        ]);


        $db->createTable('category', [
            new Row('id', 'int', null, true, true),
            new Row('name', 'varchar'),
            new Row('type', 'varchar'),
        ]);


        $db->createTable('comments',[
          new Row('id', 'int', null, true, true),
          new Row('user_id', 'int'),
          new Row('content', 'varchar'),
          new Row('recipe_id', 'int')
        ]);

        $db->createTable('ratings',[
          new Row('id', 'int', null, true, true),
          new Row('user_id', 'int'),
          new Row('recipe_id', 'int'),
          new Row('rating', 'tinyint')
        ]);

        $db->createTable('category', [
            new Row('id', 'int', null, true, true),
            new Row('name', 'varchar'),
            new Row('type', 'varchar'),
        ]);

        $db->createTable('recipie_category', [
            new Row('id', 'int', null, true, true),
            new Row('recipie_id', 'int'),
            new Row('category_id', 'int'),
        ]);

        self::populate();
        
        return $db->tableStatus;
    }

    public static function populate(){
        $db = new DB();
        
        $db->insert([
            [
                'name' => 'skalldyr',
                'type' => 0,
            ],[
                'name' => 'urter',
                'type' => 0,
            ],[
                'name' => 'rovdyr',
                'type' => 0,
            ],[
                'name' => 'insekter',
                'type' => 0,
            ],[
                'name' => 'frukt og bær',
                'type' => 0,
            ],[
                'name' => 'grønnsaker',
                'type' => 0,
            ],[
                'name' => 'fjærkre',
                'type' => 0,
            ],[
                'name' => 'lunsj',
                'type' => 1,
            ],[
                'name' => 'middag',
                'type' => 1,
            ],[
                'name' => 'snacks',
                'type' => 1,
            ],[
                'name' => 'insekter',
                'type' => 1,
            ],[
                'name' => 'tilbehør',
                'type' => 1,
            ],
        ], 'category');

        $db->insert([
            [
                'name' => 'Karpe i grønt',
                'description' => 'En deilig rett som inneholder flere ingredienser fra svartelista. ',
                'image' => 1,
                'user_id' => 1,
                'how' => 'Rens Fisken og skjær den i 4-5 cm tykke stykker. Legg stykkene i et halvdypt fat eller en bolle, krydre dem godt med salt og hell halvparten av oljen over. La dem stå og trekke ca 1 time.
                Skrell og grovhakk løken. Bland den med resten av oljen sammen med purren skåret i skiver. Krydre dette med pepper, ha det i varm gryte og la det få litt farge. Dryss så melet over, spe med så mye fiskekraft at det blir nok til å dekke fiskestykkene. Spe med vann om nødvendig.
                Ha fiskestykkene og enerbærene opp i gryten. La fisken koke på svak varme til den er halvmør, 12-15 minutter. Tilsett så hakket persille og kok retten ferdig i nye 12-15 minutter. Smak til med salt og pepper. Retten smaker godt både varm og kald. Server surbrød eller grovbrød til.',
            ],[
                'name' => 'Pai med lerkesopp',
                'description' => 'En deilig pai som kan lages med mange forskjellige typer sopp. Her har vi brukt Lerkesopp som er en svartelistet art.',
                'image' => 1,
                'user_id' => 1,
                'how' => 'Smuldre smøret i melet ved å bruke ngrene eller en foodprocessor. Tilsett vann og arbeid deigen raskt sammen (i foodprocessor 10-120 sek). Kjevle ut deigen eller trykk den ut i en form. Prikk den med en gaffel og la den hvile i kjøleskapet i 20-30 min. Varm stekeovn til 200ºC. Forstek paibunnen midt i stekeovnen i ca 10 min. Rens og del soppen i biter. Fres sopp og løk i smør i en panne til soppvæsken har kokt inn. Krydre med salt, pepper og timian. Visp sammen egg og matøte. Legg soppblandingen i den forstekte paibunnen og hell over eggeblandingen. Dryss på ost. Stek midt i stekeovnen i ca 30 min. Server med en grønn salat og ev sprøstekt bacon, spekeskinke eller røkelaks.',
            ],[
                'name' => 'Kjørvelpesto',
                'description' => 'Denne passer best til fisk og kjøtt, men kan også brukes på sandwiches og wraps. Kjørvel er ikke så mye brukt i det norske kjøkken, men om så vanligere på kontinentet, i land som Frankrike, Tyskland og Italia. Men kjørvelen hadde egentlig passet ypperlig inn i det norske kjøkkenet, særlig til tradisjonelle skeretter som skekaker.',
                'image' => 1,
                'user_id' => 1,
                'how' => 'Kjør alle ingrediensene i en kjøkkenmaskin med knivblad til en jevn masse. Smak til med salt og pepper. Ønskes en tynnere konsistens kan det tilsettes litt mer olivenolje.
                Tips! Pestoen kan også blandes med rømme eller créme fraîche og brukes som dipp eller dressing.',
            ],
        ], 'recipies');
        
        $db->insert([
           [
                'name' => 'karpe',
                'amount' => '1.5',
                'unit' => 'kg',
                'recipie_id' => 1,
                'taxonID' => '',
           ],[
                'name' => 'løk',
                'amount' => '1',
                'unit' => 'stk',
                'recipie_id' => 1,
                'taxonID' => '',
           ],[
                'name' => 'purre',
                'amount' => '3',
                'unit' => 'stk',
                'recipie_id' => 1,
                'taxonID' => '',
           ],[
                'name' => 'purre',
                'amount' => '3',
                'unit' => 'stk',
                'recipie_id' => 1,
                'taxonID' => '',
           ],[
                'name' => 'persille',
                'amount' => '1',
                'unit' => 'bunt',
                'recipie_id' => 1,
                'taxonID' => '',
           ],[
                'name' => 'enerbær',
                'amount' => '2-3',
                'unit' => 'stk',
                'recipie_id' => 1,
                'taxonID' => '',
           ],[
                'name' => 'hvetemel',
                'amount' => '1',
                'unit' => 'ss',
                'recipie_id' => 1,
                'taxonID' => '',
           ],[
                'name' => 'olje',
                'amount' => '1',
                'unit' => 'dl',
                'recipie_id' => 1,
                'taxonID' => '',
           ],[
                'name' => 'salt',
                'amount' => '',
                'unit' => '',
                'recipie_id' => 1,
                'taxonID' => '',
           ],[
                'name' => 'pepper',
                'amount' => '',
                'unit' => '',
                'recipie_id' => 1,
                'taxonID' => '',
           ],[
                'name' => 'fiskekraft',
                'amount' => '2',
                'unit' => 'dl',
                'recipie_id' => 1,
                'taxonID' => '',
           ],[
                'name' => 'kjørrvel',
                'amount' => '2',
                'unit' => 'dl',
                'recipie_id' => 3,
                'taxonID' => '60303',
           ],[
                'name' => 'lerkesopp',
                'amount' => '300',
                'unit' => 'g',
                'recipie_id' => 2,
                'taxonID' => '38890',
           ] 
        ], 'ingredients');

        $db->insert([
            [
            'user_id' => 1,
            'small' => '/assets/img/recipis/kingcrab.jpg',
            'big' => '/assets/img/recipis/kingcrab.jpg',
            ]
        ],'image');
        
        return ['populate' => 'done'];
    }
}
