<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prestamo extends Model
{
    protected $perPage = 20;
    protected $table = 'prestamos';

    protected $fillable = [
        'fecha_prestamo',
        'cantidad_prestada',
        'material_id',
        'personal_id',
        'descripcion'
    ];

    public function devolucions()
    {
        return $this->hasMany(Devolucion::class);
    }
    public function getCantidadPendienteAttribute()
    {
        return $this->cantidad_prestada - $this->devolucions->sum('cantidad_devuelta');
    }

    // Método para saber si está completamente devuelto
    public function getCompletamenteDevueltoAttribute()
    {
        return $this->cantidad_pendiente <= 0;
    }

    public function material()
    {
        return $this->belongsTo(Material::class, 'material_id');
    }

    public function personal()
    {
        return $this->belongsTo(Personal::class, 'personal_id');
    }
    public function resguardo()
    {
        return $this->hasOne(Resguardo::class);
    }

}
