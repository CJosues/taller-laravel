<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductoController extends Controller
{
    // Listar todos los productos
    public function index()
    {
        $productos = DB::table('productos')->get();
        return response()->json([
            'status' => 'success',
            'data' => $productos
        ]);
    }

    // Mostrar un producto específico por id
    public function show($id)
    {
        $producto = DB::table('productos')->where('id', $id)->first();
        if (!$producto) {
            return response()->json([
                'status' => 'error',
                'message' => 'Producto no encontrado'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $producto
        ]);
    }

    // Crear un nuevo producto
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'precio' => 'required|numeric',
        ]);

        $id = DB::table('productos')->insertGetId([
            'nombre' => $request->nombre,
            'precio' => $request->precio
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Producto creado',
            'id' => $id
        ], 201);
    }

    // Actualizar un producto existente
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'sometimes|required|string|max:255',
            'precio' => 'sometimes|required|numeric',
        ]);

        $updated = DB::table('productos')->where('id', $id)->update([
            'nombre' => $request->nombre,
            'precio' => $request->precio
        ]);

        if (!$updated) {
            return response()->json([
                'status' => 'error',
                'message' => 'Producto no encontrado o sin cambios'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Producto actualizado'
        ]);
    }

    // Eliminar un producto
    public function destroy($id)
    {
        $deleted = DB::table('productos')->where('id', $id)->delete();

        if (!$deleted) {
            return response()->json([
                'status' => 'error',
                'message' => 'Producto no encontrado'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Producto eliminado'
        ]);
    }
}
