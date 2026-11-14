<?php
namespace App\Http\Controllers;

use App\Models\Animal;
use Illuminate\Http\Request;

class AnimalController extends Controller
{
    public function index()
    {
        return response()->json(Animal::all(), 200);
    }

    public function store(Request $request)
    {
        $datos = $request->validate([
            'nombre' => 'required|string|max:255',
            'especie' => 'required|string|max:255',
            'raza' => 'required|string|max:255',
            'edad' => 'required|integer|min:0'
        ]);

        $animal = Animal::create($datos);

        return response()->json($animal, 201);
    }

    public function show($id)
    {
        return response()->json(Animal::findOrFail($id), 200);
    }

    public function update(Request $request, $id)
    {
        $animal = Animal::findOrFail($id);

        $datos = $request->validate([
            'nombre' => 'required|string|max:255',
            'especie' => 'required|string|max:255',
            'raza' => 'required|string|max:255',
            'edad' => 'required|integer|min:0'
        ]);

        $animal->update($datos);

        return response()->json($animal, 200);
    }

    public function destroy($id)
    {
        $animal = Animal::findOrFail($id);
        $animal->delete();

        return response()->noContent();
    }
}
