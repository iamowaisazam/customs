<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class ConsignmentItem extends Model
{

    protected $table = 'consignments_items';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'product_id',
        'consignment_id',
        'name',
        'description',
        'price',
        'qty',
        'unit',
        'total',
        'status',
        'created_at',
        'updated_at',
    ];


    


   
}
