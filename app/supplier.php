<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class supplier extends Model
{
    //
    protected $table = "supplier";

    protected $fillable = ['company_name', 'email', 'address','phonenumber'];

}
