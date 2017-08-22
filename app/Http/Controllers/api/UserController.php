<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    private $user;

    public function __construct()
    {
        $this->user = new User;
    }

    public function login(Request $request)
    {
        $payLoad = $this->getPayload($request);
        $cek = $this->user->login($payLoad);
        if(!$cek)
        {
            return response()->json("fail",500);
        }
        else
        {
            return response()->json($cek,200);
        }
    }
}
