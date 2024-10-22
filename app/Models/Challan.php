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
        'l_no',
        'm_s',
        'it_no',
        'lgnno',
        'invoice_no',
        'invoice_date',
        'description',
        'total_packages',
        'packages_delivered',
        'gross_wt',
        'net_wt',
        'bl_no',
        'truck_no',
        'remarks',
        'consignee',
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
        dd('test');
        return $this->hasOne(Consignment::class, 'consignment_id');
    }


   
}
