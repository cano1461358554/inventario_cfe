<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $fillable = [
        'nombre',
        'clave',
        'marca',
        'descripcion',
        'estante',
        'categoria_id',
        'tipomaterial_id',
        'unidadmedida_id',
        'almacen_id'
    ];
    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }

    public function tipomaterial()
    {
        return $this->belongsTo(TipoMaterial::class, 'tipomaterial_id');
    }

    public function unidadmedida()
    {
        return $this->belongsTo(UnidadMedida::class, 'unidadmedida_id');
    }
    public function ingresos()
    {
        return $this->hasMany(Ingreso::class);
    }
    public function almacen()
    {
        return $this->belongsTo(Almacen::class, 'almacen_id');
    }
    // En app/Models/Material.php
    public function stocks()
    {
        return $this->hasMany(Stock::class);
    }
//    protected static function boot()
//    {
//        parent::boot();
//
//        static::creating(function ($material) {
//            // Generar la clave automáticamente
//            $material->clave = 'MAT-' . str_pad(Material::count() + 1, 5, '0', STR_PAD_LEFT);
//        });
//    }
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($material) {
            $material->clave = 'MAT-' . str_pad(Material::count() + 1, 5, '0', STR_PAD_LEFT);
        });
    }
}
