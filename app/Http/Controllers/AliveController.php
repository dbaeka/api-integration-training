<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AliveController extends Controller
{
    //
    public function showAlive(Request $request)
    {
        return response()->json([
            'message' => 'I am ALIVE baby!'
        ]);
    }
}
