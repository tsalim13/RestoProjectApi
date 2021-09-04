<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use App\User;

class UserAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

    public function register(Request $request)
    {
        $input = $request->all();

        Log::debug("register");
        Log::debug($input);

        $input['password'] = bcrypt($input['password']);

        $user = User::create($input);

        $api_token = $user->createToken('PassportToken@App.com')->accessToken;

        $user->api_token = $api_token;
        Log::debug($user);

        return $this->sendResponse($user, "user api success");
    }

    public function login(Request $request)
    {
        $input = $request->all();

        Log::debug("login");
        Log::debug($input);
        if (auth()->attempt($input)) {
            $api_token = auth()->user()->createToken('PassportToken@App.com')->accessToken;

            auth()->user()->api_token = $api_token;
            Log::debug("loged user");
            Log::debug(auth()->user());

            return $this->sendResponse(auth()->user(), "user api success");
        }
        return $this->sendError("user api error");
    }

    public function logout(Request $request) {
        Log::debug("logout");
        Log::debug($request->user());
        $request->user()->token()->revoke();
        $request->user()->token()->delete(); 
    }
}
