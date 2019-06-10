<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductSale extends Model
{
    protected $table = 'product_sale';
    protected $fillable=['product_id','sale_id','price'];
}
