<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ingreso extends Model
{
    protected $perPage = 20;

    protected $fillable = [
        'material_id',
        'personal_id',
        'cantidad_ingresada',
        'fecha'
    ];

    public function material()
    {
        return $this->belongsTo(Material::class);
    }

    public function almacen()
    {
        return $this->belongsTo(Almacen::class);
    }

    public function personal()
    {
        return $this->belongsTo(Personal::class);
    }
}
