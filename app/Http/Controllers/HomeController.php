<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $packages = DB::table('packages')->orderBy('price')->get();

        $classes = DB::table('yoga_classes')
            ->whereDate('class_date', '>=', now()->toDateString())
            ->orderBy('class_date')
            ->orderBy('start_time')
            ->get();

        return view('home', compact('packages', 'classes'));
    }
}
