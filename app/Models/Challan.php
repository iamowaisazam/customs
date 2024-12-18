<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Challan extends Model
{

    protected $table = 'delivery_challans';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    public function payorder()
    {
        
        return $this->belongsTo(Payorder::class,'payorder_id');
    }

    public function intimation()
    {
        
        return $this->hasOne(DeliveryIntimation::class, 'challan_id');
    }


   
}
