<?php

namespace App\Http\Controllers\Category;

use App\Category;
use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Str as Str;

class CategoryController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return $this->showAll($categories);
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
        $fields['status'] = Category::CATEGORY_ACTIVE;

        $category = Category::create($fields);

        return $this->showOne($category, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $category = Category::where('slug','=', $slug)->firstOrFail();
        return $this->showOne($category);
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
        $category = Category::findOrFail($id);

        $rules = [
            'slug' => 'unique:categories,slug,'.$category->id,
        ];

        $this->validate($request, $rules);
        if($request->has('slug')){
            //Str::slug convert the string to lowercase, without accents and separated by hyphens.
            $category->slug = Str::slug($request->slug);
        }
        if($request->has('name')){
            $category->name = $request->name;
        }
        if($request->has('image')){
            $category->image = $request->image;
        }
        if($request->has('description')){
            $category->description = $request->description;
        }
        if(!$category->isDirty()){
            return $this->errorResponse('At least one different value must be specified to update', 422);
        }

        $category->save();
        return $this->showOne($category);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        $category->delete();

        return $this->showOne($category);
    }
}
