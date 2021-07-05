<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    //-------create new blog---------//
        //CREATING  ENDPOINT TO POST OR INSERT TO OUR DATABASE

    // we added this Request $request to the function
    //so that our function knows, that we are expecting something from the USER
    public function create(Request $request){

        //so firstly, let validate our form
        //this 'first_name', 'last_name', 'email' and 'phone_no'
        //this are the tables we created in the database that we are trying to validate
        //for example 'first_name' => 'required|min:4',
        //this means first_name field is required for user and the letters must not me lesser than 4
         //we can also do maximum , which will be max:6
         //for this unique:blogs, that means the value there must be unique
         //must not have being used by another person before
         //and the blogs infront of it, is refering to the table
         //which is this 2021_07_03_134211_create_blogs_table.php
         //that is created inside our migration folder
         //so if we are refereing to another table called students, any filed that we want it to be unique
         //will be unique:students
        
        
        $validate = $request->validate([
                'first_name' => 'required|min:4',
                'last_name' => 'required|min:4',
                'email' => 'required|unique:blogs',
                'phone_no' => 'required|max:11|min:11|unique:blogs'

        ]);

        //so in this place,we do the same way we do in procedural programming
        //when collecting the input of the user and storing it inside a avariable before
        //sending it to the database, i mean this , $myFirstName = $_POST['firstName']
        // but here we will have to do it in a different form
        //so, we do like this, give it a variable first $theFirstName 
        //then assign the value to it, like this
        //$theFirstName = $request->input('first_name')
        //then $request, is the to let our database that we are posting something 
        //and it is input('first_name')
        // this same first_name , is the name of one of the field in the table,
        //so it has to match the name of the field you are input in the database

        $theFirstName = $request->input('first_name');
        $theLastName = $request->input('last_name');
        $theEmailAdd = $request->input('email');
        $userPhoneNo= $request->input('phone_no');

        // so the next thing now is to insert it to the database
        //we can do this in 2 ways
        //either you use Eloquent or Query Builder
        //but we will use Eloquent
        //you call the Blog Model file by typing the name of the File
        //Blog, then this infront :: , this automatically imports the Blog model and place it at the top
        //i mean this , use App\Models\Blog;
        //Then insert([]);
        //Blog::insert([]);
        // for this 'first_name'=> '$theFirstName', the first_name, is the field in the table
        //then $theFirstName , is the value to be inserted in the field
        //our create_at field is set to Carbon::now() , this will automatically inser the current time and date
        //just the way we do in procedural php programming by using NOW()

        Blog::insert([

            'first_name'=> $theFirstName,
            'last_name' => $theLastName,
            'email' => $theEmailAdd,
            'phone_no' => $userPhoneNo,
            'created_at' => Carbon::now()
            

        ]);

        
        // this is the result it will display on our postman
        //it will display a status of success , if the api is well consumed
        // then we set a value of 'create' , we can use the name of the method in the BlogController
        // and it has the following details
        //method, which has the value of POST, jsut to let the person consuming the api
        // ypou are creating is a POST method
        //then the link it is splash with the url is create/newblog , just as stated in the Route
        //then the param, is to to let the user consuming the api,
        //that this are the values you can consume from the api created
        //'first_name'=> $theFirstName, -- doing this below inside the $data, will display all the value inserted 
        //when the api is successfully consumed
        //'last_name' => $theLastName,
        //'email' => $theEmailAdd,
        //'phone_no' => $userPhoneNo, -- doing this below inside the $data, will display all the value inserted 
        //when the api is successfully consumed

        $data =  [
            'status' => 'success',
            'first_name'=> $theFirstName,
            'last_name' => $theLastName,
            'email' => $theEmailAdd,
            'phone_no' => $userPhoneNo,
            'create' => [
                'method' => 'POST',
                'href' => 'create/newblog',
                'param' => 'fisrt_name, last_name, email, phone_no'
            ]
            ];

            //the below is what you want to return to the user, to see, when the data 
            //is successfully consumed
        $response = [
            'message' => 'Blog Successfully created',
            'data' => $data
        ];

        //you know for every request there must be a response
        //so to set the response
        //our json() will take 2 parameters
        //the $response and our success value, which is 200 by default
        return response()->json($response, 200);



    }


    //LET'S CREATE ANOTHER ENDPOINT TO VIEW ALL OUR RECORDS

    //---fetch all records --//
    //for this one , we don't need the request value or parameter like we use above
    // so let's go and set our route inside api.php
   

    public function displayRecords(){
        //so to fetch all the data of the blogs table
        //all we just have to do, si to call the name of the Mode, which is Blog
        //so this Blog::all(); stand for SELECT * FROM blogs ;
        //we stored fetching all the data from the table inside $theBlogs
        //then give it a status of success
        // then give it a key of 'data' and set a value of $theBlogs
        // did the same thing we did above, by letting the user know that it is a GET method
        //and also set the link of the url
        //we now set the $response and and give it an array , which is [],
        //that has the value of the message to display and also the data to fetch from the database
        // then we created  return response()->json($response, 200);, to return a json 
        //which has the variable of $response and success which is 200 by default

        $theBlogs = Blog::all();
        $data =  [
            'status' => 'success',
            'data' => $theBlogs,
            'displayRecords' => [
                'method' => 'GET',
                'href' => 'show/allblog',
            ]
            ];

            $response = [
                'message' => 'Details Gotten Successfully',
                'data' => $data
            ];
    
            //you know for every request there must be a response
            //so to set the response
            //our json() will take 2 parameters
            //the $response and our success value, which is 200 by default
            return response()->json($response, 200);

    }



    //LET'S CREATE ANOTHER ENDPOINT TO EDIT A PARTICULAR RECORD

    //---edit a single record --//
    //this is also going to be a POST method
    //that is why we have Request $request and also take a parameter of $id
    //the $id is going to take the value of the id we want to edit

    public function editBlog(Request $request, $id){

        $theEditFirstName = $request->input('first_name');
        $theEditLastName = $request->input('last_name');
        $theEditEmailAdd = $request->input('email');
        $userEditPhoneNo= $request->input('phone_no');

        //then use the model to update the data in the database
        // by using the Blog::find($id)->update()
        //that find($id) is saying, go and find a particular id
        //e.g find(1) or find(2)
        //so once it has find it
        //it update the particular id , that is found
        //so this are the value it can update
        //'first_name' => $theEditFirstName, the first_name is the table in the database
        //then $theEditFirstName is the value you inserted , 
        //that means the new value you are putting into the database

        Blog::find($id)->update([
            'first_name' => $theEditFirstName,
            'last_name' => $theEditLastName,
            'email' =>  $theEditEmailAdd,
            'phone_no' => $userEditPhoneNo,
            'created_at' => Carbon::now()
        ]);

     
        //then , do the same thing has done above
        //let the user know that it is a post method
        //name the href of the url
        $data =  [
            'status' => 'success',
            'editblog' => [
                'method' => 'POST',
                'href' => 'edit/blog/{id}',
            ]
            ];

            // then set a response variable

            $response = [
                'message' => 'Details Updated Successfully',
                'data' => $data
            ];

            return response()->json($response,200);

            // then go to the model Blog, which is Blog.php
            // and make it fillable
    }

}
