<?php

namespace App\Database;

use DB, App\Api\Populate as blacklist, Account;

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
            new Timestamp(),
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
            new Timestamp(),
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
            new Row('position', 'varchar', 'center'),
            new Timestamp(),
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
          new Row('recipe_id', 'int'),
          new Timestamp(),
        ]);

        $db->createTable('ratings',[
            new Row('id', 'int', null, true, true),
            new Row('user_id', 'int'),
            new Row('recipe_id', 'int'),
            new Row('rating', 'tinyint'),
            new Timestamp(),
        ]);


        $db->createTable('recipie_category', [
            new Row('id', 'int', null, true, true),
            new Row('recipie_id', 'int'),
            new Row('category_id', 'int'),
        ]);

        
        
        return [$db->tableStatus, self::populate()];
    }

    public static function populate(){
        $db = new DB();
        blacklist::run();
        Account::register('miamia', '123', '123', 'mail');
        
        $db->insert([
            [
                'name' => 'skalldyr',
                'type' => 0,
            ],[
                'name' => 'urter',
                'type' => 0,
            ],[
                'name' => 'pattedyr',
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
                'name' => 'Regnbueørret i grønt',
                'description' => 'En deilig rett som inneholder flere ingredienser fra svartelista. ',
                'image' => 19,
                'user_id' => 1,
                'how' => 'Rens Fisken og skjær den i 4-5 cm tykke stykker. Legg stykkene i et halvdypt fat eller en bolle, krydre dem godt med salt og hell halvparten av oljen over. La dem stå og trekke ca 1 time.
                Skrell og grovhakk løken. Bland den med resten av oljen sammen med purren skåret i skiver. Krydre dette med pepper, ha det i varm gryte og la det få litt farge. Dryss så melet over, spe med så mye fiskekraft at det blir nok til å dekke fiskestykkene. Spe med vann om nødvendig.
                Ha fiskestykkene og enerbærene opp i gryten. La fisken koke på svak varme til den er halvmør, 12-15 minutter. Tilsett så hakket persille og kok retten ferdig i nye 12-15 minutter. Smak til med salt og pepper. Retten smaker godt både varm og kald. Server surbrød eller grovbrød til.',
            ],[
                'name' => 'Pai med lerkesopp',
                'description' => 'En deilig pai som kan lages med mange forskjellige typer sopp. Her har vi brukt Lerkesopp som er en svartelistet art.',
                'image' => 18,
                'user_id' => 1,
                'how' => 'Smuldre smøret i melet ved å bruke ngrene eller en foodprocessor. Tilsett vann og arbeid deigen raskt sammen (i foodprocessor 10-120 sek). Kjevle ut deigen eller trykk den ut i en form. Prikk den med en gaffel og la den hvile i kjøleskapet i 20-30 min. Varm stekeovn til 200ºC. Forstek paibunnen midt i stekeovnen i ca 10 min. Rens og del soppen i biter. Fres sopp og løk i smør i en panne til soppvæsken har kokt inn. Krydre med salt, pepper og timian. Visp sammen egg og matøte. Legg soppblandingen i den forstekte paibunnen og hell over eggeblandingen. Dryss på ost. Stek midt i stekeovnen i ca 30 min. Server med en grønn salat og ev sprøstekt bacon, spekeskinke eller røkelaks.',
            ],[
                'name' => 'Kjørvelpesto',
                'description' => 'Denne passer best til fisk og kjøtt, men kan også brukes på sandwiches og wraps. Kjørvel er ikke så mye brukt i det norske kjøkken, men om så vanligere på kontinentet, i land som Frankrike, Tyskland og Italia. Men kjørvelen hadde egentlig passet ypperlig inn i det norske kjøkkenet, særlig til tradisjonelle fiskeretter som fiskekaker.',
                'image' => 17,
                'user_id' => 1,
                'how' => 'Kjør alle ingrediensene i en kjøkkenmaskin med knivblad til en jevn masse. Smak til med salt og pepper. Ønskes en tynnere konsistens kan det tilsettes litt mer olivenolje.
                Tips! Pestoen kan også blandes med rømme eller créme fraîche og brukes som dipp eller dressing.',
            ],[
                'name' => 'Ripsgele',
                'description' => 'Med riktig mengde sukker, og naturlig stivelse i bærene, kan ripssaft bli til gelé uten andre tilsetningsstoffer.',
                'image' => 20,
                'user_id' => 1,
                'how' => 'Kok opp rips, og tilsett litt vann. Kok til det safter seg – det tar cirka to minutter. Sil bærene, og la dem renne godt av. Mål opp hvor mye væske du har, og tilsett 100 gram sukker per desiliter væske. På 500 gram rips får du cirka halvannen desiliter saft. Kok opp saften under omrøring, og ha i litt og litt sukker. Rør til alt sukkeret har smeltet. Skum av eventuelt skum, og fyll geleen på rene glass. Hvis det er lite pektin, det vil si naturlig stivelse, i bæra, kan det være du må tilsette litt pektin. For å sjekke om geleen er stiv nok, kan du ha en spiseskje ferdig «gelésaft» på en tallerken. Avkjøl. Stryk skjeen gjennom geleen. Hvis det står igjen en stripe der du strøk skjeen, er geleen sannsynligvis passe stiv.',
            ],[
                'name' => 'Helstekt Kanadagås',
                'description' => 'Gås er veldig godt og egnet på langbordet. Man kan bruke alle typer gås, men vi har selvfølgelig brukt Kanadagås i denne oppskrifen.',
                'image' => 21,
                'user_id' => 1,
                'how' => 'Skjær av vingene på gåsen, ta ut innmaten og fjern noe av fettet i buken. Brun vinger og innmat over svak varme i det fettet som smelter ut. 
                Tilsett grønnsaker skåret i biter, og brun det hele et par minutter til. Tilsett rødvin og la det koke inn til 1/3. Hell over vann så det dekker. La kraften småputre et par timer. Sil og kok inn kraften til halv mengde. Skyll og tørk av gåsen innvendig og utvendig. Gni den godt inn med salt og pepper, både inne i skroget og på skinnsiden. 
                Del eplene i grove biter. Fyll gåsen med epler, svisker og aprikoser. Bruk en kjøttnål eller sy sammen åpningen om nødvendig.
                Legg gåsen på en rist over en langpanne og stek den ved 250 grader i 20 minutter. Senk temperaturen til 150 grader, hell litt vann i langpannen og stek videre i ca. 2 1/2 time. La gåsen hvile ca. 20 minutter før den skjæres opp.
                Skum fettet av stekesjyen i langpannen. Ta vare på alt fettet, det kan fryses ned til senere bruk. Mål opp innkokt kraft og stekesjy. Visp sammen 2 spiseskjeer gåsefett med hvetemel i en kasserolle. La blandingen brunes lett under omrøring. Tilsett 8 desiliter kraft/stekesjy og kok opp. La sausen småkoke til den får passe tykk konsistens. Visp inn ripsgelé og smak sausen til med salt og pepper.',
            ],[
                'name' => 'Stillehavsøsters på grillen',
                'description' => 'Å grille østers er ikke bare en smakfull opplevelse, det er også veldig gøy! Og så slipper man faktisk den litt vanskelig åpningsprosessen. Du bare legger hele østers på grillen og så popper de opp når de er klare. 
                Da kan du velge å gratinere den videre med litt ost og gressløk eller servere dem med klassisk tilbehør som sitron og rødløk. ',
                'image' => 22,
                'user_id' => 1,
                'how' => 'Skyll og rens eventuelt bort stein og tang fra skjellene. Fyr opp en grill og legg østersen på grillen. Beregn ca 6 østers per person til en forrett og litt flere til hovedrett. Etter ca 5 minutter vil østersen poppe opp. Da kan du enkelt brekke av det øverste skjellet. Men pass på varm væske når du håndterer grillet østers!
                Velg din favoritttopping til østersen. En liten bit blåmuggost eller et dryss parmesan sammen med litt gressløk eller finhakket hvitløk er veldig godt. Finhakket rødløk og en skje balsamico ga gode og karamelliserte østers. Prøv også med kun en skvis sitronsaft. La gjerne gjestene velge sin egen topping.
                Server grillede og gratinerte østers sammen sammen med gode bobler!',
            ],[
                'name' => 'Salat med Kongekrabbe',
                'description' => 'Salat nicoise er en klassisk fransk salat som normalt lages med ansjos. I denne oppskriften har vi brukt kongekrabbe i stedet. Server med en hjemmelaget dressing.',
                'image' => 23,
                'user_id' => 1,
                'how' => 'Rens kongekrabbebein og del i mindre stykker. Hardkok egg i ca. 9 minutter, avkjøl, skrell og del i to. Forvell aspargesbønner i 2 minutter i lettsaltet vann, avkjøl i kaldt vann og del i to.
                Skjær salat i grove strimler, rødløk i tynne strimler, agurk i tynne skiver, tomat i båter og paprika i terninger. 
                Bland alt i en salatbolle, og ha i oliven og kapers. Legg stykker av kongekrabbebein på toppen. ',
            ],[
                'name' => 'Villsvingryte',
                'description' => 'Høsten er en finfin tid for så mangt på matfronten. I tillegg til at skogen byr på sopp og bær, er det også tiden da jakt bedrives. Jakten er en viktig kilde til kjøtt i vår husholdning, som langt på vei har erstattet kjøtt fra tamgris og storfe. Viltkjøtt er smaksrikt, magert og fullt av næringsstoffer som kroppen har godt av. For en kokk byr viltet på spennende utfordringer, ettersom man skal utnytte et helt dyr. Det er jo ikke bare ytre- og indrefileten som skal brukes, man får deilige steker, nakke, ribbe og kraftbein «på kjøpet» også! Denne middagen laget vi av en stor villsvinnakke da mormor og morfar var på besøk fra Sverige. Gryter kan se litt trist ut på bilder, men det er få ting som er så rikt på smak som en skikkelig villsvingryte.',
                'image' => 24,
                'user_id' => 1,
                'how' => 'Kutt kjøttet og grønnsakene i grove terninger. Brun alt i en stekepanne. Kok ut panna med ølen. Legg kjøtt og grønnsaker i en gryte, tilsett tomater, fløte og vann. La gryta putre til kjøttet er mørt, 2-3 timer. Kok poteter.',
            ],[
                'name' => 'Haresuppe',
                'description' => 'Høsten er en finfin tid for så mangt på matfronten. I tillegg til at skogen byr på sopp og bær, er det også tiden da jakt bedrives. Jakten er en viktig kilde til kjøtt i vår husholdning, som langt på vei har erstattet kjøtt fra tamgris og storfe. Viltkjøtt er smaksrikt, magert og fullt av næringsstoffer som kroppen har godt av. For en kokk byr viltet på spennende utfordringer, ettersom man skal utnytte et helt dyr. Det er jo ikke bare ytre- og indrefileten som skal brukes, man får deilige steker, nakke, ribbe og kraftbein «på kjøpet» også! Denne middagen laget vi av en stor villsvinnakke da mormor og morfar var på besøk fra Sverige. Gryter kan se litt trist ut på bilder, men det er få ting som er så rikt på smak som en skikkelig villsvingryte.',
                'image' => 25,
                'user_id' => 1,
                'how' => 'Del harene, og legg vekk indre- og ytrefiletene og lårene. Dette kan brukes senere til andre retter. Hakk resten i småbiter som legges i langpanne og brunes i ovn ved 225 C til bena er pent brune.
                Skjær grønnsakene i biter, og fres dem i smør i en stor kjele. Tilsett så tomatpuré, hell over madeira og la alt koke noen minutter. Legg de brunede ben- og kjøttbitene i kjelen, hell over viltbuljongen (eller vannet) og gi det et oppkok. Skum godt, ha i krydderet og la alt småkoke i ca 2 timer. Når det er ferdig siles suppen. Smak til med sukker, salt, pepper og revet ingefær. Smaksett med sitron.',
            ],
        ], 'recipies');
        
        $db->insert([
        	[
        		'recipie_id' => 1,
        		'category_id' => 1,
        	],[
        		'recipie_id' => 1,
        		'category_id' => 10,
        	],
        	
        ], 'recipie_category');
        
        $db->insert([
           [
                'name' => 'Ørret',
                'amount' => '1.5',
                'unit' => 'kg',
                'recipie_id' => 1,
                'taxonID' => '26171',
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
                'name' => 'kjørvel',
                'amount' => '1',
                'unit' => 'bunt',
                'recipie_id' => 1,
                'taxonID' => '60303',
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
           ],[
                'name' => 'rips',
                'amount' => '500',
                'unit' => 'g',
                'recipie_id' => 4,
                'taxonID' => '63574',
           ],[
                'name' => 'vann',
                'amount' => '2',
                'unit' => 'ss',
                'recipie_id' => 4,
                'taxonID' => '',
           ],[
                'name' => 'sukker',
                'amount' => '150',
                'unit' => 'g',
                'recipie_id' => 4,
                'taxonID' => '',
           ],[
                'name' => 'Kanadagås',
                'amount' => '1',
                'unit' => 'stk',
                'recipie_id' => 5,
                'taxonID' => '3457',
           ],[
                'name' => 'Eple',
                'amount' => '4',
                'unit' => 'stk',
                'recipie_id' => 5,
                'taxonID' => '',
           ],[
                'name' => 'Aprikos',
                'amount' => '300',
                'unit' => 'g',
                'recipie_id' => 5,
                'taxonID' => '',
           ],[
                'name' => 'Svisker',
                'amount' => '300',
                'unit' => 'g',
                'recipie_id' => 5,
                'taxonID' => '',
           ],[
                'name' => 'Timian',
                'amount' => '',
                'unit' => '',
                'recipie_id' => 5,
                'taxonID' => '62346',
           ],[
                'name' => 'Kraft',
                'amount' => '8',
                'unit' => 'dl',
                'recipie_id' => 5,
                'taxonID' => '',
           ],[
                'name' => 'Hvetemel',
                'amount' => '1.5',
                'unit' => 'ss',
                'recipie_id' => 5,
                'taxonID' => '',
           ],[
                'name' => 'Ripsgele',
                'amount' => '2',
                'unit' => 'ss',
                'recipie_id' => 5,
                'taxonID' => '63574',
           ],[
                'name' => 'Stillehavsøsters',
                'amount' => '24',
                'unit' => 'stk',
                'recipie_id' => 6,
                'taxonID' => '84141',
           ],[
                'name' => 'Rødløk',
                'amount' => '1',
                'unit' => 'stk',
                'recipie_id' => 6,
                'taxonID' => '',
           ],[
                'name' => 'Blåmuggost',
                'amount' => '100',
                'unit' => 'g',
                'recipie_id' => 6,
                'taxonID' => '',
           ],[
                'name' => 'Parmesan',
                'amount' => '100',
                'unit' => 'g',
                'recipie_id' => 6,
                'taxonID' => '',
           ],[
                'name' => 'Sitron',
                'amount' => '1',
                'unit' => 'stk',
                'recipie_id' => 6,
                'taxonID' => '',
           ],[
                'name' => 'Balsamicoeddik',
                'amount' => '6',
                'unit' => 'ss',
                'recipie_id' => 6,
                'taxonID' => '',
           ],[
                'name' => 'Hvitløk',
                'amount' => '3',
                'unit' => 'fedd',
                'recipie_id' => 6,
                'taxonID' => '',
           ],[
                'name' => 'Gressløk',
                'amount' => '1',
                'unit' => 'bunt',
                'recipie_id' => 6,
                'taxonID' => '59373',
           ],[
                'name' => 'Kongekrabbe',
                'amount' => '1',
                'unit' => 'kokt ben av',
                'recipie_id' => 7,
                'taxonID' => '14365',
           ],[
                'name' => 'Egg',
                'amount' => '4',
                'unit' => 'stk',
                'recipie_id' => 7,
                'taxonID' => '',
           ],[
                'name' => 'Aspargesbønner',
                'amount' => '150',
                'unit' => 'g',
                'recipie_id' => 7,
                'taxonID' => '',
           ],[
                'name' => 'Hjertesalat',
                'amount' => '1',
                'unit' => 'stk',
                'recipie_id' => 7,
                'taxonID' => '',
           ],[
                'name' => 'Rødløk',
                'amount' => '0.5',
                'unit' => 'stk',
                'recipie_id' => 7,
                'taxonID' => '',
           ],[
                'name' => 'Agurk',
                'amount' => '0.5',
                'unit' => 'stk',
                'recipie_id' => 7,
                'taxonID' => '',
           ],[
                'name' => 'Tomat',
                'amount' => '4',
                'unit' => 'stk',
                'recipie_id' => 7,
                'taxonID' => '',
           ],[
                'name' => 'Kapers',
                'amount' => '1',
                'unit' => 'ss',
                'recipie_id' => 7,
                'taxonID' => '',
           ],[
                'name' => 'Svinenakke av Villsvin',
                'amount' => '1',
                'unit' => 'kg',
                'recipie_id' => 8,
                'taxonID' => '31237',
           ],[
                'name' => 'Løk',
                'amount' => '2',
                'unit' => 'stk',
                'recipie_id' => 8,
                'taxonID' => '',
           ],[
                'name' => 'Gulrøtter',
                'amount' => '5',
                'unit' => '',
                'recipie_id' => 8,
                'taxonID' => '',
           ],[
                'name' => 'Hvitløk',
                'amount' => '3',
                'unit' => 'fedd',
                'recipie_id' => 8,
                'taxonID' => '',
           ],[
                'name' => 'Sopp (gjerne Lerkesopp)',
                'amount' => '50',
                'unit' => 'g',
                'recipie_id' => 8,
                'taxonID' => '38890',
           ],[
                'name' => 'Hakkede tomater',
                'amount' => '1',
                'unit' => 'boks',
                'recipie_id' => 8,
                'taxonID' => '',
           ],[
                'name' => 'Fløte',
                'amount' => '3',
                'unit' => 'dl',
                'recipie_id' => 8,
                'taxonID' => '',
           ],[
                'name' => 'Mørkt øl',
                'amount' => '2',
                'unit' => 'dl',
                'recipie_id' => 8,
                'taxonID' => '',
           ],[
                'name' => 'Vann',
                'amount' => '3',
                'unit' => 'dl',
                'recipie_id' => 8,
                'taxonID' => '',
           ],[
                'name' => 'Krydder',
                'amount' => '',
                'unit' => '',
                'recipie_id' => 8,
                'taxonID' => '',
           ],[
                'name' => 'Hare',
                'amount' => '2',
                'unit' => 'stk flådd',
                'recipie_id' => 9,
                'taxonID' => '31106',
           ],[
                'name' => 'Sellerirot',
                'amount' => '1',
                'unit' => 'bit',
                'recipie_id' => 9,
                'taxonID' => '',
           ],[
                'name' => 'Purre',
                'amount' => '1',
                'unit' => 'stk',
                'recipie_id' => 9,
                'taxonID' => '',
           ],[
                'name' => 'Madeira',
                'amount' => '3',
                'unit' => 'dl',
                'recipie_id' => 9,
                'taxonID' => '',
           ],[
                'name' => 'Løk',
                'amount' => '2',
                'unit' => 'stk ',
                'recipie_id' => 9,
                'taxonID' => '',
           ],[
                'name' => 'Viltkraft',
                'amount' => '2',
                'unit' => 'dl',
                'recipie_id' => 9,
                'taxonID' => '',
           ],[
                'name' => 'Fløte',
                'amount' => '2',
                'unit' => 'dl',
                'recipie_id' => 9,
                'taxonID' => '',
           ],   
          
        ], 'ingredients');

        $db->insert([
            [
            'user_id' => 1,
            'small' => '/assets/img/recipis/kingcrab.jpg',
            'big' => '/assets/img/recipis/kingcrab.jpg',
            'position' => 'center',
            ],[
            'user_id' => 1,
            'small' => '/assets/img/arter/canadagoose.jpg',
            'big' => '/assets/img/arter/canadagoose.jpg',
            'position' => '25%',
            ],[
            'user_id' => 1,
            'small' => '/assets/img/arter/gresslauk.jpg',
            'big' => '/assets/img/arter/gresslauk.jpg',
            'position' => 'center',
            ],[
            'user_id' => 1,
            'small' => '/assets/img/arter/hagepastinakk.jpg',
            'big' => '/assets/img/arter/hagepastinakk.jpg',
            'position' => 'center',
            ],[
            'user_id' => 1,
            'small' => '/assets/img/arter/hagerips.jpg',
            'big' => '/assets/img/arter/hagerips.jpg',
            'position' => 'center',
            ],[
            'user_id' => 1,
            'small' => '/assets/img/arter/hare.jpg',
            'big' => '/assets/img/arter/hare.jpg',
            'position' => '30%',
            ],[
            'user_id' => 1,
            'small' => '/assets/img/arter/kjorvel.jpg',
            'big' => '/assets/img/arter/kjorvel.jpg',
            'position' => 'center',
            ],[
            'user_id' => 1,
            'small' => '/assets/img/arter/kongekrabbe.jpg',
            'big' => '/assets/img/arter/kongekrabbe.jpg',
            'position' => 'center',
            ],[
            'user_id' => 1,
            'small' => '/assets/img/arter/lerkesopp.jpg',
            'big' => '/assets/img/arter/lerkesopp.jpg',
            'position' => 'center',
            ],[
            'user_id' => 1,
            'small' => '/assets/img/arter/mink.jpg',
            'big' => '/assets/img/arter/mink.jpg',
            'position' => '25%',
            ],[
            'user_id' => 1,
            'small' => '/assets/img/arter/niland.jpg',
            'big' => '/assets/img/arter/niland.jpg',
            'position' => '17%',
            ],[
            'user_id' => 1,
            'small' => '/assets/img/arter/stillehavs.jpg',
            'big' => '/assets/img/arter/stillehavs.jpg',
            'position' => 'center',
            ],[
            'user_id' => 1,
            'small' => '/assets/img/arter/strandkarse.jpg',
            'big' => '/assets/img/arter/strandkarse.jpg',
            'position' => 'center',
            ],[
            'user_id' => 1,
            'small' => '/assets/img/arter/timian.jpg',
            'big' => '/assets/img/arter/timian.jpg',
            'position' => 'center',
            ],[
            'user_id' => 1,
            'small' => '/assets/img/arter/trout.jpg',
            'big' => '/assets/img/arter/trout.jpg',
            'position' => '20%',
            ],[
            'user_id' => 1,
            'small' => '/assets/img/arter/villsvin.jpg',
            'big' => '/assets/img/arter/villsvin.jpg',
            'position' => 'center',
            ],[
            'user_id' => 1,
            'small' => '/assets/img/recipis/kjorvel.jpg',
            'big' => '/assets/img/recipis/kjorvel.jpg',
            'position' => 'center',
            ],[
            'user_id' => 1,
            'small' => '/assets/img/recipis/pai.jpg',
            'big' => '/assets/img/recipis/pai.jpg',
            'position' => 'center',
            ],[
            'user_id' => 1,
            'small' => '/assets/img/recipis/karpe.jpg',
            'big' => '/assets/img/recipis/karpe.jpg',
            'position' => 'center',
            ],[
            'user_id' => 1,
            'small' => '/assets/img/recipis/ripsgele.jpg',
            'big' => '/assets/img/recipis/ripsgele.jpg',
            'position' => 'center',
            ],[
            'user_id' => 1,
            'small' => '/assets/img/recipis/goose.jpg',
            'big' => '/assets/img/recipis/goose.jpg',
            'position' => 'center',
            ],[
            'user_id' => 1,
            'small' => '/assets/img/recipis/oystergrill.jpg',
            'big' => '/assets/img/recipis/oystergrill.jpg',
            'position' => 'center',
            ],[
            'user_id' => 1,
            'small' => '/assets/img/recipis/kongesalat.jpg',
            'big' => '/assets/img/recipis/kongesalat.jpg',
            'position' => 'center',
            ],[
            'user_id' => 1,
            'small' => '/assets/img/recipis/stew.jpg',
            'big' => '/assets/img/recipis/stew.jpg',
            'position' => 'center',
            ],[
            'user_id' => 1,
            'small' => '/assets/img/recipis/haresuppe.jpg',
            'big' => '/assets/img/recipis/haresuppe.jpg',
            'position' => 'center',
            ],
        ],'image');
        
       
        
        return ['populate' => 'done', 'updates' => [
             $db->update(['image' => 2], 'blacklist', ['taxonID' => 3457]),
             $db->update(['image' => 3], 'blacklist', ['taxonID' => 59373]),
             $db->update(['image' => 4], 'blacklist', ['taxonID' => 60308]),
             $db->update(['image' => 5], 'blacklist', ['taxonID' => 63574]),
             $db->update(['image' => 6], 'blacklist', ['taxonID' => 31106]),
             $db->update(['image' => 7], 'blacklist', ['taxonID' => 60303]),
             $db->update(['image' => 8], 'blacklist', ['taxonID' => 14365]),
             $db->update(['image' => 9], 'blacklist', ['taxonID' => 38890]),
             $db->update(['image' => 10], 'blacklist', ['taxonID' => 31227]),
             $db->update(['image' => 11], 'blacklist', ['taxonID' => 3413]),
             $db->update(['image' => 12], 'blacklist', ['taxonID' => 84141]),
             $db->update(['image' => 13], 'blacklist', ['taxonID' => 61212]),
             $db->update(['image' => 14], 'blacklist', ['taxonID' => 62346]),
             $db->update(['image' => 15], 'blacklist', ['taxonID' => 26171]),
             $db->update(['image' => 16], 'blacklist', ['taxonID' => 31237]),
        ]];
    }
}
