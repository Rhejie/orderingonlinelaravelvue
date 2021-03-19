<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Combomeal;

class CombomealController extends Controller
{

    public function index()
    {
        $data = Combomeal::all();
        return response()->json($data, 200);
    }
}
