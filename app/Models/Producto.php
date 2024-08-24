<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;
    protected $table="producto";
    protected $primaryKey='pkProducto';
    protected $fillable = [
        'nombreProducto',
        'descripcion',
        'imagenProducto',
        'peso',
        'precio',
        'estatusProducto'
    ];
    public $timestamps=false;
    public function entradas(){
        return $this->belongsToMany(Entrada::class, 'entradaProducto', 'fkProducto', 'fkEntrada')
            ->withPivot('cantidadUnidades');
    }
    public function inventario(){
        return $this->belongsTo(Inventario::class, 'fkProducto');
    }
}
