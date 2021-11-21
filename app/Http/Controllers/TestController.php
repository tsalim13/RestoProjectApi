<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;

use Illuminate\Http\Request;


use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Carbon;
use App\Notifications\OrderStatusNotification;
use App\Notifications\NewOrderNotification;


use App\Product;
use App\ProductCart;
use App\OptionGroup;
use App\User;
use App\Order;
use App\Role;
use App\ProductOption;
use App\ProductOptionGroup;

class TestController extends Controller
{
    public function reorder() 
    {
        try {
        $products = ProductOption::all();
        
        foreach($products as $prod) {
            $optorder = 0;
            $optgorder = 0;
            $prodOpts = ProductOption::where('product_id', '=', $prod->id)->get();
            foreach($prodOpts as $opt) {
                $opt->order = $optorder;
                $opt->save();
                $optorder++;
            }
            $prodOptsGroups = ProductOptionGroup::where('product_id', '=', $prod->id)->get();
            foreach($prodOptsGroups as $optg) {
                $optg->order = $optgorder;
                $optg->save();
                $optgorder++;
            }
        }
    } catch (\Exception $e) {
        Log::error($e);
        return $this->sendError("order api error");
    }

    }

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


        // $orders = Order::where('id', 26)->with(['user', 'driver', 'orderStatus', 'deliveryAddress', 'productOrders.product.category', 'productOrders.options.optionGroup'])->first();

        // $users = Role::where('label','admin')->first()->users()->get();
        // Log::debug($users);

        $id = Order::select('custom_id')->whereDate('created_at', Carbon::today())->latest()->get();

        return $this->sendResponse($id, "order api success");
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
