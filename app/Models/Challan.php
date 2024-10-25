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
    protected $fillable = [
        'id',
        'customer_id',
        'consignment_id',
        'status',
        'created_by',
        'created_at',
        'updated_at',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function consignment()
    {
        
        return $this->belongsTo(Consignment::class, 'consignment_id');
    }

    public function intimation()
    {
        
        return $this->belongsTo(DeliveryIntimation::class, 'challan_id');
    }


   
}
