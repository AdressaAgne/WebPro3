<?php
namespace App\Controllers;

use View, Direct; // Routing
use BaseController, User, Account, Uploader;

/**
 * making a view with/without variables to render
 * @return object View
 */
class ProfileController extends BaseController {

    public function index(){
        return View::auth('profile', '/login');
    }
    
    public function edit($param){
        $user = new User($_SESSION['uuid']);
        $msg = $user->changePassword($param['old_pw'], $param['new_pw'], $param['new_pw2']);
        
        if(gettype($msg) == 'string'){
            return View::auth('edit.profile', '/login', ['msg' => $msg]);
        }
        
        return Direct::re('/profile');
    }
    
    public function profieEdit(){
        return View::auth('edit.profile', '/login');
    }
    
    public function ajaxUpload($values){
        $up = new Uploader($_FILES['file']);
        $up = $up->upload();
        
        $this->update(['image' => $up['id']],'users', ['id' => Account::get_id()]);
        
        return ['path' => $up['folder'], 'id' => $up['id']];
    }
}
