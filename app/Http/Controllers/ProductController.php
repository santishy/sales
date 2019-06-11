<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return Product::search($request->word)->orderBy('id','desc')->paginate(20);
    }
    public function lastTenProducts(){
      return Product::orderBy('id','desc')->take(5)->get();
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
          'provider' => 'required',
          'imei' => 'required|unique:products',
          'purcharse_price' => 'required',
          'sale_price' => 'required',
          'brand' => 'required',
          'model' => 'required',
          'color' => 'required'
        ],[
          'required' => 'El campo es requerido',
          'unique' => 'Este IMEI ya existe en la base de datos'
        ]);
        return Product::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Product $product)
    {
      $data = $request->all();
      $validator = Validator::make($data, [
        'imei' => [
                'required',
                Rule::unique('products')->ignore($product->id),
        ],
        'provider' => 'required',
        'purcharse_price' => 'required',
        'sale_price' => 'required',
        'brand' => 'required',
        'model' => 'required',
        'color' => 'required'
      ],[
        'required' => 'El campo es requerido',
        'unique' => 'Este IMEI ya existe en la base de datos'
      ])->validate();

        $product->update($request->all());
        return response()->json($product);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return response()->json(Product::destroy($id));

    }
}
