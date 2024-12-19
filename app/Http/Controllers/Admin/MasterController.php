<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;

class MasterController extends Controller
{


    //
    public function locations(Request $request)
    {

        if(request()->isMethod('post')) {   
            Setting::where('field','locations')->update(['value' => json_encode($request->locations)]);
            return back()->with('success','Record Updated');
        }

        $data = [
            'data' => Setting::pluck('value','field')->toArray()
        ];
        return view('admin.masters.locations',$data);
    }

    public function pol(Request $request)
    {

        if(request()->isMethod('post')) {   
            Setting::where('field','pol')->update(['value' => json_encode($request->pol)]);
            return back()->with('success','Record Updated');
        }

        $data = [
            'data' => Setting::pluck('value','field')->toArray()
        ];
        return view('admin.masters.pol',$data);
    }

    public function pod(Request $request)
    {

        if(request()->isMethod('post')) {   
            Setting::where('field','pod')->update(['value' => json_encode($request->pod)]);
            return back()->with('success','Record Updated');
        }

        $data = [
            'data' => Setting::pluck('value','field')->toArray()
        ];
        return view('admin.masters.pod',$data);
    }



}
