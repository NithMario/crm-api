<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller\API;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use App\User; 
use Validator;

class UserController extends Controller
{
    public $successStatus = 200;

    public function login(){ 
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){ 
            $user = Auth::user(); 
            $success['token'] =  $user->createToken('crm')-> accessToken; 
            return response()->json([ $success['token']], $this-> successStatus); 
        } 
        else{ 
            return response()->json(['error'=>'Unauthorised'], 401); 
        } 
    }


    public function register(Request $request) 
    { 
        $validator = Validator::make($request->all(), [ 
            'name' => 'required', 
            'email' => 'required|email', 
            'password' => 'required', 
            'c_password' => 'required|same:password', 
        ]);
    if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }
    $input = $request->all(); 
        $input['password'] = bcrypt($input['password']); 
        $user = User::create($input); 
        $success['token'] =  $user->createToken('MyApp')-> accessToken; 
        $success['name'] =  $user->name;
return response()->json(['success'=>$success], $this-> successStatus); 
    }

    public function getUser(){
        return User::all();
    }
    public function deleteUser($id){
        if(User::where('id', $id)->exists()) {
            $user = User::find($id);
            $user->delete();
    
            return response()->json([
              "message" => "user records deleted"
            ], 202);
          } else {
            return response()->json([
              "message" => " not found"
            ], 404);
          }
    }
}
