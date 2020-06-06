<?php

namespace App;
use App\Contact;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $table="contacts";
    protected $fillable =['id','code','firstname','lastname','gender','phone','mobile','email','company_id','address','status','birthday','place_of_birth','updated_at','created_at'];

 
    //
  public  function lead(){
    return $this->hasMany('App\Model\Lead','company_id','id');
  }

  public function opportunity(){
      return $this->hasMany('App\Model\Opportunity','contact_id','id');
  }

}
