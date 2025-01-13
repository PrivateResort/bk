<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Retrieve all users.
     */

     public function index(){
        return response()->json([
            'ok' => true,
            'message' => 'Retrieved Successfully',
            'data' => User::all()
        ], 200);
     }
}
