<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(['status' => false, 'message' => 'not found :'], 404);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($nika)
    {
        $user = User::find($nika);
        if ($user) {
            return response()->json([
                'status' => true,
                'message' => 'User found',
                'user' => $user
            ], 200);
        }
        return response()->json([
            'status' => false,
            'message' => 'User not found',
        ], 404);
    }
}
