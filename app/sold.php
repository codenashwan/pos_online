<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class sold extends Model
{
    //
    
    protected $table = "sold";
    protected $fillable = ['user_id', 'stock_id', 'clean','price_at' , 'piece'];


    public function chashier(){
        return $this->hasOne('App\User' , 'id' , 'user_id');
    }
    public function one_stock(){
        return $this->hasOne('App\stocks' , 'id' , 'stock_id');
    }
}
