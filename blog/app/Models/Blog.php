<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    //we added this $fillable so that when editing, it will allow it to 
    //update in the database
    //so it takes all the name in the database,  you want to allow to be update 

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone_no' 
    ];
}
