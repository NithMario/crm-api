<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Opportunity extends Model
{

    protected $table = 'opportunity';
    protected $fillable =['id','topic','contact_id','source','stage','amount','close_date','close_date','updated_at','created_at'];

    //
    public function opportunity(){
        return $this->belongsTo('App\Model\Opportunity_Line_Item','id');
    }
    public function contact(){
        return $this->belongsTo('App\Model\Contact','id');
    }

    public function lead(){
        return $this->hasMany('App\Model\Lead','opportunity_id','id');
    }
}
