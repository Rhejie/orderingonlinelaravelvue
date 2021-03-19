<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Beverage;

class BeverageController extends Controller
{
    public function index()
    {
        $data =  Beverage::all();
        return response()->json($data, 200);
    }
}
