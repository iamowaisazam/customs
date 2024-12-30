<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class ConsignmentItem extends Model
{

    protected $table = 'consignments_items';

    /**
     * The attributes that are mass assignable.
     * @var array<int, string>
     */
    protected $guarded = [];

    public function calculate_payorder($consignment)
    {

        $frieght_rate = ($this->total / $consignment->invoice_value) * intval($consignment->freight);
              
        $value = $frieght_rate + $this->total;
        
        $rate_exchange = $consignment->rate_of_exchange * $value;
        
        $ins =  ($this->total / $consignment->invoice_value) * intval($consignment->insurance_in_pkr);

        $l = $rate_exchange + $ins;
        
        $landing_charges = ( $l / 100) * 1;

        $asset_value = $rate_exchange + $landing_charges + $ins; 
        
        $custom_duty =   ( $asset_value / 100) * $this->custom_duty;
        $a_custom_duty = ($asset_value / 100) * $this->a_custom_duty;
        $rd = ($asset_value / 100) * $this->rd;

        $saletax = $asset_value + $custom_duty + $a_custom_duty + $rd; 
        $saletax = ($saletax  / 100) * $this->saletax;

        $a_saletax = $asset_value + $custom_duty + $a_custom_duty + $rd;
        $a_saletax = ($a_saletax / 100) * $this->a_saletax;

        // if($custom_duty > 0 || $a_custom_duty > 0 || $rd > 0 || $saletax > 0 || $a_saletax){
            $it = $asset_value + $custom_duty + $a_custom_duty + $rd + $saletax + $a_saletax;
            $it = ($it / 100) * $this->it;
        // }else{
            // $it = 0;
        // }

        return [
           "frieght_rate" => $frieght_rate,
           "value" => $value,
           "rate_exchange" => $rate_exchange,
           "ins" => $ins,
           "l" => $l,
           "landing_charges" => $landing_charges,
           "asset_value" => $asset_value,
           "custom_duty" => $custom_duty,
           "a_custom_duty" => $a_custom_duty,
           "rd" => $rd,
           "saletax" => $saletax,
           "a_saletax" => $a_saletax,
           "it" => $it,
           "eto" => ($this->eto / 100) * $asset_value,
        ];

    }


    


   
}
