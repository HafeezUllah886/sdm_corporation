<?php

namespace App\Http\Controllers\reports;

use App\Http\Controllers\Controller;
use App\Models\accounts;
use App\Models\categories;
use App\Models\products;
use App\Models\purchase;
use App\Models\purchase_details;
use Illuminate\Http\Request;

class purchaseProductsReportController extends Controller
{
    public function index()
    {
        $categories = categories::all();
        $vendors = accounts::where('type', 'Vendor')->get();
        return view('reports.purchaseProducts.index', compact('categories', 'vendors'));
    }

    public function data($from, $to, $catID, $vendor)
    {
        if($catID == 'All')
        {
            $products = products::all();
        }
        else
        {
            $products = products::where('catID', $catID)->get();
        }

        $purchases = purchase::whereBetween('date', [$from, $to]);
        if($vendor != 'All')
        {
            $purchases->where('vendorID', $vendor);
        }
        $purchases = $purchases->pluck('id');

       foreach($products as $product)
       {
           $purchase_details = purchase_details::whereIn('purchaseID', $purchases)->where('productID', $product->id)->get();
            $qty = $purchase_details->sum('qty');
            $bonus = $purchase_details->sum('bonus');
            $product->qty = $qty;
            $product->bonus = $bonus;
            $product->price = avgPurchasePrice($from,$to,$product->id);
       }

        return view('reports.purchaseProducts.details', compact('from', 'to', 'products'));
    }
}
