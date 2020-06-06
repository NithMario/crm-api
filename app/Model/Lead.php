<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    protected $table="leads";
    protected $fillable =['id','firstname','lastname','gender','phone','mobile','email','company','industry','requirement','feedback','reason','owner','status','assign_to_id','website','position',
    'contact_address','topic','company_id','contact_id','opportunity_id','updated_at','created_at'];

    public function company(){
        return $this->belongsTo('App\Model\Company','id');
    }
    
    public function contact(){
        return $this->belongsTo('App\Model\Contact','id');
    }

    public function opportunity(){
        return $this->belongsTo('App\Model\Opportunity','id');
    }

}
