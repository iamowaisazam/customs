<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Consignment extends Model
{

    protected $table = 'consignments';

    /**
     * The attributes that are mass assignable.
     * @var array<int, string>
     */

    protected $guarded = [];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function Items()
    {
        return $this->hasMany(ConsignmentItem::class, 'consignment_id');
    }

    public function challan()
    {
        return $this->hasOne(Challan::class, 'consignment_id');
    }

  

}
