<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Personal
 *
 * @property $id
 * @property $nombre
 * @property $apellido
 * @property $RP
 * @property $tipo_usuario
 * @property $created_at
 * @property $updated_at
 *
 * @property Devolucion[] $devolucions
 * @property Ingreso[] $ingresos
 * @property Prestamo[] $prestamos
 * @property Resguardo[] $resguardos
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Personal extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['nombre', 'apellido', 'RP', 'tipo_usuario'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function devolucions()
    {
        return $this->hasMany(\App\Models\Devolucion::class, 'id', 'personal_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ingresos()
    {
        return $this->hasMany(\App\Models\Ingreso::class, 'id', 'personal_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function prestamos()
    {
        return $this->hasMany(\App\Models\Prestamo::class, 'id', 'personal_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function resguardos()
    {
        return $this->hasMany(\App\Models\Resguardo::class, 'id', 'personal_id');
    }
    
}
