<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Revenue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RevenueController extends Controller
{

    public function index()
    {
        $revenue = Revenue::all();

        return response()->json([
            'status' => 200,
            'revenues' => $revenue,
        ], 200);
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'description' => 'required|max:500',
            'revenue' => 'required',
            'dateIni' => 'required',
        ]);


        if ($validator->fails()) {

            return response()->json([
                'status' => 422,
                'errors' => $validator->messages(),
            ], 422);
        } else {

            $revenue = Revenue::create([
                'description' => $request->description,
                'revenue' => $request->revenue,
                'dateIni' => $request->dateIni,
            ]);

            if ($revenue) {

                return response()->json([
                    'status' => 200,
                    'message' => 'Revenue Added Successfully',
                ], 200);
            } else {

                return response()->json([
                    'status' => 500,
                    'message' => 'Something Went Wrong',
                ], 500);
            }
        }
    }


}
