<?php

namespace App\Http\Controllers\reports;

use App\Http\Controllers\Controller;
use App\Models\accounts;
use App\Models\sales;
use App\Models\User;
use Illuminate\Http\Request;

class salesReportController extends Controller
{
    public function index()
    {
        $orderbookers = User::where('role', 'Orderbooker')->get();
        return view('reports.sales.index', compact('orderbookers'));
    }

    public function data($from, $to, $type, $orderbooker)
    {

        $sales = sales::with('customer', 'details')->whereBetween('date', [$from, $to]);
        if($type != "All")
        {
            $customers = accounts::where('type', 'Customer')->where('c_type', $type)->pluck('id')->toArray();
            $sales->whereIn('customerID', $customers);
        }
        if($orderbooker != "All")
        {
            $sales->where('orderbookerID', $orderbooker);
        }
        $sales = $sales->get();
        
        foreach($sales as $sale)
        {
            $pdiscount = 0;
            foreach($sale->details as $detail)
            {
                $pdiscount += $detail->discount * $detail->qty;
            }
            $sale->pdiscount = $pdiscount;
        }


        return view('reports.sales.details', compact('from', 'to', 'sales'));
    }
}
