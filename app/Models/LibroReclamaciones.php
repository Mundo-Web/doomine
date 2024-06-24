<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LibroReclamaciones extends Model
{
    use HasFactory;
    protected $fillable = ['fullname', 'type_document', 'number_document', 'cellphone', 
    'email', 'department', 'province', 'district', 'address', 'typeitem', 'amounttotal', 'category_product_service',
    'description', 'type_claim', 'date_incident', 'address_incident', 'detail_incident',
    'archivo', 'is_read', 'status'];
}
