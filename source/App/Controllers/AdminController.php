<?php
namespace App\Controllers;

use View, Direct, Route; // Routing
use Taxon, Csv, Maps; // APIs
use BaseController, Migrations, Row;
use App\Api\Populate as pop;

use Recipie;

/**
 * making a view with/without variables to render
 * @return object View
 */
class AdminController extends BaseController {

    public function index(){
        $species = $this->query('SELECT b.*, im.small, count(i.id) as recipes
            FROM blacklist AS b
            LEFT JOIN ingredients AS i ON i.taxonID = b.taxonID
            LEFT JOIN image AS im ON b.image = im.id
            GROUP BY b.id
            ORDER BY b.navn, b.canEat')->fetchAll();

        $users = $this->select(['id, username, mail, image, rank'], 'users')->fetchAll();

        $recipes = $this->query('SELECT r.*, i.small as image, AVG(ra.rating) as rating, u.username as username
         FROM recipies AS r
         INNER JOIN image AS i ON r.image = i.id
         LEFT JOIN ratings AS ra ON ra.recipe_id = r.id
         LEFT JOIN users as u ON r.user_id = u.id
         GROUP BY r.id
         ORDER BY username desc')->fetchAll();

        return View::make('admin.index', [
            'sepcies' => $species,
            'users'   => $users,
            'recipes' => $recipes
        ]);

    }
}
