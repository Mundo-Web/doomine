<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    use HasFactory;
    protected $fillable=['name','slug', 'description', 'url_image', 'name_image','destacar', 'visible', 'state' , 'number'];

    public function productos()
    {
        return $this->hasMany(Products::class);
    }
}
