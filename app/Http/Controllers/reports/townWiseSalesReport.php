<?php

namespace App\Http\Controllers\reports;

use App\Http\Controllers\Controller;
use App\Models\areas;
use App\Models\products;
use App\Models\sale_details;
use App\Models\town;
use Illuminate\Http\Request;

class townWiseSalesReport extends Controller
{
    public function index()
    {
        $towns = town::all();
        return view('reports.townSale.index', compact('towns'));
    }

    public function data(Request $request)
    {        
        $town = $request->townID;
        $from = $request->from;
        $to = $request->to;

        $areas = areas::where('townID', $town)->pluck('id')->toArray();
       $products = products::all();

       foreach($products as $product)
       {
            $qty = sale_details::where('productID', $product->id)->whereIn('areaID', $areas)->whereBetween('date', [$from, $to])->sum('qty');
            $bonus = sale_details::where('productID', $product->id)->whereIn('areaID', $areas)->whereBetween('date', [$from, $to])->sum('bonus');
            $amount = sale_details::where('productID', $product->id)->whereIn('areaID', $areas)->whereBetween('date', [$from, $to])->sum('ti');
            $product->qty = $qty;
            $product->bonus = $bonus;
            $product->amount = $amount;

       }

       $town = town::find($town);
        return view('reports.townSale.details', compact('town','from', 'to', 'products'));
    }
}
