<?php

namespace App\Http\Controllers;

use App\Models\stocks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function add(Request $request)
    {
        $stock =  DB::table('stocks')
            ->where('id_warehouse', $request->id_warehouse)
            ->where('id_product', $request->id_product)
            ->first();
        if ($stock) {
            DB::table('stocks')
                ->where('id', $stock->id)
                ->update(['amount' => $stock->amount + $request->amount]);

            return response()->json([
                'status' => true,
                'message' => "Modificacion exitosa",
            ], 200);
        } else {
            // save inventario
            $stock = new stocks();
            $stock->id_warehouse = $request->id_warehouse;
            $stock->id_product = $request->id_product;
            $stock->amount = $request->amount;
            $stock->status = 1;
            $stock->created_by = 1;
            $stock->update_by = 1;
            $stock->save();

            return response()->json([
                'status' => true,
                'message' => "Insercion exitosa",
                'data' => $stock,
            ], 200);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(stocks $stocks)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(stocks $stocks)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, stocks $stocks)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(stocks $stocks)
    {
        //
    }
}
