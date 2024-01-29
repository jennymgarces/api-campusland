<?php

namespace App\Http\Controllers;

use App\Models\products;
use App\Models\stocks;
use App\Models\warehouses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
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

        // save product
        $product = new products();
        $product->name = $request->name_product;
        $product->description = $request->description_product;
        $product->status = "1";
        $product->created_by = $request->created_by;
        $product->update_by = $request->created_by;
        $product->save();
        // save warehouse/bodega por defecto
        $defaultWarehouse =  DB::table('warehouses')->where('name', 'default')->first();
        if ($defaultWarehouse) {
            $id_warehouse = $defaultWarehouse->id;
        } else {
            $warehouse = new warehouses();
            $warehouse->name = "default";
            $warehouse->id_responsible = $request->created_by;
            $warehouse->status = "1";
            $warehouse->created_by = $request->created_by;
            $warehouse->update_by = $request->created_by;
            if ($warehouse->save()) {
                $id_warehouse = $warehouse->id;
            }
        }
        // save inventario
        $stock = new stocks();
        $stock->id_warehouse = $id_warehouse;
        $stock->id_product = $product->id;
        $stock->amount = $request->amount;
        $stock->status = "1";
        $stock->created_by = $request->created_by;
        $stock->update_by = $request->created_by;
        $stock->save();

        return response()->json([
            'status' => true,
            'message' => "producto creado exitosamente!",
            'product' => $product,
            'stock' => $stock,
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(products $products)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(products $products)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, products $products)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(products $products)
    {
        //
    }
}
