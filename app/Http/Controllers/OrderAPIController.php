<?php

namespace App\Http\Controllers;

use App\Order;
use App\ProductOrder;
use App\ProductCart;
use App\Role;
use App\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Carbon;
use App\Notifications\OrderStatusNotification;
use App\Notifications\NewOrderNotification;


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

        $orders = Order::where('user_id', $userId)->whereMonth('created_at', date('m'))
            ->with(['driver', 'orderStatus', 'deliveryAddress', 'productOrders.product.category', 'productOrders.options.optionGroup'])
            ->orderBy('created_at', 'ASC')->get();

        return $this->sendResponse($orders, "order api success");
    }

    public function newOrders()
    {
        $orders = Order::where('order_status_id', 1)->where('active', '!=', 0)
            ->with(['user', 'driver', 'orderStatus', 'deliveryAddress', 'productOrders.product.category', 'productOrders.options.optionGroup'])
            ->orderBy('created_at', 'ASC')->get();

        return $this->sendResponse($orders, "order api success");
    }

    public function oldOrders()
    {
        $orders = Order::where('order_status_id', '!=', 1)->where('order_status_id', '!=', 6)->where('order_status_id', '!=', 4)->where('active', '!=', 0)
            ->with(['user', 'driver', 'orderStatus', 'deliveryAddress', 'productOrders.product.category', 'productOrders.options.optionGroup'])
            ->orderBy('created_at', 'ASC')->get();

        return $this->sendResponse($orders, "order api success");
    }

    public function historiqueOrders()
    {
        try {
            $orders = Order::where('order_status_id', '=', 6)->orWhere('order_status_id', '=', 4)->orWhere('active', '=', 0)
                ->with(['user', 'driver', 'orderStatus', 'deliveryAddress', 'productOrders.product.category', 'productOrders.options.optionGroup'])
                ->orderBy('created_at', 'DESC')->limit(50)->get();

            return $this->sendResponse($orders, "order api success");
        } catch (\Exception $e) {
            Log::error($e);
            return $this->sendError("order api error");
        }
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
            DB::transaction(function () use ($request, &$order) {
                $input = $request->all();
                $inputOrder = $request->only('price', 'comment', 'delivery_fee', 'order_status_id', 'hint', 'paid', 'active', 'delivery_address_id', 'method');
                $userId = Auth::id();
                $lastId = Order::select('custom_id')->whereDate('created_at', Carbon::today())->latest()->get();

                if ($lastId->first() != null) {
                    $lastId = $lastId->first()->custom_id != null ? $lastId->first()->custom_id : 0;
                } else {
                    $lastId = 0;
                }
                $inputOrder['user_id'] = $userId;
                $inputOrder['custom_id'] = $lastId + 1;
                $order = Order::create($inputOrder);
                //throw new \ErrorException('Error found');
                foreach ($input['products'] as $productOrder) {
                    $productOrder['order_id'] = $order->id;
                    $result = ProductOrder::create($productOrder);
                    $result->options()->sync($productOrder['options']);
                }

                $order = Order::where('id', $order->id)->with(['driver', 'orderStatus', 'deliveryAddress', 'productOrders.product.category', 'productOrders.product.optionGroups', 'productOrders.options.optionGroup'])->first();

                $deletedRows = ProductCart::where('user_id', $userId)->delete();
            });
        } catch (\Exception $e) {
            Log::error($e);
            return $this->sendError("order api error");
        }
        //Sleep(5);

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
        $order = Order::where('id', $id)->with(['driver', 'orderStatus', 'deliveryAddress', 'productOrders.product.category', 'productOrders.options.optionGroup'])->get();
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

        $updated = Order::where('id', $id)->with(['user', 'driver', 'orderStatus', 'deliveryAddress', 'productOrders.product.category', 'productOrders.options.optionGroup'])->first();

        // TODO check old status and send notificaion only if old status is diffrent from new status
        Notification::send([$updated->user], new OrderStatusNotification($updated));

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
