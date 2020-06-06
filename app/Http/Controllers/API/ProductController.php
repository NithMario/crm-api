<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Product;

class ProductController extends Controller
{
    // get alll record from table opportunity
    public function getAllProduct(){
        $product = Product::get()->toJson(JSON_PRETTY_PRINT);
        return response($product, 200);
    }
//get record by id
    public function getProduct($id){
        $product = Product::findOrFail($id)->toJson(JSON_PRETTY_PRINT);
        return response($product, 200);
    }

    //create opportunity
    public function createProduct(Request $request) {
        csrf_field();
        $product = new Product;
        $product->name = $request->name;
        $product->barcode = $request->barcode;
        $product->category = $request->category;
        $product->sale_price = $request->sale_price;
        $product->regular_price = $request->regular_price;
        $product->description = $request->description;
        $product->source = $request->source;

        $product->save();
        return response()->json([
            "message" => $product['firstname']." record created"
        ], 201);
      
      }
    //update reocord company
      public function updateProduct( Request  $request){


        $form = array(
            "name"=>$request->name,
            "barcode"=>$request->barcode,
            "category"=>$request->category,
            "sale_price"=>$request->sale_price,
            "regular_price"=>$request->regular_price,
            "description"=>$request->description,
            "source"=>$request->source,
            "id"=>$request->id
        );
        Product::where('id',$request->id)->update($form);
    }

      //delete record
    public function deleteProduct($id) {
        if(Product::where('id', $id)->exists()) {
          $opportunity = Product::find($id);
          $opportunity->delete();
  
          return response()->json([
            "message" => "records deleted"
          ], 202);
        } else {
          return response()->json([
            "message" => " not found"
          ], 404);
        }
      }
}
