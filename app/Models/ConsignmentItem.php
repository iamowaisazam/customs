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
        'id',
        'consignment_id',
        'name',
        'hs_code',
        'price',
        'qty',
        'unit',
        'total',
        'status',
        'custom_duty',
        'a_custom_duty',
        'rd',
        'it',
        'saletax',
        'a_saletax',
        'after_duties',
        'created_at',
        'updated_at'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }


    


   
}
