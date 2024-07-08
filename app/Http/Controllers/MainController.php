<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use App\Models\Banner;
use App\Models\Setting;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        $sliders=Slider::where('state','public')->orderBy('order','asc')->get();
        $banners=Banner::orderBy('order','asc')->get();
        $settings=Setting::all();
        $time = $settings->first(function ($setting) {
            return $setting->name === 'time';
        });
        $time = $time->action ?? '8000';
        $about = $settings->first(function ($setting) {
            return $setting->action === 'about';
        });
        if(!isset($about)){
            $about=Setting::create([
                'name'=> 'título aquí',
                'description'=> 'descripción aquí',
                'action'=> 'about'
                ]);
        }
        return view('web.index',compact('sliders','banners','time','about'));
    }
}
