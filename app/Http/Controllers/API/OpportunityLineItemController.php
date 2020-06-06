<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Opportunity_Line_Item;
use App\Opportunity;

class OpportunityLineItemController extends Controller
{
// get alll record from table opportunity
public function getAllOpportunity_line_item(){
    $opportunity_line_item = Opportunity_Line_Item::get()->toJson(JSON_PRETTY_PRINT);
    return response($opportunity_line_item, 200);
}
//get record by id
public function getOpportunity_line_item($id){
    $opportunity_line_item = Opportunity_Line_Item::findOrFail($id)->toJson(JSON_PRETTY_PRINT);
    return response($opportunity_line_item, 200);
}

//create opportunity
public function createOpportunity_line_item(Request $request,$id) {
    csrf_field();
    $request->validate([
        'qty'  => 'required',
        'unit_price'  => 'required',
       
    ]);
    
    $opportunity_line_item = new Opportunity_Line_Item;
    
    $opportunity_line_item->product_id = $request->product_id;
    $opportunity_line_item->qty = $request->qty;
    $opportunity_line_item->unit_price = $request->unit_price;
    $opportunity_line_item->amount = $request->qty*$request->unit_price;
    $opportunity_line_item->discount = $request->discount;
    $opportunity_line_item->sale_description = $request->sale_description;
    $opportunity_line_item->opportunity_id = $request->opportunity_id;
    $opportunity_line_item->product_id = $request->product_id;

    $opportunity_line_item->save();
    $oppt = new Opportunity;
    
    $oppt ->amount =  $request->qty;
    Opportunity::where('id',$id)->update(['amount'=>$request->qty*$request->unit_price]);

    return response()->json([
        "message" => $opportunity_line_item['opportunity_line_item']." record created"
    ], 201);
  
  }

//update reocord company
  public function updateOpportunity_line_item(Request  $request,$id){
    $opportunity_Line_Item   = Opportunity_Line_Item::findOrFail($id);

    $request->validate([
        'sale_description'  => 'required',
      
    ]);


$data   = $request->all();

// create action
$opportunity_Line_Item->update($data);

if ($opportunity_Line_Item) {
    return response()->json([
        'updated'    => true,
        'message'   => 'Successfully updated lead.',
    ]);
} else {
    return response()->json([
        'updated'    => false,
        'message'   => 'Unable to update lead.'
    ]);
}
}
  //delete record
public function deleteOpportunity_Line_Item($id) {
    if(Opportunity_Line_Item::where('id', $id)->exists()) {
      $opportunity_Line_Item = Opportunity_Line_Item::find($id);
      $opportunity_Line_Item->delete();

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
