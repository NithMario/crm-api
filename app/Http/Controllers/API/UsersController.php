<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Model\Users;

class UsersController extends Controller
{
   
        // get alll record from table opportunity
        public function getAllUsers(){
            $users = Users::get()->toJson(JSON_PRETTY_PRINT);
            return response($users, 200);
        }
    //get record by id
        public function getUser($id){
            $user = Users::findOrFail($id)->toJson(JSON_PRETTY_PRINT);
            return response($user, 200);
        }
}
