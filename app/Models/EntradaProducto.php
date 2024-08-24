<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntradaProducto extends Model
{
    use HasFactory;
    protected $table="entradaProducto";
    protected $primaryKey='pkEntradaProducto';
    protected $fillable = [
        'fkEntrada',
        'fkProducto',
        'cantidadUnidades',
        'importePorProducto'
    ];
    public $timestamps=false;
    public function entrada(){
        return $this->belongsTo(Entrada::class, 'fkEntrada');
    }
}
