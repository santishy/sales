<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['provider','brand','model','imei','purcharse_price','sale_price','description','color'];
    public function scopeSearch($query,$word){
      if(trim($word) != '')
        return $query->where(\DB::raw('concat(imei,model,brand)'),'LIKE',"%$word%");
    }
}
