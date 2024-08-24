<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Corte extends Model
{
    use HasFactory;
    protected $table="corte";
    protected $primaryKey='pkCorte';
    protected $fillable = [
        'fechaCorteInicio',
        'fechaCorteFin',
        'cantidadVentas',
        'gananciaTotal'
    ];
    public $timestamps=false;
    public function empleados() {
        return $this->belongsToMany(Empleado::class, 'corteEmpleado', 'fkCorte', 'fkEmpleado');
    }
    public function corteEmpleado(){
        return $this->hasMany(CorteEmpleado::class, 'fkCorte');
    }
}
