<?php

namespace App\Http\Controllers;

use App\Fortunes;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\View\View;

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
     * @param Request $request
     * @return Factory|Application|View
     */
    public function index(Request $request)
    {
        $date = $request->get('date') ? : date('Y-m-d');
        return view('home', [
            'selectedDate' => $date,
            'availableDates' => Fortunes::select('date')->groupBy('date')->pluck('date'),
            'fortunes' => Fortunes::where('date', $date)->get()]
        );
    }
}
