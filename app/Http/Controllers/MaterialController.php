<?php

namespace App\Http\Controllers;

use App\Models\Almacen;
use App\Models\Material;
use App\Models\Categoria;
use App\Models\TipoMaterial;
use App\Models\UnidadMedida;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class MaterialController extends Controller
{
    public function index(Request $request): View
    {
        $materials = Material::with(['categoria', 'tipomaterial', 'unidadmedida','almacen'])->paginate();

        return view('material.index', compact('materials'))
            ->with('i', ($request->input('page', 1) - 1) * $materials->perPage());
    }

    public function create(): View
    {
        $categorias = Categoria::all();
        $tiposMaterial = TipoMaterial::all();
        $unidadesMedida = UnidadMedida::all();
        $almacens = Almacen::all();

        return view('material.create', compact('categorias', 'tiposMaterial', 'unidadesMedida', 'almacens'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'marca' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'estante' => 'required|string|max:50',
            'categoria_id' => 'required|exists:categorias,id',
            'tipomaterial_id' => 'required|exists:tipo_materials,id',
            'almacen_id' => 'required|exists:almacens,id',
            'unidadmedida_id' => 'required|exists:unidad_medidas,id',
        ]);

        $materialExistente = Material::where('nombre', $request->nombre)->first();

        if ($materialExistente) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['nombre' => 'Oh no, parece que este material ya fue creado.']);
        }

        $nombreMaterial = $request->nombre;
        $categoria = Categoria::find($request->categoria_id);
        $tipoMaterial = TipoMaterial::find($request->tipomaterial_id);

        $inicialMaterial = strtoupper(substr($nombreMaterial, 0, 2));
        $inicialCategoria = strtoupper(substr($categoria->nombre, 0, 2));
        $inicialTipoMaterial = strtoupper(substr($tipoMaterial->nombre, 0, 2));

        $siguienteNumero = Material::count() + 1;
        $numeroControl = str_pad($siguienteNumero, 3, '0', STR_PAD_LEFT);

        $claveCompuesta = $inicialMaterial . $inicialCategoria . $inicialTipoMaterial . $numeroControl;

        $material = Material::create([
            'nombre' => $request->nombre,
            'clave' => $claveCompuesta,
            'marca' => $request->marca,
            'descripcion' => $request->descripcion,
            'estante' => $request->estante,
            'categoria_id' => $request->categoria_id,
            'tipomaterial_id' => $request->tipomaterial_id,
            'unidadmedida_id' => $request->unidadmedida_id,
            'almacen_id' => $request->almacen_id,
        ]);

        return Redirect::route('materials.index')
            ->with('success', 'Material creado exitosamente.');
    }

    public function show($id): View
    {
        $material = Material::with(['categoria', 'tipomaterial', 'unidadmedida', 'almacen'])->findOrFail($id);

        return view('material.show', compact('material'));
    }

    public function edit($id): View
    {
        $material = Material::findOrFail($id);
        $categorias = Categoria::all();
        $tiposMaterial = TipoMaterial::all();
        $unidadesMedida = UnidadMedida::all();
        $almacens = Almacen::all();

        return view('material.edit', compact('material', 'categorias', 'tiposMaterial', 'unidadesMedida', 'almacens'));
    }

    public function update(Request $request, Material $material)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'marca' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'estante' => 'required|string|max:50',
            'categoria_id' => 'required|exists:categorias,id',
            'tipomaterial_id' => 'required|exists:tipo_materials,id',
            'almacen_id' => 'required|exists:almacens,id',
            'unidadmedida_id' => 'required|exists:unidad_medidas,id',
        ]);

        $material->update([
            'nombre' => $request->nombre,
            'marca' => $request->marca,
            'descripcion' => $request->descripcion,
            'estante' => $request->estante,
            'categoria_id' => $request->categoria_id,
            'tipomaterial_id' => $request->tipomaterial_id,
            'unidadmedida_id' => $request->unidadmedida_id,
            'almacen_id' => $request->almacen_id,
        ]);

        return Redirect::route('materials.index')
            ->with('success', 'Material actualizado exitosamente.');
    }

    public function destroy($id)
    {
        $material = Material::findOrFail($id);
        $nombreMaterial = $material->nombre;
        $material->delete();

        $this->reordenarClaves();

        return Redirect::route('materials.index')
            ->with('success', "El material '$nombreMaterial' ha sido eliminado. Las claves han sido reordenadas.");
    }

    private function reordenarClaves()
    {
        $materials = Material::orderBy('id')->get();
        $contador = 1;

        foreach ($materials as $material) {
            $nombreMaterial = $material->nombre;
            $categoria = $material->categoria;
            $tipoMaterial = $material->tipomaterial;

            $inicialMaterial = strtoupper(substr($nombreMaterial, 0, 2));
            $inicialCategoria = strtoupper(substr($categoria->nombre, 0, 2));
            $inicialTipoMaterial = strtoupper(substr($tipoMaterial->nombre, 0, 2));

            $numeroControl = str_pad($contador, 3, '0', STR_PAD_LEFT);
            $claveCompuesta = $inicialMaterial . $inicialCategoria . $inicialTipoMaterial . $numeroControl;

            $material->clave = $claveCompuesta;
            $material->save();
            $contador++;
        }
    }
}
