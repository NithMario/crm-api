<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Opportunity_Line_Item extends Model
{
    protected $table = 'opportunity_line_item';

    protected $fillable =['id','product_id','qty','unit_price','amount','discount','sale_description','opportunity_id','updated_at','created_at'];

    public function product(){
        return $this->belongsTo('App\Model\Product','id');
    }

    public function opportunity(){
        return $this->hasMany('Appp\Model\Opportunity','opportunity_id','id');
    }
    //
}
