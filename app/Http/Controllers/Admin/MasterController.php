<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Models\Setting;

class MasterController extends Controller
{


    //
    public function index(Request $request){

        $data = [];        
        $field = $request->field;
        $res = Setting::where('field',$field)->first();
        if($res){

            $old_value =  $res->value  ? json_decode($res->value) : [];
            if(!is_array($old_value)){
                $old_value = [];
            }
            $data = $old_value;
        }else{
            $data = [];
        }

        
        return view('settings.'.$request->field,compact('data','field'));

    }

    public function store(Request $request){

        $field = $request->field;

        $res = Setting::where('field',$field)->first();
        if($res){

            $old_value =  $res->value  ? json_decode($res->value) : [];
            if(!is_array($old_value)){
                $old_value = [];
            }
            
            array_push($old_value,$request->data);
            Setting::where('field',$field)->update(['value' => json_encode($old_value)]);

        }else{
            Setting::create([
                'field' => $field,
                'value' => json_encode([$request->data]),
            ]);
        }

        return back();

    }





    








}
