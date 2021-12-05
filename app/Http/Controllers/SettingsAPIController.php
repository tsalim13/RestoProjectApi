<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Setting;

class SettingsAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $settings = Setting::pluck('value', 'key');
        return $this->sendResponse($settings, "success");
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

    public function updateClosed(Request $request)
    {
        try {
            $input = $request->all();
            Setting::where('key', 'closed')->update($input);
        } catch (\Exception $e) {
            Log::error($e);
            return $this->sendError("setting api error");
        }
        //Sleep(5);
        $set = Setting::where('key', 'closed')->first();
        return $this->sendResponse($set, "setting api success");
    }

    public function updateEnableDelivery(Request $request)
    {
        try {
            $input = $request->all();
            Setting::where('key', 'enable_delivery')->update($input);
        } catch (\Exception $e) {
            Log::error($e);
            return $this->sendError("setting api error");
        }
        //Sleep(5);
        $set = Setting::where('key', 'enable_delivery')->first();
        return $this->sendResponse($set, "setting api success");
    }
}
