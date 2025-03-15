<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ExcelRow;

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
        $files = ExcelRow::all(); // Récupération des données depuis la base

        return view('home', compact('files')); // Envoi des données à la vue
    }
}

