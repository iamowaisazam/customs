<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\StoreCategory;
use App\Models\Store;
use Carbon\Carbon;
use Auth;
use Illuminate\Support\Facades\Crypt;


class SettingController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

 
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function edit(Request $request)
    // {
    //     $group = $request->group;
    //     $data = Setting::where('grouping',$request->group)->orderBy('section_sorting')->get();
    //     $data = $data->groupBy('section');

        

    //     return view('admin.settings.edit',compact('data','group'));
    // }
    public function edit(Request $request)
    {
        $group = $request->group;
        $settings = Setting::where('grouping', $group)
            ->orderBy('section_sorting')
            ->get();
    
        $data = $settings->groupBy('section')->map(function ($section) {
            return $section->pluck('value', 'field')->toArray();
        });
    
        if ($data->isEmpty()) {
            return redirect()->back()->with('error', 'No settings found for this group.');
        }
    return view('admin.settings.'.$group,compact('data', 'group'));
    
    
    }


     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function update(Request $request)
    {
        
        foreach ($request->all() as $key => $value) {
            if(isset($value['value'])){
                if(in_array($value['type'],['text','textarea','keywords','image'])){
                     Setting::where('field',$key)->update(["value" => $value['value']]);
                }       
            }
        }
        return back()->with('success','Record Updated');
        
    }
  
}