<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware([
            'permission:inventory.brands.index',
        ]);
    }
    public function index()
    {
        return view('admin.brand.index');
    }
}
