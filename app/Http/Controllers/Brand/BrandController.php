<?php

namespace App\Http\Controllers\Brand;

use App\Brand;
use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Str as Str;

class BrandController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::all();
        return $this->showAll($brands);
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
        ];

        $this->validate($request, $rules);

        $fields = $request->all();
        //Str::slug convert the string to lowercase, without accents and separated by hyphens.
        $fields['slug'] = Str::slug($request->slug);
        $fields['status'] = Brand::BRAND_ACTIVE;

        $brand = Brand::create($fields);

        return $this->showOne($brand, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $brand = Brand::where('slug','=', $slug)->firstOrFail();
        return $this->showOne($brand);
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
        $brand = Brand::findOrFail($id);

        $rules = [
            'slug' => 'unique:brands,slug,'.$brand->id,
        ];

        $this->validate($request, $rules);
        if($request->has('slug')){
            //Str::slug convert the string to lowercase, without accents and separated by hyphens.
            $brand->slug = Str::slug($request->slug);
        }
        if($request->has('name')){
            $brand->name = $request->name;
        }
        if($request->has('image')){
            $brand->image = $request->image;
        }
        if(!$brand->isDirty()){
            return response()->json(['error' => 'At least one different value must be specified to update',
            'code' => 422], 422);
        }

        $brand->save();
        return $this->showOne($brand);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $brand = Brand::findOrFail($id);

        $brand->delete();

        return $this->showOne($brand);
    }
}
