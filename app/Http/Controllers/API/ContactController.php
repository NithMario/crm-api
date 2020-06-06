<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Contact;

class ContactController extends Controller
{
    //
      // get alll record from table Contact
      public function getAllContact(){
        $contact = Contact::get()->toJson(JSON_PRETTY_PRINT);
        return response($contact, 200);

    }
//get record by id
    public function getContact($id){
        $contact = Contact::findOrFail($id)->toJson(JSON_PRETTY_PRINT);
        return response($contact, 200);

    }

    //create Contact
    public function CreateContact(Request $request) {

        csrf_field();
        $contact = new Contact;
        // $contact->code = $request->code;
        $contact->firstname = $request->firstname;
        $contact->lastname = $request->lastname;
        $contact->gender = $request->gender;
        $contact->phone = $request->phone;
        // $contact->mobile = $request->mobile;
        $contact->email = $request->email;
        $contact->address = $request->address;
        $contact->status = $request->status;
        $contact->birthday = $request->birthday;
        $contact->place_of_birth = $request->place_of_birth;

        $contact->save();
        return response()->json([
            "message" => $contact['firstname']." record created"
        ], 201);
      
      }
    //update reocord Contact
      public function updateContact( Request  $request,$id){

        $contact   = Company::findOrFail($id);

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
        $contact->update($data);

        if ($contact) {
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
    public function deleteContact($id) {
        if(Contact::where('id', $id)->exists()) {
          $contact = Contact::find($id);
          $contact->delete();
  
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
