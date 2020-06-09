<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    /**
     * Retrieve admin details
     *
     * @return \Illuminate\Http\Response
     */
    public function admin()
    {
        return response()->json([
            'message' => 'Successfully retrieve resource',
            'user' => auth('api')->check()
            //auth('api')->user()
            //auth('api')->check()
        ], 200);
    }
}
