<?php

namespace App\Http\Controllers\Estudiantes;

use App\Models\Estudiante;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;

class EstudiantesController extends Controller
{
    // 📄 Listar estudiantes
    public function index()
    {
        $estudiantes = Estudiante::orderBy('id', 'DESC')->get();

        return Inertia::render('Estudiantes/Index', [
            'estudiantes' => $estudiantes
        ]);
    }

    // 🧾 Formulario de creación
    public function create()
    {
        return Inertia::render('Estudiantes/Create');
    }

    // 💾 Guardar nuevo estudiante
    public function store(Request $request)
    {
        $validated = $request->validate([
            'codigo' => 'required|string|max:20',
            'nombres' => 'required|string|max:100',
            'pri_ape' => 'required|string|max:50',
            'seg_ape' => 'nullable|string|max:50',
            'dni' => 'required|string|max:20',
            'carrera' => 'required|string|max:100',
        ]);

        Estudiante::create($validated);

        return Redirect::route('estudiantes.index')->with('success', 'Estudiante creado correctamente');
    }

    // ✏️ Editar estudiante
    public function edit($id)
    {
        $estudiante = Estudiante::findOrFail($id);

        return Inertia::render('Estudiantes/Edit', [
            'estudiante' => $estudiante
        ]);
    }

    // 🔄 Actualizar estudiante
    public function update(Request $request, Estudiante $estudiante)
    {
        $validated = $request->validate([
            'codigo' => 'required|string|max:20',
            'nombres' => 'required|string|max:100',
            'pri_ape' => 'required|string|max:50',
            'seg_ape' => 'nullable|string|max:50',
            'dni' => 'required|string|max:20',
            'carrera' => 'required|string|max:100',
        ]);

        $estudiante->update($validated);

        return Redirect::route('estudiantes.index')->with('success', 'Estudiante actualizado correctamente');
    }

    // 🗑️ Confirmación de eliminación
    public function delete($id)
    {
        $estudiante = Estudiante::findOrFail($id);

        return Inertia::render('Estudiantes/Delete', [
            'estudiante' => $estudiante
        ]);
    }

    // ❌ Eliminar estudiante
    public function destroy(Estudiante $estudiante)
    {
        $estudiante->delete();

        return Redirect::route('estudiantes.index')->with('success', 'Estudiante eliminado correctamente');
    }
}
