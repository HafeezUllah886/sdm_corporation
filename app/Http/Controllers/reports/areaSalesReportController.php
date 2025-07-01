<?php

namespace App\Http\Controllers\reports;

use App\Http\Controllers\Controller;
use App\Models\areas;
use App\Models\products;
use App\Models\sale_details;
use Illuminate\Http\Request;

class areaSalesReportController extends Controller
{
    public function index()
    {
        $areas = areas::all();
        return view('reports.areaSale.index', compact('areas'));
    }
    public function data(Request $request)
    {

        
        $area = $request->areaID;
        $from = $request->from;
        $to = $request->to;
       $products = products::all();

       foreach($products as $product)
       {
            $qty = sale_details::where('productID', $product->id)->where('areaID', $area)->whereBetween('date', [$from, $to])->sum('qty');
            $bonus = sale_details::where('productID', $product->id)->where('areaID', $area)->whereBetween('date', [$from, $to])->sum('bonus');
            $amount = sale_details::where('productID', $product->id)->where('areaID', $area)->whereBetween('date', [$from, $to])->sum('ti');
            $product->qty = $qty;
            $product->bonus = $bonus;
            $product->amount = $amount;

       }

       $area = areas::find($area);
        return view('reports.areaSale.details', compact('area','from', 'to', 'products'));
    }
}
