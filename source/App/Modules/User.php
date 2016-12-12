<?php
namespace App\Modules;
use DB, Account;

class User{
  public $id;
  public $username;
  public $cookie;
  public $mail;
  public $password;
  public $avatar;
  public $avatar_thumb;
  public $recipes = [];
  public $rank;
  //private $profile_image; apør Agnons

    public function __construct($query = null){
        if(gettype($query) != 'array'){
            $query = DB::query('SELECT * FROM users as u
            INNER JOIN image AS i ON u.image = i.id
            WHERE u.id = :id', ['id' => $query])->fetch();
        }
        if($query != null){
            $this->id           = $query['id'];
            $this->username     = $query['username'];
            $this->cookie       = $query['cookie'];
            $this->mail         = $query['mail'];
            $this->password     = $query['password'];
            $this->avatar       = $query['big'];
            $this->avatar_thumb = $query['small'];
            //1 = admin, 2 = moderator, 4 = bruker
            $this->rank         = $query['rank']; 
        }
    }


    /**
     * Featch the users recipes
     * @author Agne *degaard
     * @return array of Recipe objects
     */
    public function getAllRecipes(){
        if(!empty($this->recipes)) return $this->recipes;
        $result = DB::query('SELECT r.*, i.big as image, i.small as thumbnail FROM recipies AS r
        INNER JOIN image AS i ON r.image = i.id WHERE r.user_id = :id',['id' => $this->id], 'Recipie')->fetchAll();

        return $this->recipes;
    }


    /**
     * Chnage password
     * @author Agne *degaard
     * @param  string $pw     
     * @param  string $newPw  
     * @param  string   $newPw2
     * @return str    Error msg or true on success
     */
    public function changePassword($pw, $newPw, $newPw2){
        return Account::changePassword(new self($this->id), $pw, $newPw, $newPw2);
    }

    /**
     * change mail
     * @author Agne *degaard
     * @param  string   $newMail
     * @return boolean
     */
    public function changeEmail($newMail){
        return Account::changeEmail($newMail);
    }

    /**
     * get rank
     * @author Agne *degaard
     * @return integer
     */
    public function getRank(){
        return $this->rank;
    }


}//class
