<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Burger;

class BurgerController extends Controller
{
    public function index()
    {
        $data = Burger::all();
        return response()->json($data, 200);
    }
}
