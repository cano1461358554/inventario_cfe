<?php

namespace App\Http\Controllers;

use App\Models\Personal;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\PersonalRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class PersonalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
//    public function index(Request $request): View
//    {
//        $personals = Personal::paginate();
//
//        return view('personal.index', compact('personals'))
//            ->with('i', ($request->input('page', 1) - 1) * $personals->perPage());
//    }
    public function index(Request $request): View
    {
        $query = Personal::query();

        if ($request->has('nombre')) {
            $query->where('nombre', 'like', '%' . $request->input('nombre') . '%');
        }

        if ($request->has('mostrar_coincidencias') && $request->input('mostrar_coincidencias')) {
            $query->where('nombre', 'like', '%' . $request->input('nombre') . '%');
        }

        $personals = $query->paginate();

        return view('personal.index', compact('personals'))
            ->with('i', ($request->input('page', 1) - 1) * $personals->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $personal = new Personal();

        return view('personal.create', compact('personal'));
    }

    /**
     * Store a newly created resource in storage.
     */
//    public function store(PersonalRequest $request): RedirectResponse
//    {
//        // Validar y guardar los datos del formulario
//        Personal::create($request->validated());
//
//        return Redirect::route('personals.index')
//            ->with('success', 'Personal creado correctamente.');
//    }
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'RP' => 'required|string|max:255|unique:personals,RP',
            'tipo_usuario' => 'required|string|in:Administrador,Supervisor,Empleado',
        ]);

        $existingPersonal = Personal::where('RP', $request->RP)->first();

        if ($existingPersonal) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['RP' => 'Este RP ya ha sido utilizado.']);
        }

        Personal::create($request->all());

        return redirect()->route('personals.index')
            ->with('success', 'Personal creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $personal = Personal::find($id);

        return view('personal.show', compact('personal'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $personal = Personal::find($id);

        return view('personal.edit', compact('personal'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PersonalRequest $request, Personal $personal): RedirectResponse
    {
        $personal->update($request->validated());

        return Redirect::route('personals.index')
            ->with('success', 'Personal actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): RedirectResponse
    {
        Personal::find($id)->delete();

        return Redirect::route('personals.index')
            ->with('success', 'Personal eliminado correctamente.');
    }
}
