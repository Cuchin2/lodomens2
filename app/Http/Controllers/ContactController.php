<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware([
            'permission:mypage.contact.index',
        ]);
    }
    public function index()
    {
        return view('admin.mypage.contact');
    }
}
