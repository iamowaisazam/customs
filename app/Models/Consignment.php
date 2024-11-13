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
        'exporter',
        'invoice_value',
        'total_quantity',
        'currency',
        'freight',
        'ins_rs',
        'insurance_in_fc',
        'rate_of_exchange',
        'blawbno',
        'ttno',
        'description',
        'machine_number',
        'job_date',
        'po_number',
        'port',
        'port_of_shippment',
        'mode_of_shipment',
        'eiffino',
        'lc_date',
        'igm_date',
        'bl_awb_date',
        'package_type',
        'no_of_packages',
        'index_no',
        'consignment_date',
        'vessel',
        'igmno',
        'shipment_number',
        'country_origion',
        'master_agent',
        'other_agent_agent',
        'due_date',
        'gross',
        'nett',
        'documents',
        'status',
        'created_by',
        'created_at',
        'updated_at'
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
