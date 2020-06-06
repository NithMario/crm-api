<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table="company";
    protected $fillable =['id','name','address','website','phone','industry','email','updated_at','created_at'];


    public function lead(){
        return $this->hasMany('App\Model\Lead','contact_id','id');
    }
}
