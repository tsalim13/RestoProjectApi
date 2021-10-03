<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;

use Illuminate\Http\Request;
use App\Product;
use App\ProductCart;
use App\OptionGroup;
use App\User;
use App\Order;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Log::debug(" **************** TEST ****************");

        //$product = Product::with('options')->where('id', 1)->get();

        //$carts = ProductCart::where('user_id', 1)->with('product')->with(['options.optionAttribute', 'options.option.optionGroup'])->get();

        // $user = User::find(1);
        // Log::debug($user);
        // $order = $user->orders()->with('')->get();

        //Log::debug($order);


        $order = Order::where('user_id', 1)->with(['driver', 'orderStatus', 'deliveryAddress', 'productOrders.product', 'productOrders.options'])->get();

        return $this->sendResponse($order, "order api success");
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
        //
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
