<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{

    protected $table = 'payment_methods';

    protected $fillable = [
        "id",
        'title',
        "slug",
        "message",
        "created_at",
        "updated_at"
    ];

   
 
        
}