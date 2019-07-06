<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    public static function findOrCreateSale($sale_id){
      if($sale_id)
        return Sale::find($sale_id);
      else {
        $sale = Sale::create();
        \Session::put('sale_id',$sale->id);
        \Session::save();
        dd('esto eslae: '.$sale);
        return $sale;
      }
    }

    public function products(){
      return $this->belongsToMany('App\Product')->withPivot('price','id');
    }
}
