<?php

use App\Http\Controllers\BlogController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//------------------create blog ---------------//
// we are creating a post verb or function
// it takes the variable, firstly,
//it takes how u want the extension to look like
//http://127.0.0.1:8000/newblog
//then takes the controller name and the function you want to hint inside the controller
//i.e [BlogController::class, 'create']
// so in laravel 8, it is always like this,
//Route::post('/newblog',[BlogController::class, 'create']);

//but in laravel 7 and below, it is done like this
//Route::post('/newblog','BlogController@create');
// that means is talking to the BlogController and requesting for the 
//create function inside the BlogController
//Route::group(['prefix' => 'v1'], function(){}
// the above is just stating that, the is the version 1 of your end point
//at a point in time, we might decide to want to change the  whole end point, we can create a new one like this
//Route::group(['prefix' => 'v2'], function(){} ... continuously like that...


Route::group(['prefix' => 'v1'], function(){

    // this route , is the end point to create a new blog
    //post is an http method or http verb, this basically for inserting data into our database
    //if we are getting data from our database, we will use get http method or verb e.t.c
    //----------Create Blog ------------//

    Route::post('create/newblog',[BlogController::class, 'create']);


    //----------Fetch all Blog ------------//
   // we can name this show/allblog, as we want it..

    Route::get('show/allblog',[BlogController::class, 'displayRecords']);


        //----------edit a particular Blog ------------//
        //we had to add the {id} , so that it will be like this
        //http://127.0.0.1:8000/api/v1/edit/blog/1
        //http://127.0.0.1:8000/api/v1/edit/blog/2
        // the 1 and the 2 added to the back of the url is telling us, the id 
        //it is fetching from the database
   
     Route::post('edit/blog/{id}',[BlogController::class, 'editBlog']);
});