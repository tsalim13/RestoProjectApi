<?php

namespace App\Http\Controllers;

use App\OrderType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OrderTypeAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orderTypeStatus = OrderType::with('orderStatus')->get();
        //Sleep(8);
        return $this->sendResponse($orderTypeStatus, "order api success");
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
     * @param  \App\OrderType  $orderType
     * @return \Illuminate\Http\Response
     */
    public function show(OrderType $orderType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\OrderType  $orderType
     * @return \Illuminate\Http\Response
     */
    public function edit(OrderType $orderType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\OrderType  $orderType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OrderType $orderType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\OrderType  $orderType
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrderType $orderType)
    {
        //
    }
}
