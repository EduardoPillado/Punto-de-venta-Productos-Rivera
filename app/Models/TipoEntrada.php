<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoEntrada extends Model
{
    use HasFactory;
    protected $table="tipoEntrada";
    protected $primaryKey='pkTipoEntrada';
    protected $fillable = [
        'nombreTipoEntrada'
    ];
    public $timestamps=false;
    public function entrada(){
        return $this->hasMany(Entrada::class, 'fkTipoEntrada');
    }
}
