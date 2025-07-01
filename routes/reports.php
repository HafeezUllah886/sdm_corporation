<?php

use App\Http\Controllers\reports\profitController;
use App\Http\Controllers\reports;
use App\Http\Controllers\reports\areaSalesReportController;
use App\Http\Controllers\reports\balanceSheetReport;
use App\Http\Controllers\reports\comparisonReportController;
use App\Http\Controllers\reports\customerBalanceReportController;
use App\Http\Controllers\reports\dailycashbookController;
use App\Http\Controllers\reports\expenseReportController;
use App\Http\Controllers\reports\loadsheetController;
use App\Http\Controllers\reports\productSummaryReport;
use App\Http\Controllers\reports\purchaseGstReportController;
use App\Http\Controllers\reports\purchaseProductsReportController;
use App\Http\Controllers\reports\purchaseReportController;
use App\Http\Controllers\reports\saleProductsReportController;
use App\Http\Controllers\reports\salesGstReportController;
use App\Http\Controllers\reports\salesManReportController;
use App\Http\Controllers\reports\salesReportController;
use App\Http\Middleware\adminCheck;
use Illuminate\Support\Facades\Route;

Route::middleware('auth', adminCheck::class)->group(function () {

    Route::get('/reports/profit', [profitController::class, 'index'])->name('reportProfit');
    Route::get('/reports/profitData/{from}/{to}', [profitController::class, 'data'])->name('reportProfitData');

    Route::get('/reports/loadsheet', [loadsheetController::class, 'index'])->name('reportLoadsheet');
    Route::get('/reports/loadsheet/{id}/{date}', [loadsheetController::class, 'data'])->name('reportLoadsheetData');

    Route::get('/reports/salesGst', [salesGstReportController::class, 'index'])->name('reportSalesGst');
    Route::get('/reports/salesGstData/{from}/{to}', [salesGstReportController::class, 'data'])->name('reportSalesGstData');

    Route::get('/reports/purchasesGst', [purchaseGstReportController::class, 'index'])->name('reportPurchasesGst');
    Route::get('/reports/purchasesGstData/{from}/{to}', [purchaseGstReportController::class, 'data'])->name('reportPurchasesGstData');

    Route::get('/reports/purchaseProducts', [purchaseProductsReportController::class, 'index'])->name('reportPurchaseProducts');
    Route::get('/reports/purchaseProductsData/{from}/{to}/{catID}/{vendor}', [purchaseProductsReportController::class, 'data'])->name('reportPurchaseProductsData');

    Route::get('/reports/saleProducts', [saleProductsReportController::class, 'index'])->name('reportSaleProducts');
    Route::get('/reports/saleProductsData/{from}/{to}/{customer}/{category}', [saleProductsReportController::class, 'data'])->name('reportSaleProductsData');

    Route::get('/reports/areasales', [areaSalesReportController::class, 'index'])->name('reportAreaSales');
    Route::get('/reports/areasalesdata', [areaSalesReportController::class, 'data'])->name('reportAreaSalesData');

    Route::get('/reports/productSummary', [productSummaryReport::class, 'index'])->name('reportProductSummary');

    Route::get('/reports/customersBalance', [customerBalanceReportController::class, 'index'])->name('reportCustomersBalance');
    Route::get('/reports/customersBalanceData/{area}', [customerBalanceReportController::class, 'data'])->name('reportCustomersBalanceData');

    Route::get('/reports/sales', [salesReportController::class, 'index'])->name('reportSales');
    Route::get('/reports/salesData/{from}/{to}/{type}/{orderbooker}', [salesReportController::class, 'data'])->name('reportSalesData');

    Route::get('/reports/purchases', [purchaseReportController::class, 'index'])->name('reportPurchases');
    Route::get('/reports/purchasesData/{from}/{to}', [purchaseReportController::class, 'data'])->name('reportPurchasesData');

    Route::get('/reports/dailycashbook', [dailycashbookController::class, 'index'])->name('reportCashbook');
    Route::get('/reports/dailycashbook/{date}', [dailycashbookController::class, 'details'])->name('reportCashbookData');

    Route::get('/reports/balanceSheet', [balanceSheetReport::class, 'index'])->name('reportBalanceSheet');
    Route::get('/reports/balanceSheet/{type}/{from}/{to}', [balanceSheetReport::class, 'data'])->name('reportBalanceSheetData');

    Route::get('/reports/comparison', [comparisonReportController::class, 'index'])->name('reportComparison');
    Route::get('/reports/comparison/{from1}/{to1}/{from2}/{to2}/{customer}', [comparisonReportController::class, 'data'])->name('reportComparisonData');

    Route::get('/reports/expense', [expenseReportController::class, 'index'])->name('reportExpense');
    Route::get('/reports/expenseData/{from}/{to}/{category}', [expenseReportController::class, 'data'])->name('reportExpenseData');
});
