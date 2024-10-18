<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Customer extends Model
{
    protected $table = 'customers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'user_id',
        'company_logo',
        'company_name',
        'customer_name',
        'customer_email',
        'customer_phone',
        'country',
        'state',
        'city',
        'postal_code',
        'street_address',
        'is_enable',
        'created_by',
        'created_at',
        'updated_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


   
}
