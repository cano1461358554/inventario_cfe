<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\Prestamo;
use App\Models\Personal;
use App\Models\Devolucion;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PrestamoController extends Controller
{
    public function index(Request $request)
    {
        $query = Prestamo::with(['personal', 'material', 'devolucions']);

        if ($request->has('persona') && !empty($request->persona)) {
            $query->whereHas('personal', function($q) use ($request) {
                $q->where('nombre', 'like', '%'.$request->persona.'%')
                    ->orWhere('apellido', 'like', '%'.$request->persona.'%')
                    ->orWhere('RP', 'like', '%'.$request->persona.'%');
            });
        }

        $prestamos = $query->orderBy('fecha_prestamo', 'desc')->paginate(10);

        $materials = Material::whereHas('stocks', function($q) {
            $q->select(DB::raw('SUM(cantidad) as total'))
                ->havingRaw('SUM(cantidad) > 0');
        })->get();

        $personals = Personal::all();

        return view('prestamo.index', compact('prestamos', 'materials', 'personals'));
    }

    public function create()
    {
        $prestamo = new Prestamo();
        $prestamo->fecha_prestamo = now()->toDateString();

        $materials = Material::whereHas('stocks', function($q) {
            $q->select(DB::raw('SUM(cantidad) as total'))
                ->havingRaw('SUM(cantidad) > 0');
        })->get();

        $personals = Personal::all();

        return view('prestamo.create', compact('prestamo', 'materials', 'personals'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'fecha_prestamo' => 'required|date',
            'cantidad_prestada' => 'required|numeric|min:0.01',
            'material_id' => 'required|exists:materials,id',
            'personal_id' => 'required|exists:personals,id',
            'descripcion' => 'required|string|max:255',
        ]);

        DB::beginTransaction();
        try {
            $material = Material::with(['stocks'])->findOrFail($validatedData['material_id']);
            $stockTotal = $material->stocks->sum('cantidad');

            if ($stockTotal < $validatedData['cantidad_prestada']) {
                return back()->withErrors([
                    'cantidad_prestada' => 'No hay suficiente stock disponible. Stock total: '.$stockTotal
                ])->withInput();
            }

            $cantidadARestar = $validatedData['cantidad_prestada'];
            $stocks = $material->stocks()->orderBy('created_at')->get();

            foreach ($stocks as $stock) {
                if ($cantidadARestar <= 0) break;
                $resta = min($stock->cantidad, $cantidadARestar);
                $stock->decrement('cantidad', $resta);
                $cantidadARestar -= $resta;
            }

            Prestamo::create($validatedData);

            DB::commit();

            return redirect()->route('prestamos.index')
                ->with('success', 'Préstamo creado correctamente.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()
                ->with('error', 'Error al crear el préstamo: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        $prestamo = Prestamo::with(['material', 'personal', 'devolucions'])->findOrFail($id);
        $cantidad_devuelta = $prestamo->devolucions->sum('cantidad_devuelta');
        $pendiente = $prestamo->cantidad_prestada - $cantidad_devuelta;

        return view('prestamo.show', compact('prestamo', 'cantidad_devuelta', 'pendiente'));
    }

    public function edit(Prestamo $prestamo)
    {
        $materials = Material::whereHas('stocks', function($q) {
            $q->select(DB::raw('SUM(cantidad) as total'))
                ->havingRaw('SUM(cantidad) > 0');
        })->get();

        $personals = Personal::all();

        return view('prestamo.edit', compact('prestamo', 'materials', 'personals'));
    }

    public function update(Request $request, Prestamo $prestamo)
    {
        $request->validate([
            'material_id' => 'required|exists:materials,id',
            'fecha_prestamo' => 'required|date',
            'cantidad_prestada' => 'required|numeric|min:0.01',
            'personal_id' => 'required|exists:personals,id',
            'descripcion' => 'nullable|string',
        ]);

        DB::beginTransaction();
        try {
            $diferencia = $request->cantidad_prestada - $prestamo->cantidad_prestada;
            $material = Material::with(['stocks'])->findOrFail($request->material_id);

            if ($diferencia > 0) {
                $stockTotal = $material->stocks->sum('cantidad');
                if ($stockTotal < $diferencia) {
                    throw new \Exception('No hay suficiente stock disponible. Stock actual: '.$stockTotal);
                }

                $cantidadARestar = $diferencia;
                $stocks = $material->stocks()->orderBy('created_at')->get();

                foreach ($stocks as $stock) {
                    if ($cantidadARestar <= 0) break;
                    $resta = min($stock->cantidad, $cantidadARestar);
                    $stock->decrement('cantidad', $resta);
                    $cantidadARestar -= $resta;
                }
            } elseif ($diferencia < 0) {
                $materialOriginal = Material::with(['stocks'])->findOrFail($prestamo->material_id);
                $stock = $materialOriginal->stocks()->first();
                if (!$stock) {
                    $stock = Stock::create([
                        'material_id' => $materialOriginal->id,
                        'almacen_id' => 1,
                        'cantidad' => 0
                    ]);
                }
                $stock->increment('cantidad', abs($diferencia));
            }

            $prestamo->update($request->all());

            DB::commit();

            return redirect()->route('prestamos.index')
                ->with('success', 'Préstamo actualizado correctamente.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()
                ->with('error', 'Error al actualizar: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $prestamo = Prestamo::findOrFail($id);

            if ($prestamo->devolucions()->exists()) {
                throw new \Exception('No se puede eliminar el préstamo porque tiene devoluciones asociadas.');
            }

            $material = Material::with(['stocks'])->find($prestamo->material_id);
            if ($material) {
                $stock = $material->stocks()->first();
                if (!$stock) {
                    $stock = Stock::create([
                        'material_id' => $material->id,
                        'almacen_id' => 1,
                        'cantidad' => 0
                    ]);
                }
                $stock->increment('cantidad', $prestamo->cantidad_prestada);
            }

            $prestamo->delete();

            DB::commit();

            return redirect()->route('prestamos.index')
                ->with('success', 'Préstamo eliminado correctamente.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('prestamos.index')
                ->with('error', $e->getMessage());
        }
    }

    public function datosDevolucion($id)
    {
        $prestamo = Prestamo::with(['material', 'personal', 'devolucions'])->findOrFail($id);
        $cantidad_devuelta = $prestamo->devolucions->sum('cantidad_devuelta');
        $pendiente = $prestamo->cantidad_prestada - $cantidad_devuelta;
        $stockTotal = $prestamo->material ? $prestamo->material->stocks->sum('cantidad') : 0;

        return response()->json([
            'prestamo_id' => $prestamo->id,
            'material_id' => $prestamo->material_id,
            'material_nombre' => $prestamo->material->nombre ?? 'Sin material',
            'cantidad_prestada' => $prestamo->cantidad_prestada,
            'personal_id' => $prestamo->personal_id,
            'personal_nombre' => ($prestamo->personal->nombre ?? 'Sin personal') . ' ' . ($prestamo->personal->apellido ?? ''),
            'descripcion' => $prestamo->descripcion,
            'cantidad_pendiente' => $pendiente,
            'stock_actual' => $stockTotal
        ]);
    }

    public function procesarDevolucion(Request $request)
    {
        $validatedData = $request->validate([
            'prestamo_id' => 'required|exists:prestamos,id',
            'cantidad_devuelta' => 'required|numeric|min:0.01',
            'fecha_devolucion' => 'required|date|before_or_equal:today',
            'descripcion_estado' => 'required|string|max:500',
            'almacen_id' => 'required|exists:almacens,id'
        ]);

        DB::beginTransaction();
        try {
            $prestamo = Prestamo::with(['material', 'devolucions'])->findOrFail($validatedData['prestamo_id']);
            $totalDevuelto = $prestamo->devolucions->sum('cantidad_devuelta');
            $pendiente = $prestamo->cantidad_prestada - $totalDevuelto;

            if ($validatedData['cantidad_devuelta'] > $pendiente) {
                throw new \Exception("La cantidad a devolver ({$validatedData['cantidad_devuelta']}) excede lo pendiente ($pendiente)");
            }

            Devolucion::create([
                'prestamo_id' => $prestamo->id,
                'cantidad_devuelta' => $validatedData['cantidad_devuelta'],
                'fecha_devolucion' => $validatedData['fecha_devolucion'],
                'descripcion_estado' => $validatedData['descripcion_estado']
            ]);

            Stock::firstOrCreate(
                ['material_id' => $prestamo->material_id, 'almacen_id' => $validatedData['almacen_id']],
                ['cantidad' => 0]
            )->increment('cantidad', $validatedData['cantidad_devuelta']);

            DB::commit();

            return redirect()->route('prestamos.index')
                ->with('success', 'Devolución registrada correctamente.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()
                ->with('error', 'Error al registrar la devolución: ' . $e->getMessage());
        }
    }
}
