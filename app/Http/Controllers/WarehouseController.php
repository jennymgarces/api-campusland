<?php

namespace App\Http\Controllers;

use App\Models\history;
use App\Models\warehouses;
use App\Models\products;
use App\Models\stocks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;

class WarehouseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __invoke(Request $request)
    {
        //
        $warehouses = warehouses::orderBy('name')->get();
        return response()->json([
            'status' => true,
            'data' => $warehouses
        ]);
    }
    public function get()
    {
        //
        $warehouses = warehouses::all();
        return response()->json([
            'status' => true,
            'data' => $warehouses
        ]);
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
        $warehouses = warehouses::create($request->all());

        return response()->json([
            'status' => true,
            'message' => "Bodega creada exitosamente!",
            'Bodega' => $warehouses
        ], 200);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function addDefault(Request $request)
    {
        $warehouses = warehouses::create($request->all());
    }
    /**
     * Store a newly created resource in storage.
     */
    public function getProductByTotal(Request $request)
    {
        $stocks = DB::table('stocks as s')
            ->select('s.id_product', 'p.name', 'p.description', DB::raw('SUM(s.amount) as total_stock'))
            ->join('products as p', 's.id_product', '=', 'p.id')
            ->groupBy('s.id_product', 'p.name', 'p.description')
            ->orderBy('total_stock', 'desc')
            ->get();

        return $stocks;
        return response()->json([
            'status' => true,
            'data' => $stocks
        ], 200);
    }

    /**
     * move warehouse.
     */
    public function move(Request $request)
    {
        $stock =  DB::table('stocks')
            ->where('id_warehouse', $request->id_warehouse_origin)
            ->where('id_product', $request->id_product)
            ->first();
        if ($stock->amount >= $request->amount) {
            DB::table('stocks')
                ->where('id', $stock->id)
                ->update([
                    'id_warehouse' => $request->id_warehouse_origin,
                    'amount'       => $stock->amount - $request->amount
                ]);
            // save inventario
            $newStock = new stocks();
            $newStock->id_warehouse = $request->id_warehouse_destination;
            $newStock->id_product = $request->id_product;
            $newStock->amount = $request->amount + $stock->amount;
            $newStock->status = 1;
            $newStock->created_by = 1;
            $newStock->update_by = 1;
            $newStock->save();

            // save inventario
            $history = new history();
            $history->amount = $request->amount;
            $history->id_warehouse_origin = $request->id_warehouse_origin;
            $history->id_warehouse_destination = $request->id_warehouse_destination;
            $history->id_stock = $newStock->id;
            $history->created_by = 1;
            $history->update_by = 1;
            $history->save();

            return response()->json([
                'status' => true,
                'message' => "Insercion exitosa",
                'stock' => $stock,
                'newStock' => $newStock,
                'history' => $history,
            ], 200);

        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(warehouses $warehouses)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, warehouses $warehouses)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(warehouses $warehouses)
    {
        //
    }
}
