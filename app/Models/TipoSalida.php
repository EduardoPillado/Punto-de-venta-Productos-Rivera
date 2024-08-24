<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoSalida extends Model
{
    use HasFactory;
    protected $table="tipoSalida";
    protected $primaryKey='pkTipoSalida';
    protected $fillable = [
        'nombreTipoSalida'
    ];
    public $timestamps=false;
    public function salida(){
        return $this->hasMany(Salida::class, 'fkTipoSalida');
    }
}
