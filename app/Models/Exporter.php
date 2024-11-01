<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Exporter extends Model
{
    protected $table = 'exporters';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'company_name',
        'name',
        'email',
        'phone',
        'country',
        'state',
        'city',
        'postal_code',
        'street_address',
        'status',
        'created_by',
        'created_at',
        'updated_at',
    ];

    public function consigment()
    {
        return $this->belongsTo(User::class, 'exporter_id');
    }


   
}
