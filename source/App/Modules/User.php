<?php
namespace App\Modules;
use DB, Account;

class User{
  public $id;
  public $username;
  public $cookie;
  public $mail;
  public $password;
  public $recipes = [];
  //private $profile_image; apør Agnons

  public function __construct($id){
    $this->id           = $id;
    $query = DB::select(['*'], 'users', ['id' => $this->id])->fetch();
    $this->username     = $query['username'];
    $this->cookie       = $query['cookie'];
    $this->mail         = $query['mail'];
    $this->password     = $query['password'];
  }//__construct()


  public function getAllRecipes(){
    if(!empty($this->recipes)) return $this->recipes;
    $result = DB::query('SELECT r.*, i.big as image, i.small as thumbnail FROM recipies AS r
        INNER JOIN image AS i ON r.image = i.id WHERE r.user_id = :id',['id' => $this->id])->fetchAll();

    foreach($result as $key => $value) {
      $this->recipes[$value['id']] = new Recipie($value);
    }
    return $this->recipes;
  }//getAllRecipes()


  public function changePassword($pw, $newPw, $newPw2){
      return Account::changePassword(new self($this->id), $pw, $newPw, $newPw2);
  }

  public function changeEmail($newMail){
      return Account::changeEmail($newMail);
  }//changeEmail()



}//class
