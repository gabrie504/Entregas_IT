<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HistorialController extends Controller
{

    public function index(Request $request)
    {
        return view('historial/verHistorial');
    }
}
