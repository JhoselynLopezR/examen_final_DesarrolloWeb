<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ClienteController extends Controller
{
    // Mostrar todos los clientes
    public function index()
    {
        return response()->json(Cliente::latest()->get());
    }

    // Registrar un cliente
    public function store(Request $request)
    {
        $datos = $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
            'correo' => ['required', 'email', 'max:255', 'unique:clientes,correo'],
        ]);

        $cliente = Cliente::create($datos);

        return response()->json($cliente, 201);
    }

    // Consultar un cliente
    public function show(string $id)
    {
        $cliente = Cliente::findOrFail($id);

        return response()->json($cliente);
    }

    // Actualizar un cliente
    public function update(Request $request, string $id)
    {
        $cliente = Cliente::findOrFail($id);

        $datos = $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
            'correo' => [
                'required',
                'email',
                'max:255',
                Rule::unique('clientes', 'correo')->ignore($cliente->id),
            ],
        ]);

        $cliente->update($datos);

        return response()->json($cliente);
    }

    // Eliminar un cliente
    public function destroy(string $id)
    {
        $cliente = Cliente::findOrFail($id);

        $cliente->delete();

        return response()->noContent();
    }
}