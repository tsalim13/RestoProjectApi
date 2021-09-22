<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use App\Product;
use App\ProductOption;

class ProductAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with('options')->with('optionGroups')->with('category')->get();

        //sleep(3);
        return $this->sendResponse($products, "products api success");
    }

    public function categoryproducts($categoryId) 
    {
        $products = Product::where('category_id', $categoryId)->with('options')->with('optionGroups')->get();

        return $this->sendResponse($products, "products api success");
    }

    public function productbycategory($categoryId) 
    {
        $product = Product::where('category_id', $categoryId)->with('options')->with('optionGroups')->first();

        return $this->sendResponse($product, "products api success");
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
        
        $input = $request->all();

        $product = Product::create(json_decode($input['product'], true));
        $product->options()->sync(json_decode($input['options'], true));
        $product->optionGroups()->sync(json_decode($input['option_groups'], true));
        if ($request->hasFile('image')) {
            $product->addMediaFromRequest('image')->toMediaCollection('Products');
        }

        $product = Product::find($product->id);

        return $this->sendResponse($product, "product api success");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::where('id', $id)->with('options')->with('optionGroups')->first();

        return $this->sendResponse($product,"product api success");
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
    public function update(Request $request, $id)
    {
        // call index
        $input = $request->all();
        Log::debug("input update");
        Log::debug($input);



    }

    public function updateProductOptions(Request $request, $id)
    {
        $input = $request->all();
        Log::debug("******* input updateProductOptions *******");
        Log::debug($input['options']);
        Log::debug($id);

        $product = Product::find($id);

        $result = $product->update(['available' => $input['available'], 'deliverable' => $input['deliverable']]);

        if($result) {
            $product->options()->sync($input['options']);
        }
        
        $products = Product::with('options')->with('optionGroups')->with('category')->get();

        //sleep(3);
        return $this->sendResponse($products, "products api success");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
