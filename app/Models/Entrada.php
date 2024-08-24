<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entrada extends Model
{
    use HasFactory;
    protected $table="entrada";
    protected $primaryKey='pkEntrada';
    protected $fillable = [
        'descripcionEntrada',
        'fkEmpleado',
        'fkTipoEntrada',
        'importeTotalEntrada',
        'fkSucursal',
        'fechaEntrada'
    ];
    public $timestamps=false;
    public function empleado(){
        return $this->belongsTo(Empleado::class, 'fkEmpleado');
    }
    public function tipoEntrada(){
        return $this->belongsTo(TipoEntrada::class, 'fkTipoEntrada');
    }
    public function sucursal(){
        return $this->belongsTo(Sucursal::class, 'fkSucursal');
    }
    public function productos(){
        return $this->belongsToMany(Producto::class, 'entradaProducto', 'fkEntrada', 'fkProducto')
            ->withPivot('cantidadUnidades');
    }
    public function entradaProducto(){
        return $this->hasMany(EntradaProducto::class, 'fkEntrada');
    }
}
