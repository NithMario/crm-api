<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    //
    protected $table = 'users';
    protected $fillable =['id','name','phone','email','postion','permisstion','birthday','photo','updated_at','created_at'];


}
