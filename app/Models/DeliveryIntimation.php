<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class DeliveryIntimation extends Model
{
    protected $table = 'delivery_intimations';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'message',
        'person_name',
        'challan_id',
        'status',
        'created_by',
        'created_at',
        'updated_at',
    ];

    public function challan()
    {
        return $this->belongsTo(Challan::class, 'challan_id');
    }

  
}
