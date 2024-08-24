<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
    use HasFactory;
    protected $table="sucursal";
    protected $primaryKey='pkSucursal';
    protected $fillable = [
        'nombreSucursal',
        'ubicacion',
        'estatusSucursal'
    ];
    public $timestamps=false;
    public function empleado(){
        return $this->hasMany(Empleado::class, 'fkSucursal');
    }
    public function entrada(){
        return $this->hasMany(Entrada::class, 'fkSucursal');
    }
    public function salida(){
        return $this->hasMany(Salida::class, 'fkSucursal');
    }
}
