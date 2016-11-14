<?php
namespace App\Modules;
use DB, Account;

class User{
  public $id;
  public $username;
  public $password;
  public $cookie;
  public $name;
  public $mail;
  public $recipes = [];
  //private $profile_image; apør Agnons

  public function __construct($id){
    $this->id           = $id;
    $query = DB::select(['*'], 'users', ['id' => $this->id])->fetch();

    $this->username     = $query['username'];
    $this->password     = $query['password'];
    $this->cookie       = $query['cookie'];
    $this->name         = $query['name'];
    $this->mail         = $query['mail'];
  }//__construct()

  /***************
  * Getters
  ****************/

  public function getAllRecipes(){
    if(!empty($this->recipes)) return $this->recipes;
    $result = DB::select(["*"],'users',['user_id' => $this->id])->fetAll(); //todo user_id
    foreach($result as $key => $value) {
      $this->recipes[$value['id']] = new Recipe($value);
    }
    return $this->recipes;
  }//getAllRecipes()

  /***************
  * Setters
  ****************/

  public function changePassword($pw, $newPw){
    return Account::changePassword($this->id, $pw, $newPw);
  }

  public function changeEmail($newMail){
    return Account::changeEmail($newMail);
  }//changeEmail()



}//class
