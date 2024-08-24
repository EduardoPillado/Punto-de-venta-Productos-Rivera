<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CorteEmpleado extends Model
{
    use HasFactory;
    protected $table="corteEmpleado";
    protected $primaryKey='pkCorteEmpleado';
    protected $fillable = [
        'fkCorte',
        'fkEmpleado'
    ];
    public $timestamps=false;
    public function corte(){
        return $this->belongsTo(Corte::class, 'fkCorte');
    }
    public function empleado(){
        return $this->belongsTo(Empleado::class, 'fkEmpleado');
    }
}
