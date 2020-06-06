<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Opportunity;

class OpportunityController extends Controller
{
      // get alll record from table opportunity
      public function getAllOpportunity(){
        $opportunity = Opportunity::get()->toJson(JSON_PRETTY_PRINT);
        return response($opportunity, 200);

    }
//get record by id
    public function getOpportunity($id){
        $opportunity = Opportunity::findOrFail($id)->toJson(JSON_PRETTY_PRINT);
        return response($opportunity, 200);

    }

    //create opportunity
    public function createOpportunity(Request $request) {
     
        $opportunity = new Opportunity;
        $opportunity->topic = $request->topic;
        $opportunity->contact_id = $request->contact_id;
        $opportunity->source = $request->source;
        $opportunity->stage = $request->stage;
        $opportunity->amount = $request->amount;
        $opportunity->close_date = $request->close_date;
        $opportunity->company_id = $request->company_id;
        $opportunity->save();
        return response()->json([
            "message" => $opportunity['firstname']." record created"
        ], 201);
      
      }
    //update reocord company
      public function updateOpportunity( Request  $request,$id){


        $opportunity   = Opportunity::findOrFail($id);

        // Validate request 
        $request->validate([
            'name'  => 'required',
            'phone'  => 'required',
     
        ]);

        // Get request object as array 
        $data   = $request->all();

        // create action
        $opportunity->update($data);

        if ($opportunity) {
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
    public function deleteOpportunity($id) {
        if(Opportunity::where('id', $id)->exists()) {
          $opportunity = Opportunity::find($id);
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
