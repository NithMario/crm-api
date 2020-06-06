<?php

namespace App;
use App\Product;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $fillable =['id','name','barcode','category','sale_price','regular_price','description','source','updated_at','created_at'];

       public function lineItem(){
           return $this->hasMany('App\Model\Opportunity_Line_Item','product_id','id');
       }

}
