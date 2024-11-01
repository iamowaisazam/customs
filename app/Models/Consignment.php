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
        'job_number',
        'job_number_prefix',
        'customer_id',
        'exporter_id',
        'invoice_value',
        'total_quantity',
        'currency',
        'blawbno',
        'lcbtitno',
        'description',
        'machine_number',
        'job_date',
        'your_ref',
        'port',
        'port_of_shippment',
        'eiffino',
        'import_exporter_messers',
        'freight',
        'ins_rs',
        'us',
        'lc_no',
        'lc_date',
        'igm_date',
        'bl_awb_date',
        'landing_charges',
        'package_type',
        'no_of_packages',
        'index_no',
        'consignment_date',
        'vessel',
        'igmno',
        'country_origion',
        'rate_of_exchange',
        'master_agent',
        'other_agent_agent',
        'due_date',
        'gross',
        'nett',
        'documents',
        'status',
        'created_by',
        'created_at',
        'updated_at',
    ];

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

    
    public function exporter()
    {
        return $this->belongsTo(Exporter::class, 'exporter_id');
    }


    


   
}
