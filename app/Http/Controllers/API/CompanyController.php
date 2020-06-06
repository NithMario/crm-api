<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Company;

class CompanyController extends Controller
{
    // get alll record from table company
    public function getAllCompany(){
        $company = Company::get()->toJson(JSON_PRETTY_PRINT);
        return response($company, 200);

    }
//get record by id
    public function getCompany($id){
        $company = Company::findOrFail($id)->toJson(JSON_PRETTY_PRINT);
        return response($company, 200);

    }

    //create company
    public function createCompany(Request $request) {
    
        $company = new Company;
        $company->name = $request->company;
        $company->address = $request->address;
        $company->website = $request->website;
        $company->phone = $request->phone;
        $company->industry = $request->industry;
        $company->email = $request->email;

        $company->save();
        return response()->json([
            "message" => $company['address']." record created"
        ], 201);
      
      }
    //update reocord company
      public function updateCompany(Request  $request,$id){
        $company   = Company::findOrFail($id);

        // Get request object as array 
        $data   = $request->all();

        // create action
        $company->update($data);

        if ($company) {
            return response()->json([
                'updated'    => true,
                'message'   => 'Successfully updated'.$request->name,
            ]);
        } else {
            return response()->json([
                'updated'    => false,
                'message'   => 'Unable to update lead.'
            ]);
        }

    }

      //delete record
    public function deleteCompany($id) {
        if(Company::where('id', $id)->exists()) {
          $company = Company::find($id);
          $company->delete();
  
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
