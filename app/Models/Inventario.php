<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    use HasFactory;
    protected $table="inventario";
    protected $primaryKey='pkInventario';
    protected $fillable = [
        'fkProducto',
        'cantidadExistencias',
        'fechaUltimaActualizacion'
    ];
    public $timestamps=false;
    public function producto(){
        return $this->belongsTo(Producto::class, 'fkProducto');
    }
    public function salidas(){
        return $this->belongsToMany(Salida::class, 'salidaProducto', 'fkInventario', 'fkSalida')
            ->withPivot('cantidadUnidades');
    }
}
