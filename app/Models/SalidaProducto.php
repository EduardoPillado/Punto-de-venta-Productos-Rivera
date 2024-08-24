<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalidaProducto extends Model
{
    use HasFactory;
    protected $table="salidaProducto";
    protected $primaryKey='pkSalidaProducto';
    protected $fillable = [
        'fkSalida',
        'fkInventario',
        'cantidadUnidades',
        'importePorProducto'
    ];
    public $timestamps=false;
    public function corteProducto(){
        return $this->hasMany(CorteProducto::class, 'fkSalidaProducto');
    }
    public function salida(){
        return $this->belongsTo(Salida::class, 'fkSalida');
    }
}
