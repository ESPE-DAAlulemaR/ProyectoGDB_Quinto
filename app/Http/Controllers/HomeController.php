<?php

namespace App\Http\Controllers;

use App\Models\Zoo;
use Illuminate\Http\Request;

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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (config('app.zoo') != 'uio')
            session([
                'zooArr' => Zoo::where('code', config('app.zoo'))->first()->toArray()
            ]);

        $zoo = Zoo::where('code', config('app.zoo'))->first()->toArray();

        return view('welcome', compact('zoo'));
    }
}
