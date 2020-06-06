<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
// Route::middleware('')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['namespace'=> 'API'], function()
{


    Route::post('login', 'UserController@login');

    Route::post('register', 'UserController@register');
    Route::group(['middleware' => 'auth:api'], function(){

        Route::get('/users','UserController@getUser');
        Route::get('/user/{id}','UsersController@getUser');  
        Route::delete('/deleteuser/{id}','UserController@deleteUser');  

        Route::get('/product', 'ProductController@getAllProduct');
        Route::get('/product/{id}', 'ProductController@getProduct');
        Route::post('/createproduct', 'ProductController@createProduct');
        Route::post('/updateproduct','ProductController@updateProduct');
        Route::delete('/deleteproduct/{id}','ProductController@deleteProduct');
        
        Route::get('/lead', 'LeadController@getAllLead');
        Route::get('/lead/{id}', 'LeadController@getLead');
        Route::post('/createlead', 'LeadController@createLead');
        Route::post('/updatelead/{id}','LeadController@update_lead');
        Route::delete('/deletelead/{id}','LeadController@deleteLead');
        
            //Company Route
        Route::get('/company', 'CompanyController@getAllCompany');
        Route::get('/company/{id}', 'CompanyController@getCompany');
        Route::post('/createcompany', 'CompanyController@createCompany');
        Route::post('/updatecompany/{id}','CompanyController@updateCompany');
        Route::delete('/deletecompany/{id}','CompanyController@deleteCompany');
        
          
            //Contact Route
        Route::get('/contact', 'ContactController@getAllContact');
        Route::get('/contact/{id}', 'ContactController@getContact');
        Route::post('/createcontact', 'ContactController@CreateContact');
        Route::post('/updatecontact','ContactController@updateContact');
        Route::delete('/deletecontact/{id}','ContactController@deleteContact');
        
            // //opportunity Route
        Route::get('/opportunity', 'OpportunityController@getAllOpportunity');
        Route::get('/opportunity/{id}', 'OpportunityController@getOpportunity');
        Route::post('/createopportunity', 'OpportunityController@createOpportunity');
        Route::post('/updateopportunity','OpportunityController@updateOpportunity');
        Route::delete('/deleteopportunity/{id}','OpportunityController@deleteOpportunity');
        
         // //opportunity line item Route
        Route::get('/opportunity_line_item', 'OpportunityLineItemController@getAllOpportunity_line_item');
        Route::get('/opportunity_line_item', 'OpportunityLineItemController@getOpportunity_line_item');
        Route::post('/createopportunity_line_item/{id}', 'OpportunityLineItemController@createOpportunity_line_item');
        Route::post('/updateopportunity_line_item/{id}','OpportunityLineItemController@updateOpportunity_line_item');
        Route::delete('/deleteopportunity_line_item/{id}','OpportunityLineItemController@deleteOpportunity_Line_Item');

        Route::post('/covert/{id}','LeadController@convertLead');
        Route::post('/assign/{id}','LeadController@assignOwner');
     

        
        });
});



Route::group(['namespace'=> 'API'], function()
{


    Route::get('/reportisOpen','ReportController@open');
    Route::get('/reportisCovert','ReportController@close');

   
});