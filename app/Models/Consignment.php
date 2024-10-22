<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Consignment extends Model
{

    protected $table = 'consignments';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'job_number_prefix',
        'job_number',
        'customer_id',
        'blawbno',
        'lcbtitno',
        'description',
        'invoice_value',
        'currency',
        'demands_received',
        'machine_number',
        'documents',
        'job_date',
        'your_ref',
        'port',
        'eiffino',
        'import_exporter_messers',
        'consignee_by_to',
        'freight',
        'ins_rs',
        'us',
        'lc_no',
        'consignment_date',
        'vessel',
        'igmno',
        'port_of_shippment',
        'country_origion',
        'rate_of_exchange',
        'master_agent',
        'due_date',
        'gross',
        'nett',
        'status',
        
        'created_by',
        'created_at',
        'updated_at',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }


   
}
