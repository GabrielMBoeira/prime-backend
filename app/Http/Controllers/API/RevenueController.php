<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Revenue;

class RevenueController extends Controller
{

    public function index()
    {
        $revenue = Revenue::all();

        return response()->json([
            'status' => 200,
            'revenues' => $revenue,
        ]);
    }

}
