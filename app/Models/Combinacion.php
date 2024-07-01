<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Combinacion extends Model
{
    use HasFactory;

    protected $table = 'combinaciones';

    protected $fillable = [
        'product_id', 'color_id', 'talla_id', 'stock'
    ];

    // public function product()
    // {
    //     return $this->belongsTo(Products::class, 'product_id');
    // }

    public function color()
    {
        return $this->belongsTo(AttributesValues::class, 'color_id');
    }

    public function talla()
    {
        return $this->belongsTo(AttributesValues::class, 'talla_id');
    }
}
