<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;  

class Admin extends Authenticatable   // for make auth like users
{
    protected $table = "admins" ;
    protected $fillable = [ "name" , "email" , "password" ] ; 
    protected $hidden = [ 'password' ];
}