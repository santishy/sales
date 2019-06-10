<?php

namespace App\Http\Controllers;
use App\ProductSale;
use App\Rules\validatProductForSale;
use Illuminate\Http\Request;
//use App\Events\ProductForSaleEvent;

class ProductSaleController extends Controller
{
    public function __construct(){
      $this->Middleware('sale');
    }
    public function index(Request $request){
      return $request->sale->products()->get();
    }
    public function store(Request $request){
      $request->validate(['product_id'=>['required',new validatProductForSale]]);
      $data = $request->all();
      $data['sale_id'] = $request->sale->id;
      $productSale = ProductSale::create($data);
      // Hay que reutilizar este codigo para finalizar una venta o para eliminar una venta ya htmlspecialcha
      // y ponga de nuevo las existencias en uno, o en cero dependiendo el caso
      //event(new ProductForSaleEvent($request->sale));
      return $productSale;
    }
}
