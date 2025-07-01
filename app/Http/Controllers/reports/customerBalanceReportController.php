<?php

namespace App\Http\Controllers\reports;

use App\Http\Controllers\Controller;
use App\Models\accounts;
use App\Models\areas;
use App\Models\products;
use App\Models\sale_details;
use Illuminate\Http\Request;

class customerBalanceReportController extends Controller
{
  public function index()
  {
    $areas = areas::all();
    return view('reports.customerBalances.index', compact('areas'));
  }
    public function data($area)
    {
      
        $accounts = accounts::Customer();

        if($area != "All")
        {
          $accounts = $accounts->where('areaID', $area);
        }

        $accounts = $accounts->get();

        foreach($accounts as $account)
        {
          $account->balance = getAccountBalance($account->id);
        }

        return view('reports.customerBalances.details', compact('accounts'));
    }


}
