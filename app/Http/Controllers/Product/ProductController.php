<?php

namespace App\Http\Controllers\Product;

use App\Product;
use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

/**
* @OA\Info(title="API Test-Laravel-Vuetyfi-Vuex", version="1.0")
*
* @OA\Server(url="http://https://laravel-vuetify.herokuapp.com/")
*/


class ProductController extends ApiController
{
    public function index()
    {
    /**
    * @OA\Get(
    *     path="/api/products",
    *       tags={"products"},
    *     summary="shows the complete list of products",
    *     @OA\Response(
    *         response=200,
    *         description="Show list of products."
    *     ),
    *     @OA\Response(
    *         response="default",
    *         description="An error has occurred."
    *     )
    * )
    */
        $products = Product::all();
        return $this->showAll($products);
    }

    public function store(Request $request)
    {
    /**
    * @OA\Post(
    *     path="/api/products",
    *       tags={"products"},
    *     summary="Create a Product",
    *   @OA\Parameter(
    *         name="name",
    *         in="query",
    *         description="The product name",
    *         required=true,
    *         @OA\Schema(
    *           type="string",
    *         ),
    *         style="form"
    *     ),
    *   @OA\Parameter(
    *         name="slug",
    *         in="query",
    *         description="For url friendly, and unique",
    *         required=true,
    *         @OA\Schema(
    *           type="string",
    *         ),
    *         style="form"
    *     ),
    *   @OA\Parameter(
    *         name="description",
    *         in="query",
    *         description="For product characteristics",
    *         required=true,
    *         @OA\Schema(
    *           type="string",
    *         ),
    *         style="form"
    *     ),
    *   @OA\Parameter(
    *         name="image",
    *         in="query",
    *         description="Base64 file to upload",
    *         required=true,
    *         @OA\Schema(
    *           type="file",
    *         ),
    *         style="form"
    *     ),
    *   @OA\Parameter(
    *         name="price",
    *         in="query",
    *         description="sale price",
    *         required=true,
    *         @OA\Schema(
    *           type="decimal",
    *         ),
    *         style="form"
    *     ),
    *   @OA\Parameter(
    *         name="stock",
    *         in="query",
    *         description="amount available",
    *         required=true,
    *         @OA\Schema(
    *           type="integer",
    *         ),
    *         style="form"
    *     ),
    *   @OA\Parameter(
    *         name="status",
    *         in="path",
    *         description="For default is Activated",
    *         required=false,
    *         @OA\Schema(
    *           type="string",
    *         ),
    *     ),
    *   @OA\Response(
    *         response=200,
    *         description="successful operation."
    *     ),
    *   @OA\Response(
    *         response=405,
    *         description="Invalid input."
    *     ),
    *     @OA\Response(
    *         response="default",
    *         description="An error has occurred."
    *     )
    * )
    */
        $rules = [
            'name' => 'required',
            'slug' => 'required',
            'image' => 'required',
            'description' => 'required',
        ];

        $this->validate($request, $rules);

        // image
        $exploded = explode(',', $request->image);
        $decoded = base64_decode($exploded[1]);
        if (Str::contains($exploded[0], 'jpeg'))
            $extension = 'jpg';
        else
            $extension = 'png';
        $fileName = Str::random().'.'.$extension;

        $path = public_path().'/images/products/'.$fileName;

        file_put_contents($path, $decoded);

        $fields = $request->all();

        //Str::slug convert the string to lowercase, without accents and separated by hyphens.
        $fields['slug'] = Str::slug($request->slug);
        $fields['status'] = Product::PRODUCT_AVAILABLE;
        $fields['image'] =  $fileName;
        $product = Product::create($fields);

        return $this->showOne($product, 201);
    }
    public function show($slug)
    {
    /**
    * @OA\Get(
    *     path="/api/products/{slug}",
    *       tags={"products"},
    *     summary="Finds products by Slug",
    *   @OA\Parameter(
    *         name="slug",
    *         in="query",
    *         description="Find by unique slug",
    *         required=true,
    *         @OA\Schema(
    *           type="string",
    *         ),
    *         style="form"
    *     ),
    *   @OA\Response(
    *         response=200,
    *         description="successful operation."
    *     ),
    *   @OA\Response(
    *         response=404,
    *         description="Product no found."
    *     ),
    *     @OA\Response(
    *         response="default",
    *         description="An error has occurred."
    *     )
    * )
    */
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
    /**
    * @OA\Put(
    *     path="/api/products/{id}",
    *       tags={"products"},
    *     summary="Update an existing product",
    *       description="Updates the information of a specific product, validates that at least one of the fields is modified, in case there are changes to the SLUG, check that the new one is not repeated with any that exist in the database, the expected field is Product ID",
    *   @OA\Parameter(
    *         name="id",
    *         in="query",
    *         description="The product id",
    *         required=true,
    *         @OA\Schema(
    *           type="string",
    *         ),
    *         style="form"
    *     ),
    *   @OA\Parameter(
    *         name="name",
    *         in="query",
    *         description="The product name",
    *         required=false,
    *         @OA\Schema(
    *           type="string",
    *         ),
    *         style="form"
    *     ),
    *   @OA\Parameter(
    *         name="slug",
    *         in="query",
    *         description="For url friendly, and unique",
    *         required=false,
    *         @OA\Schema(
    *           type="string",
    *         ),
    *         style="form"
    *     ),
    *   @OA\Parameter(
    *         name="description",
    *         in="query",
    *         description="For product characteristics",
    *         required=false,
    *         @OA\Schema(
    *           type="string",
    *         ),
    *         style="form"
    *     ),
    *   @OA\Parameter(
    *         name="image",
    *         in="query",
    *         description="Base64 file to upload",
    *         required=false,
    *         @OA\Schema(
    *           type="file",
    *         ),
    *         style="form"
    *     ),
    *   @OA\Parameter(
    *         name="price",
    *         in="query",
    *         description="sale price",
    *         required=false,
    *         @OA\Schema(
    *           type="decimal",
    *         ),
    *         style="form"
    *     ),
    *   @OA\Parameter(
    *         name="stock",
    *         in="query",
    *         description="amount available",
    *         required=false,
    *         @OA\Schema(
    *           type="integer",
    *         ),
    *         style="form"
    *     ),
    *   @OA\Parameter(
    *         name="status",
    *         in="path",
    *         description="For default is Activated",
    *         required=false,
    *         @OA\Schema(
    *           type="string",
    *         ),
    *     ),
    *     @OA\Response(
    *         response=200,
    *         description="successful operation."
    *     ),
    *   @OA\Response(
    *         response=404,
    *         description="Product no found."
    *     ),
    *   @OA\Response(
    *         response=405,
    *         description="Invalid input."
    *     ),
    *     @OA\Response(
    *         response="default",
    *         description="An error has occurred."
    *     )
    * )
    */
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

        if( $request->image != $product->image){

            $exploded = explode(',', $request->image);
            $decoded = base64_decode($exploded[1]);
            if (Str::contains($exploded[0], 'jpeg'))
                $extension = 'jpg';
            else
                $extension = 'png';
            $fileName = Str::random().'.'.$extension;

            $path = public_path().'/images/products/'.$fileName;

            file_put_contents($path, $decoded);

            $product->image = $fileName;

        }else{
            $product->image = $product->image;
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
    /**
    * @OA\Delete(
    *     path="/api/products/{id}",
    *       tags={"products"},
    *     summary="delete a specific product",
    *   @OA\Parameter(
    *         name="id",
    *         in="query",
    *         description="The product id",
    *         required=true,
    *         @OA\Schema(
    *           type="string",
    *         ),
    *         style="form"
    *     ),
    *      @OA\Response(
    *         response=200,
    *         description="successful operation."
    *     ),
    *   @OA\Response(
    *         response=404,
    *         description="Product no found."
    *     ),
    *   @OA\Response(
    *         response=405,
    *         description="Invalid input."
    *     ),
    *     @OA\Response(
    *         response="default",
    *         description="An error has occurred."
    *     )
    * )
    */
        $product = Product::findOrFail($id);

        $product->delete();

        return $this->showOne($product);
    }
}
