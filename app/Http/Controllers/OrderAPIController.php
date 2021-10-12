<?php

namespace App\Http\Controllers;

use App\Order;
use App\ProductOrder;
use App\ProductCart;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;


class OrderAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userId = Auth::id();

        $orders = Order::where('user_id', $userId)->with(['driver', 'orderStatus', 'deliveryAddress', 'productOrders.product.category', 'productOrders.options.optionGroup'])->orderBy('created_at', 'ASC')->get();

        return $this->sendResponse($orders, "order api success");
    }

    public function newOrders()
    {
        $orders = Order::where('order_status_id', 1)->with(['user', 'driver', 'orderStatus', 'deliveryAddress', 'productOrders.product.category', 'productOrders.options.optionGroup'])->orderBy('created_at', 'ASC')->get();

        return $this->sendResponse($orders, "order api success");
    }

    public function oldOrders()
    {
        $orders = Order::where('order_status_id', '!=', 1)->where('order_status_id', '!=', 6)->where('order_status_id', '!=', 4)->
                        with(['user', 'driver', 'orderStatus', 'deliveryAddress', 'productOrders.product.category', 'productOrders.options.optionGroup'])
                        ->orderBy('created_at', 'ASC')->get();

        return $this->sendResponse($orders, "order api success");
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
        $order = null;
        try {
            // add db transaction
            DB::transaction(function() use ($request, &$order) {
                $input = $request->all();
                $inputOrder = $request->only('order_status_id', 'hint', 'paid', 'active');
                $userId = Auth::id();
                $inputOrder['user_id'] = $userId;
                $order = Order::create($inputOrder);
                //throw new \ErrorException('Error found');
                foreach ($input['products'] as $productOrder) {
                    $productOrder['order_id'] = $order->id;
                    $result = ProductOrder::create($productOrder);
                    $result->options()->sync($productOrder['options']);
                }

                // delete user carts

                // Log::debug("********** order store **********");
                // Log::debug($input);
                // Log::debug($inputOrder);
                $deletedRows = ProductCart::where('user_id', $userId)->delete();
            });
        } catch (\Exception $e) {
            return $this->sendError("order api error");
        }
        //Log::debug($order);
        return $this->sendResponse($order, "order api success");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::where('id', $id)->with(['productOrders.product.category', 'productOrders.options.optionGroup', 'orderStatus', 'driver', 'user'])->get();
        return $this->sendResponse($order, "order api success");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $order)
    {
        //
    }

    public function updateOrder(Request $request, $id)
    {
        $input = $request->all();
        $order = Order::where('id', $id)->update($input);
        //$inputOrder = $request->only('order_status_id', 'comment', 'delivery_fee', 'delivery_address_id', 'price');
        // Log::debug($input);
        // Log::debug($order);
        $updated = Order::where('id', $id)->with(['user', 'driver', 'orderStatus', 'deliveryAddress', 'productOrders.product.category', 'productOrders.options.optionGroup'])->first();
        Log::debug($updated);
        //Sleep(8);
        return $this->sendResponse($updated, "order api success");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
