<?php

namespace App\Http\Controllers;

use App\Option;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OptionAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $options = Option::all();

        return $this->sendResponse($options, "options api success");
    }

    public function getOptionsWithGroup()
    {
        $options = Option::with('optionGroup')->get();
        //sleep(3);
        return $this->sendResponse($options, "options api success");
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

        //Log::debug(json_decode($input['option'], true));

        $option = Option::create(json_decode($input['option'], true));
        if ($request->hasFile('image')) {
            $option->addMediaFromRequest('image')->toMediaCollection('Options');
        }
        $option = Option::find($option->id);

        //sleep(4);

        return $this->sendResponse($option, "option api success");
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
        Option::whereId($id)->update($request->all());
        $option = Option::find($id);
        
        return $this->sendResponse($option, "option api success");
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
