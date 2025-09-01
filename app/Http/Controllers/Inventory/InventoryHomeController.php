<?php

namespace App\Http\Controllers\Inventory;

use Illuminate\Http\Request;

class InventoryHomeController extends Controller
{
   
    public function index()
    {
        $data['total_products'] = \App\Models\Inventory\StockDetail::count();
        $data['sales_transactions'] = \App\Models\Inventory\SalesDetail::count();
        $data['suppliers'] = \App\Models\Inventory\SupplierDetail::count();
        $data['customers'] = \App\Models\Inventory\CustomerDetail::count();

        return view('inventory.home')->with('data',$data);
    }
}
