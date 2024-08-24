<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Empleado extends Model
{
    use HasFactory;
    use HasRoles;
    protected $guard_name = 'web';
    protected $table="empleado";
    protected $primaryKey='pkEmpleado';
    protected $fillable = [
        'nombreEmpleado',
        'apellidoPaterno',
        'apellidoMaterno',
        'contraseña',
        'telefono',
        'fkSucursal',
        'tipoEmpleado',
        'estatusEmpleado'
    ];
    public $timestamps=false;
    public function sucursal(){
        return $this->belongsTo(Sucursal::class, 'fkSucursal');
    }
    public function entrada(){
        return $this->hasMany(Entrada::class, 'fkEmpleado');
    }
    public function salida(){
        return $this->hasMany(Salida::class, 'fkEmpleado');
    }
    public function corteEmpleado(){
        return $this->hasMany(CorteEmpleado::class, 'fkEmpleado');
    }
}
