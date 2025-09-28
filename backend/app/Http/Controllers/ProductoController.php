<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductoController extends Controller
{
    public function index()
    {
        $db = DB::connection()->getDatabaseName();
        return response()->json([
            'message' => 'Listado de productos',
            'current_database' => $db,
        ]);
    }
}
