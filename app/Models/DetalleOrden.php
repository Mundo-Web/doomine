<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleOrden extends Model
{
    use HasFactory;
    protected $fillable = [
        'producto_id',
        'cantidad',
        'orden_id',
        'precio',
        'combinacion_id'
    ];

    public function ordenes()
    {
        return $this->belongsTo(Ordenes::class, 'orden_id');
    }

    public function producto()
    {
        return $this->belongsTo(Products::class, 'producto_id');
    }

    public function imagenProducto()
    {
        return $this->hasOne(ImagenProducto::class, 'product_id', 'producto_id')->where('caratula', 1);
    }

}
