<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salida extends Model
{
    use HasFactory;
    protected $table="salida";
    protected $primaryKey='pkSalida';
    protected $fillable = [
        'descripcionSalida',
        'fkEmpleado',
        'nombreCliente',
        'correoCliente',
        'fkTipoSalida',
        'importeTotalSalida',
        'fkSucursal',
        'fechaSalida'
    ];
    public $timestamps=false;
    public function empleado(){
        return $this->belongsTo(Empleado::class, 'fkEmpleado');
    }
    public function empleados() {
        return $this->belongsToMany(Empleado::class, 'corteEmpleado', 'fkCorte', 'fkEmpleado');
    }
    public function tipoSalida(){
        return $this->belongsTo(TipoSalida::class, 'fkTipoSalida');
    }
    public function sucursal(){
        return $this->belongsTo(Sucursal::class, 'fkSucursal');
    }
    public function productos(){
        return $this->belongsToMany(Producto::class, 'salidaProducto', 'fkSalida', 'fkInventario')
            ->withPivot('cantidadUnidades');
    }
    public function salidaProducto(){
        return $this->hasMany(SalidaProducto::class, 'fkSalida');
    }
}
