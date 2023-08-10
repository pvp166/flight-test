<?php

namespace App\Http\Controllers;

use App\Common\RequestCheck;
use App\Http\Requests\AuthFormRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
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
    public function create(Request $request): Response
    {
        $this->validate($request, [
            'userName' => 'string|unique:users,user_name',
            'password' => 'string',
        ]);
        try {
            $acc = User::create([
                'user_name' => RequestCheck::cleanString($request->input('userName')),
                'password' => Hash::make(RequestCheck::cleanString($request->input('password'))),
            ]);

            if ($acc->id > 0) {
                response()->json([
                    'account' => [
                        'username' => $acc->user_name
                    ],
                    'message' => 'Account created successfully'
                ], 200)->send();
                die;
            } else {
                response()->json(['error' => 'has Error when creating account'], 422)->send();
                die;

            }
        } catch (Exception $ex) {
            dd($ex);
            response()->json(['error' => 'has Error when creating account'], 422)->send();
            die;
        }

    }

    public function login(Request $request): Response
    {
        
        $this->validate($request, [
            'userName' => 'required|string',
            'password' => 'required|string'
        ]);
        try {
            $account = User::where('user_name', $request->input('userName'))->first();
            if ($account) {
                // Verify the password and generate the token
                if (Hash::check($request->input('password'), $account->password)) {
                    unset($account->password_raw);

                    response()->json(
                        [
                            'token' => jwtAccountEncode([
                                'id' => $account->id,
                                'userName' => $account->user_name,
                            ]),
                            'apiUrl' => env('APP_URL'),
                            'message' => 'login_success'
                        ],
                        200
                    )->send();
                    die;
                } else {
                    response()->json(['error' => 'Login Failed'], 401)->send();
                    die;
                }
            } else {
                
                response()->json(['error' => 'Login Failed'], 401)->send();
                die;
            }
        } catch (Exception $ex) {
            
            
            response()->json(['error' => 'Login Failed'], 401)->send();
            die;
        }
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