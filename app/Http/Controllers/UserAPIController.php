<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

use App\User;
use App\UserAppInfo;

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

        $input['password'] = bcrypt($input['password']);

        $user = User::create($input);

        $api_token = $user->createToken('PassportToken@App.com')->accessToken;

        $user->api_token = $api_token;

        return $this->sendResponse($user, "user api success");
    }

    public function loginUsers(Request $request)
    {
        try {
            $input = $request->all();
            $inputLogin = $request->only('phone', 'password');

            if (auth()->attempt($inputLogin)) {
                // auth()->user()->tokens->each(function($token, $key) {
                //     $token->delete();
                // });
                $api_token = auth()->user()->createToken('PassportToken@App.com')->accessToken;

                $user = auth()->user();
                $user->device_token = $input['deviceToken'];
                $user->save();
                auth()->user()->api_token = $api_token;

                return $this->sendResponse(auth()->user(), "user api success");
            }
            return $this->sendError("user api error");
        } catch(\Exception $e) {
            Log::error($e);
            return $this->sendError("user api error");
        }
    }

    public function loginStaf(Request $request)
    {
        $input = $request->all();
        $inputLogin = $request->only('email', 'password');

        if (auth()->attempt($inputLogin)) {
            // auth()->user()->tokens->each(function($token, $key) {
            //     $token->delete();
            // });
            $api_token = auth()->user()->createToken('PassportToken@App.com')->accessToken;

            $user = auth()->user();
            $user->device_token = $input['deviceToken'];
            $user->save();
            auth()->user()->api_token = $api_token;

            return $this->sendResponse(auth()->user(), "user api success");
        }
        return $this->sendError("user api error");
    }

    public function logout(Request $request) {
        $request->user()->token()->revoke();
        $request->user()->token()->delete(); 
    }


    public function userappinfo(Request $request)
    {
        try {
            $userId = Auth::id();
            $input = $request->all();
            UserAppInfo::updateOrCreate(['user_id' => $userId], ['version' => $input['version']]);

        } catch(\Exception $e) {
            Log::error($e);
        }
    }
    
    public function usersappinfos()
    {
        try {
            $infos = UserAppInfo::with('user')->get()->pluck('version', 'user.name');
            return $this->sendResponse($infos, "users info api success");

        } catch(\Exception $e) {
            Log::error($e);
            return $this->sendError("user api error");
        }
    }
}
