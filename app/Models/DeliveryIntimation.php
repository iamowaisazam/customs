<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class DeliveryIntimation extends Model
{
    protected $table = 'delivery_intimations';

    protected $guarded = [];

    public function challan()
    {
        return $this->belongsTo(Challan::class, 'challan_id');
    }

    public function payorder()
    {   
        return $this->belongsTo(Payorder::class,'payorder_id');
    }

  
}
