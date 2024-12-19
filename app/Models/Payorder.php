<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payorder extends Model
{

    protected $table = 'payorders';

    /**
     * The attributes that are mass assignable.
     */
    protected $guarded = [];
    
    public function consignment()
    {
        return $this->belongsTo(Consignment::class, 'consignment_id');
    }
       
}

