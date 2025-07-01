<?php

namespace App\Http\Controllers\reports;

use App\Http\Controllers\Controller;
use App\Models\expenseCategories;
use App\Models\expenses;
use Illuminate\Http\Request;

class expenseReportController extends Controller
{
    public function index()
    {
        $categories = expenseCategories::all();
        return view('reports.expense_report.index', compact('categories'));
    }

    public function data(Request $request)
    {
        $from = $request->from;
        $to = $request->to;
        $category = $request->category;

        $expenses = expenses::whereBetween('date', [$from, $to]);
        if ($category != 'All') {
            $expenses->where('cat', $category);
        }
        $expenses = $expenses->get();

        return view('reports.expense_report.details', compact('expenses', 'from', 'to', 'category'));
    }
}
