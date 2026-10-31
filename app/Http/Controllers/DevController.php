<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DevController extends Controller
{

    public function authenticatedTestRequest(Request $request)
    {
        return response()->json(['success' => true, 'message' => "This is an authenticated test request."]);
    }

    public function unauthenticatedTestRequest(Request $request)
    {
        return response()->json(['success' => true, 'message' => "This is an unauthenticated test request."]);
    }

}
