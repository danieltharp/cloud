<?php

namespace App\Http\Controllers;

use App\Item;
use App\Location;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $locations = Location::with('sublocations')->get();
        $items = Item::all();
        return view('home',compact('locations','items'));
    }
}
