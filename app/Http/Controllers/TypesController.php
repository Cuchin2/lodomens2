<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TypesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware([
            'permission:inventory.types.index',
        ]);
    }
    public function index ()
    {
        return view('admin.type.index');
    }
}
