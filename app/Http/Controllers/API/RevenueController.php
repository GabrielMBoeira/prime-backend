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

    public function edit($id)
    {
        $revenue = Revenue::find($id);

        if ($revenue) {

            return response()->json([
                'status' => 200,
                'revenue' => $revenue,
            ], 200);
        } else {

            return response()->json([
                'status' => 404,
                'message' => 'No Revenue ID Found',
            ], 404);
        }
    }

    public function update(Request $request, $id)
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

            $revenue = Revenue::find($id);

            if ($revenue) {

                $revenue->description = $request->input('description');
                $revenue->revenue = $request->input('revenue');
                $revenue->dateIni = $request->input('dateIni');
                $revenue->update();

                return response()->json([
                    'status' => 200,
                    'message' => 'Revenue Updated Successfully',
                ]);
            } else {

                return response()->json([
                    'status' => 404,
                    'message' => 'No Revenue ID Found',
                ]);
            }
        }
    }

    public function destroy($id)
    {
        $revenue = Revenue::find($id);

        if ($revenue) {

            $revenue->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Revenue Deleted Successfully',
            ]);
        } else {

            return response()->json([
                'status' => 404,
                'message' => 'No Revenue ID Found',
            ]);
        }
    }
}
