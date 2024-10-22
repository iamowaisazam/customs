<?php

namespace App\Utilities;

use App\Models\Consignment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;


class ConsigmentUtility 
{

    
static public function get_job_number(){

    $Consignment = Consignment::select(['id','job_number','job_number_prefix'])
    ->orderBy('job_number','desc')->first();

    if($Consignment){
        $maxJobNumber = $Consignment->job_number + 1;
        return $maxJobNumber;
    }else{
        return '1';
    }   

}

static public function get_job_number_with_prefix(){

    $Consignment = Consignment::select(['id','job_number','job_number_prefix'])
    ->orderBy('job_number','desc')->first();

    if($Consignment){
        
        $maxJobNumber = $Consignment->job_number + 1;
        return $maxJobNumber.'/34-24';

    }else{
        return '1'.'/34-24';
    }   

}



}