<?php

namespace App\Http\Controllers;

use App\Models\SaleOrder;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware([
            'permission:sales.index',
            'permission:sales.show'
        ]);

    }
    public function index (){
        return view('admin.sale.index');
    }
    public function show($id){
        $order=SaleOrder::with(['saleDetails','shipping','deliveryOrders'])->find($id);
        return view('admin.sale.show',compact('order'));
    }
}
