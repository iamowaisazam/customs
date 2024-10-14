<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Order extends Model
{
    protected $table = 'orders';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'customer_name',
        'customer_email',
        'customer_phone',
        'country',
        'city',
        'order_notes',
        'address',
        'subtotal',
        'delivery_charges',
        'payment_method',
        'payment_status',
        'order_status',
        'tracking_id',
        'sno',
        'grandtotal',
        'is_enable',
        'created_at',
        'updated_at',
        'customer_notes'
    ];

    public function children()
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }

    public function payment_methods()
    {
        return $this->belongsTo(PaymentMethod::class, 'payment_method');
    }




   
}
