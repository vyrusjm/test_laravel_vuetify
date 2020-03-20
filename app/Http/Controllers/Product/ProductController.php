<?php

namespace App\Http\Controllers\Product;

use App\Product;
use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class ProductController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return $this->showAll($products);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
            'slug' => 'required',
            'image' => 'required',
            'description' => 'required',
        ];

        $this->validate($request, $rules);

        $fields = $request->all();
        //Str::slug convert the string to lowercase, without accents and separated by hyphens.
        $fields['slug'] = Str::slug($request->slug);
        $fields['status'] = Product::PRODUCT_AVAILABLE;

        $product = Product::create($fields);

        return $this->showOne($product, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $product = Product::where('slug','=', $slug)->first();

        return $this->showOne($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $rules = [
            'slug' => 'unique:products,slug,'.$product->id,
        ];

        $this->validate($request, $rules);
        if($request->has('slug')){
            //Str::slug convert the string to lowercase, without accents and separated by hyphens.
            $product->slug = Str::slug($request->slug);
        }
        if($request->has('name')){
            $product->name = $request->name;
        }

        if($request->has('image')){
            $product->image = $request->image;
        }
        if($request->has('description')){
            $product->description = $request->description;
        }
        if($request->has('stock')){
            $product->stock = $request->stock;
        }
        if($request->has('price')){
            $product->price = $request->price;
        }
        if(!$product->isDirty()){
            return $this->errorResponse('At least one different value must be specified to update', 422);
        }

        $product->save();
        return $this->showOne($product);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        $product->delete();

        return $this->showOne($product);
    }
}
