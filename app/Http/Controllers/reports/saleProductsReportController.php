<?php

namespace App\Http\Controllers\reports;

use App\Http\Controllers\Controller;
use App\Models\accounts;
use App\Models\categories;
use App\Models\products;
use App\Models\sale_details;

class saleProductsReportController extends Controller
{
    public function index()
    {
        $customers = accounts::Customer()->get();
        $categories = categories::all();
        return view('reports.saleProducts.index', compact('customers', 'categories'));
    }
    public function data($from, $to, $customerID, $categoryID)
    {
       $products = products::query();

       if($categoryID != "All")
       {
            $products->where('catID', $categoryID);
       }

       $products = $products->get();


       foreach($products as $product)
       {
            $query = sale_details::where('productID', $product->id)
                ->whereBetween('date', [$from, $to]);
            
            if ($customerID != 0) {
                $query->whereHas('sale', function($q) use ($customerID) {
                    $q->where('customerID', $customerID);
                });
            }
            
            $qty = $query->sum('qty');
            $bonus = $query->sum('bonus');
            $product->qty = $qty;
            $product->bonus = $bonus;
            $product->price = avgSalePrice($from,$to,$product->id);

       }
       if($customerID != 0)
       {
            $customer = accounts::find($customerID);
            $customer = $customer->title;
        }
        else
        {
            $customer = 'All';
        }

        return view('reports.saleProducts.details', compact('from', 'to', 'products', 'customer'));
    }
}
