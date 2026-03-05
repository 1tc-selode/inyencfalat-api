<?php

namespace App\Http\Controllers;

use App\Models\Ingreditent;
use Illuminate\Http\Request;

class IngreditentController extends Controller
{
    public function index()
    {
        return response()->json(Ingreditent::all(),200);
    }
}
