<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
        // Explicitly specify the table name
        protected $table = 'order_status'; // Adjust the table name as per your database
    
        protected $fillable = [
            'name',
            'is_enable',
        ];

    // Define relationships if needed
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}