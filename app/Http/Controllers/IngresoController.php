<?php

namespace App\Http\Controllers;

use App\Models\Personal;
use App\Models\Stock;
use App\Models\Material;
use App\Models\Ingreso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class IngresoController extends Controller
{
    public function index(Request $request): View
    {
        $ingresos = Ingreso::with(['material', 'personal'])->paginate();
        return view('ingreso.index', compact('ingresos'))
            ->with('i', ($request->input('page', 1) - 1) * $ingresos->perPage());
    }

    public function create(): View
    {
        $materials = Material::all();
        $personals = Personal::all();
        return view('ingreso.create', compact('materials', 'personals'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'cantidad_ingresada' => 'required|numeric|min:1',
                'fecha' => 'required|date',
                'material_id' => 'required|exists:materials,id',
                'personal_id' => 'required|exists:personals,id',
            ]);

            $material = Material::findOrFail($request->material_id);

            // Buscar el stock actual
            $stock = Stock::where('material_id', $request->material_id)->first();

            if ($stock) {
                $stock->cantidad += $request->cantidad_ingresada;
                $stock->save();
            } else {
                Stock::create([
                    'material_id' => $request->material_id,
                    'cantidad' => $request->cantidad_ingresada,
                    'almacen_id' => $material->almacen_id, // <- aquí tomamos el almacén desde el material
                ]);
            }

            Ingreso::create([
                'cantidad_ingresada' => $request->cantidad_ingresada,
                'fecha' => $request->fecha,
                'material_id' => $request->material_id,
                'personal_id' => $request->personal_id,
            ]);

            return redirect()->route('ingresos.index')->with('success', 'Ingreso registrado correctamente.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al registrar el ingreso: ' . $e->getMessage());
        }
    }


    public function edit($id): View
    {
        $ingreso = Ingreso::findOrFail($id);
        $materials = Material::all();
        $personals = Personal::all();
        return view('ingreso.edit', compact('ingreso', 'materials', 'personals'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $validatedData = $request->validate([
            'material_id' => 'required|exists:materials,id',
            'cantidad_ingresada' => 'required|numeric|min:1',
            'fecha' => 'required|date',
            'personal_id' => 'required|exists:personals,id',
        ]);

        $ingreso = Ingreso::findOrFail($id);
        $ingreso->update($validatedData);

        return redirect()->route('ingresos.index')
            ->with('success', 'Ingreso actualizado correctamente.');
    }

    public function destroy($id): RedirectResponse
    {
        $ingreso = Ingreso::findOrFail($id);
        $ingreso->delete();

        return redirect()->route('ingresos.index')
            ->with('success', 'Ingreso eliminado correctamente.');
    }

    public function show($id): View
    {
        $ingreso = Ingreso::with(['material', 'personal'])->findOrFail($id);
        return view('ingreso.show', compact('ingreso'));
    }
}
