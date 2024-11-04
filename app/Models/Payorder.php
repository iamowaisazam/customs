<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payorder extends Model
{

    protected $table = 'payorders';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'id',
        'consignment_id',
        'consignment_details',
        'footer',
        'items',
        'date',
        'header',
        'status',
        'created_by',
        'created_at',
        'updated_at',
    ];

    public function consignment()
    {
        return $this->belongsTo(Consignment::class, 'consignment_id');
    }
       
}

