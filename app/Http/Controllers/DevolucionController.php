<?php

namespace App\Http\Controllers;

use App\Models\Almacen;
use App\Models\Devolucion;
use App\Models\Material;
use App\Models\Prestamo;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\DevolucionRequest;
use Illuminate\View\View;

class DevolucionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $devolucions = Devolucion::with(['prestamo', 'prestamo.material', 'prestamo.personal'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('devolucion.index', compact('devolucions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $prestamos = Prestamo::whereDoesntHave('devolucion')
            ->with(['material', 'personal'])
            ->get();

        return view('devolucion.create', compact('prestamos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'prestamo_id' => 'required|exists:prestamos,id',
            'fecha_devolucion' => 'required|date',
            'cantidad_devuelta' => 'required|numeric|min:1',
            'descripcion_estado' => 'required|string|max:255',
        ]);

        $prestamo = Prestamo::findOrFail($validated['prestamo_id']);

        // Validar que la cantidad devuelta no exceda la cantidad pendiente
        $cantidadPendiente = $prestamo->cantidad_prestada - $prestamo->devolucions()->sum('cantidad_devuelta');

        if ($validated['cantidad_devuelta'] > $cantidadPendiente) {
            return redirect()->route('prestamos.index')
                ->with('error', 'La cantidad devuelta ('.$validated['cantidad_devuelta'].') excede la cantidad pendiente ('.$cantidadPendiente.')');
        }

        // Crear la devolución
        Devolucion::create($validated);

        return redirect()->route('prestamos.index')
            ->with('success', 'Devolución registrada correctamente. Pendiente: '.($cantidadPendiente - $validated['cantidad_devuelta']));

    }

    /**
     * Display the specified resource.
     */
    public function show(Devolucion $devolucion): View
    {
        $devolucion->load(['prestamo', 'prestamo.material', 'prestamo.personal']);

        return view('devolucion.show', compact('devolucion'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Devolucion $devolucion): View
    {
        $prestamos = Prestamo::with(['material', 'personal'])->get();

        return view('devolucion.edit', compact('devolucion', 'prestamos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Devolucion $devolucion): RedirectResponse
    {
        $validated = $request->validate([
            'prestamo_id' => 'required|exists:prestamos,id',
            'fecha_devolucion' => 'required|date',
            'cantidad_devuelta' => 'required|numeric|min:1',
            'descripcion_estado' => 'required|string|max:255',
        ]);

        // Verificar cantidad devuelta
        $prestamo = Prestamo::findOrFail($validated['prestamo_id']);
        if ($validated['cantidad_devuelta'] > $prestamo->cantidad_prestada) {
            return back()->withErrors([
                'cantidad_devuelta' => 'La cantidad devuelta no puede ser mayor que la cantidad prestada'
            ])->withInput();
        }

        $devolucion->update($validated);

        return redirect()->route('devolucions.index')
            ->with('success', 'Devolución actualizada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Devolucion $devolucion): RedirectResponse
    {
        $devolucion->delete();

        return redirect()->route('devolucions.index')
            ->with('success', 'Devolución eliminada correctamente');
    }
}
