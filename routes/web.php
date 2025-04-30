<?php

use App\Http\Controllers\AlmacenController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\DevolucionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IngresoController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\MovimientoController;
use App\Http\Controllers\PersonalController;
use App\Http\Controllers\PrestamoController;
use App\Http\Controllers\ResguardoController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\TipoMaterialController;
use App\Http\Controllers\TipoMovimientoController;
use App\Http\Controllers\UbicacionController;
use App\Http\Controllers\UnidadMedidaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\profile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Ruta principal
Route::get('/', function () {
    return view('welcome');
});

// Autenticación
Auth::routes();

// Rutas protegidas por middleware 'auth'
Route::middleware('auth')->group(function () {
    // Dashboard principal
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // Dashboards según rol
    Route::get('/admin/dashboard', [HomeController::class, 'adminDashboard'])->name('admin.dashboard');
    Route::get('/encargado/dashboard', [HomeController::class, 'encargadoDashboard'])->name('encargado.dashboard');
    Route::get('/empleado/dashboard', [HomeController::class, 'empleadoDashboard'])->name('empleado.dashboard');

    // Recursos principales
    Route::resource('devolucions', DevolucionController::class);
    Route::resource('resguardos', ResguardoController::class);
    Route::resource('ingresos', IngresoController::class);
    Route::resource('prestamos', PrestamoController::class);
    Route::resource('almacens', AlmacenController::class);
    Route::resource('ubicacions', UbicacionController::class);
    Route::resource('movimientos', MovimientoController::class);
    Route::resource('tipo-movimientos', TipoMovimientoController::class);
    Route::resource('unidad-medidas', UnidadMedidaController::class);
    Route::resource('tipo-materials', TipoMaterialController::class);
    Route::resource('materials', MaterialController::class);
    Route::resource('categorias', CategoriaController::class);
    Route::resource('stocks', StockController::class);
    Route::resource('personals', PersonalController::class);

    // Rutas especiales para préstamos y devoluciones
    Route::prefix('prestamos')->group(function () {
        Route::get('/por-personal/{personal}', [PrestamoController::class, 'porPersonal'])
            ->name('prestamos.por-personal');

        Route::get('/{id}/datos-devolucion', [PrestamoController::class, 'datosDevolucion'])
            ->name('prestamos.datos-devolucion');

        Route::post('/{prestamo}/devolucion', [PrestamoController::class, 'procesarDevolucion'])
            ->name('prestamos.procesar-devolucion');
    });

    // Ruta auxiliar para obtener préstamos por personal
    Route::get('/prestamos-por-personal/{personal}', function ($personalId) {
        return App\Models\Prestamo::where('personal_id', $personalId)->get();
    });

    // Almacena devoluciones desde formulario directo
    Route::post('/devolucions', [DevolucionController::class, 'store'])->name('devolucions.store');
});
Route::resource('categorias', CategoriaController::class)->names([
    'index' => 'categorias.index',
]);

Route::resource('tipo-material', TipoMaterialController::class)->names([
    'index' => 'tipo-material.index',
]);

Route::resource('unidad-medida', UnidadMedidaController::class)->names([
    'index' => 'unidad-medida.index',
]);

//Route::resource('', ::class)->names([])

