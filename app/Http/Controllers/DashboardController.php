<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\Sku;
use Illuminate\Support\Facades\DB;
class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $settings=Setting::all();
        return view('dashboard',compact('settings'));
    }
    public function usd(Request $request,$id)
    {
        $setting=Setting::find($id);
        $setting->action=$request->usd;
        $setting->save();
        $multiplier = $request->usd;

        DB::transaction(function () use ($multiplier) {
            Sku::query()->update(['usd' => DB::raw("sell_price / $multiplier")]);
        });
        return response()->json(['message' => 'Dolar actualizado']);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
