<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class General extends Model
{
    use HasFactory;

    protected $fillable = ['address', 'inside', 'district', 'city', 'country', 'cellphone','office_phone', 'email', 'facebook', 'instagram','youtube', 'twitter', 'tiktok', 'whatsapp',  'form_email', 'business_hours', 'schedule', 'mensaje_whatsapp', 'aboutus', 'is_active_discount'];

}
