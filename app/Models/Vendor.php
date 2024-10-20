<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Vendor extends Model
{
    protected $table = 'vendors';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'user_id',
        'vendor_service',
        'vendor_name',
        'vendor_email',
        'vendor_phone',
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
