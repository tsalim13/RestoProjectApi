<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Arr;

use App\ProductCart;

class ProductCartsAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userId = Auth::id();
        //$carts = $user->carts()->get();
        $carts = ProductCart::where('user_id', $userId)->with('product.options')->with('options.optionGroup')->get();
        //Sleep(8);
        return $this->sendResponse($carts, "carts api success");
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
        Log::debug(' ********************** PRODUCTORDER STORE ******************** ');
        $input = $request->all();

        Log::debug(Arr::except($input, 'options'));

        $cart = ProductCart::create(Arr::except($input, 'options'));
        Log::debug($input);
        if ($cart->id != null) {
            Log::debug($input['options']);
            $cart->options()->sync($input['options']);
            $userId = Auth::id();
            $carts = ProductCart::where('user_id', $userId)->with('product.options')->with('options.optionGroup')->get();
            Sleep(8);
            return $this->sendResponse($carts, "carts api success");
        }
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
    public function update(Request $request, $id)
    {
        //
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
