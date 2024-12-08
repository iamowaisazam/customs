<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $table = 'products';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'id',
        'name',
        'description',
        'sku',
        'unit',
        'price',
        'status',
        'created_by',
        'created_at',
        'updated_at',
    ];
       
}

