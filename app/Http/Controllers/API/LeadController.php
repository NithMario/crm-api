<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Lead;
use App\Company;
use App\Opportunity;
use App\Contact;
use DB;
use App\Model\Users;

class LeadController extends Controller
{
  //
  public function getLead($id)
  {
    $lead = Lead::findOrFail($id)->toJson(JSON_PRETTY_PRINT);
    return response($lead, 200);
  }

  public function getAllLead()
  {
    $lead = Lead::get()->toJson(JSON_PRETTY_PRINT);
    return response($lead, 200);
  }

  public function createLead(Request $request)
  {
    csrf_field();
    $lead = new Lead;
    $lead->firstname = $request->firstname;
    $lead->lastname = $request->lastname;
    $lead->gender = $request->gender;
    $lead->phone = $request->phone;
    $lead->mobile = $request->mobile;
    $lead->email = $request->email;
    $lead->company = $request->company;
    $lead->industry = $request->industry;
    $lead->requirement = $request->requirement;
    $lead->feedback = $request->feedback;
    $lead->reason = $request->reason;
    $lead->owner = $request->owner;
    $lead->status = $request->status;

    $lead->user_id = $request->assign_to_id;
    $lead->website = $request->website;

    $lead->position = $request->position;
    $lead->contact_address = $request->contact_address;
    $lead->topic = $request->topic;

    $lead->save();
    return response()->json([
      "message" => $lead['firstname'] . " record created"
    ], 201);
  }


  public function update_lead(Request  $request, $id)
  {


    $lead   = Lead::findOrFail($id);

    // Validate request 
    $request->validate([
      'firstname'  => 'required',
      'lastname'  => 'required',
      'phone'  => 'required',
      'mobile'  => 'required',
      'company'  => 'required',
      'phone'  => 'required',
      'status'  => 'required',
    ]);

    // Get request object as array 
    $data   = $request->all();

    // create action
    $lead->update($data);

    if ($lead) {
      return response()->json([
        'updated'    => true,
        'message'   => $data['status'] . 'Successfully updated lead.',
      ]);
    } else {
      return response()->json([
        'updated'    => false,
        'message'   => 'Unable to update lead.'
      ]);
    }
  }


  public function deleteLead($id)
  {
    if (Lead::where('id', $id)->exists()) {
      $lead = Lead::find($id);
      $lead->delete();

      return response()->json([
        "message" => "records deleted"
      ], 202);
    } else {
      return response()->json([
        "message" => " not found"
      ], 404);
    }
  }
  public function assignOwner(Request $request, $id)
  {

    //select record by name that request from front end 
    $user = DB::table('users')->where('name', $request->name)->first();
    // return  response()->json($user->id);

    if ($user != null) {
      // $lead->user_id = $user->id;
      $lead = Lead::find($id);


      // $lead->user_id = $user->id;

      if ($lead) {
        $lead->user_id = $user->id;
        $lead->update();
      }


      if ($lead) {
        return response()->json([
          'updated'    => true,
          'message'   => 'Successfully Assigned User',
        ]);
      } else {
        return response()->json([
          'updated'    => false,
          'message'   => 'Unable to Assign'
        ]);
      }
    }

    // $lead = Users::where('id',$request->name)->get();

    return response()->json($user, 200);
  }

  public function convertLead(Request $request, $id = null)
  {

    $opportunity = new Opportunity;
    $contact = Contact::where('firstname', '=', $request->firstname)->first();
    $company = new Company;
    if ($contact == null && $request->status != 'converted') {//check if contact already exist
      $contact = new Contact;


      $company->name = $request->company;
      $company->address = $request->address;
      $company->website = $request->website;
      $company->phone = $request->phone;
      $company->industry = $request->industry;
      $company->email = $request->email;

      //contact

      $contact->firstname = $request->firstname;
      $contact->lastname = $request->lastname;
      $contact->gender = $request->gender;
      $contact->phone = $request->phone;
      $contact->mobile = $request->mobile;

      $contact->email = $request->email;
      $contact->address = $request->address;
      $contact->status = $request->status;
      $contact->birthday = $request->birthday;
      $contact->place_of_birth = $request->place_of_birth;
      $contact->address = $request->address;

      // add company record before query id 
      $company->save();



      //object opportunity
      $opportunity->topic = $request->topic;
      $opportunity->contact_id = $request->contact_id;
      $opportunity->source = $request->source;
      $opportunity->stage = $request->stage;
      $opportunity->amount = $request->amount;
      $opportunity->close_date = $request->close_date;




      $result = DB::Table('company')->select('id')->where('name', $request->company)->get();

      //get id from table company 
      $contact->company_id = $result[0]->id;

      $lead = Lead::findOrFail($id);
      if ($lead) {
        $lead->status = 'converted';
        $lead->save();
        $contact->save();
        $contactId = DB::Table('contacts')->select('id')->where('firstname', $request->firstname)->first();
        $opportunity->contact_id = $contactId->id;
        $opportunity->company_id = $result[0]->id;


        $opportunity->save();
      }
      return response()->json([
        'insert'    => true,
        'message'   =>  'Successfully updated lead.',
      ]);
    } else {
      return response()->json([
        'insert'    => false,
        'message'   =>  'this record already exist: ',
      ]);
    }
  }
}
