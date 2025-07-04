<?php

namespace App\Http\Controllers;

use App\Models\products;
use App\Models\stock;
use App\Models\units;
use App\Models\warehouses;
use Illuminate\Http\Request;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = products::all();
        $units = units::all();
        $warehouses = warehouses::all();
        return view('stock.index', compact('products', 'units', 'warehouses'));
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id, $unitID, $warehouse, $from, $to)
    {
        $product = products::find($id);

        if($warehouse == "all")
        {
            $stocks = stock::where('productID', $id)->whereBetween('date', [$from, $to])->get();

        $pre_cr = stock::where('productID', $id)->whereDate('date', '<', $from)->sum('cr');
        $pre_db = stock::where('productID', $id)->whereDate('date', '<', $from)->sum('db');
        $pre_balance = $pre_cr - $pre_db;

        $cur_cr = stock::where('productID', $id)->sum('cr');
        $cur_db = stock::where('productID', $id)->sum('db');

        $cur_balance = $cur_cr - $cur_db;
        }
        else
        {
            $stocks = stock::where('productID', $id)->where('warehouseID', $warehouse)->whereBetween('date', [$from, $to])->get();
            $pre_cr = stock::where('productID', $id)->where('warehouseID', $warehouse)->whereDate('date', '<', $from)->sum('cr');
            $pre_db = stock::where('productID', $id)->where('warehouseID', $warehouse)->whereDate('date', '<', $from)->sum('db');
            $pre_balance = $pre_cr - $pre_db;

            $cur_cr = stock::where('productID', $id)->where('warehouseID', $warehouse)->sum('cr');
            $cur_db = stock::where('productID', $id)->where('warehouseID', $warehouse)->sum('db');

            $cur_balance = $cur_cr - $cur_db;
        }

        $unit = units::find($unitID);
        return view('stock.details', compact('product', 'pre_balance', 'cur_balance', 'stocks', 'unit', 'from', 'to'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(stock $stock)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, stock $stock)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(stock $stock)
    {
        //
    }
}
