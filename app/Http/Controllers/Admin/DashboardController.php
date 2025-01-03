<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Filemanager;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\Collection;
use App\Models\Category;
use App\Models\Consignment;
use App\Models\Customer;
use App\Models\Payorder;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
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
    public function dashboard()
    {

      

        $totalOrder = 1;
        $totalCollection = 1;
        $totalCategory = 1;
        $totalProduct = 1;
        
        return view('admin.dashboard',compact('totalOrder','totalCollection','totalCategory','totalProduct'));
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function changepassword()
    {
           
        return view('admin.changepassword');
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function changepassword_submit(Request $request)
    {
    
        $id = Auth::user()->id;
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users')->ignore($id),
            ],
            'password' => 'nullable|string|min:8|max:255',
        ]);
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->created_by = Auth::user()->id;
        $user->created_at = Carbon::now();

        if($request->password){
          $user->password =  Hash::make($request->password);
        }
        $user->save();
        return back()->with('success','Profile Updated');

    }


    /**
     * Create a new controller instance.
     * @return void
     */
    public function status(Request $request)
    {
        $request->validate([
            'table' => ['required','max:255',"regex:/^[a-zA-Z0-9\_]+$/"],
            'column' => ['required','max:255',"regex:/^[a-zA-Z0-9\_]+$/"],
            'value' => ['required','max:255',"regex:/^[a-zA-Z0-9\_]+$/"],
            'id' => ['required','max:500',"regex:/^[a-zA-Z0-9\_]+$/"],
        ]);

        $table = $request->table;
        $column = $request->column;
        $value = $request->value;
        $id = $request->id;

        // try {
            DB::update('UPDATE '.$table.' SET '.$column.' = ? WHERE id = ?', [$value,Crypt::decryptString($id)]);
            return response()->json([],200);
        // } catch (\Throwable $th) {
        //     return response()->json([],200);
        // }
    }


 

    // public function products(Request $request)
    // {

    //     $search = $request->input('search');
    //     $data = Product::where('name', 'LIKE', "%$search%")
    //                 ->orWhere('sku', 'LIKE', "%$search%")
    //                 ->limit(20)
    //                 ->get();
    //     $data = $data->map(function ($item) {
            
    //         return [
    //             'id' => $item->id,
    //             'text' => $item->name.'-'.$item->sku
    //         ];
    //     });


    //     return response()->json($data->all());
    // }

    public function jobnumber(Request $request)
    {

        $search = $request->input('search');
        $data = Consignment::Leftjoin('payorders','payorders.consignment_id','=','consignments.id')
        ->where('consignments.job_number_prefix', 'LIKE', "%$search%");

        if($request->type == 'payorder'){
            $data = $data->whereNull('payorders.consignment_id');
        }

        $data = $data->limit(20)
                    ->get([
                        'consignments.*',
                    ]);
        $data = $data->map(function ($item) {
            
            return [
                'id' => $item->job_number_prefix,
                'text' => $item->job_number_prefix,
            ];
        });

        return response()->json($data->all());
    }


    public function create_deliverychallan(Request $request)
    {

        $search = $request->input('search');
        $data = Payorder::Leftjoin('consignments','consignments.id','=','payorders.consignment_id')
        ->Leftjoin('delivery_challans','delivery_challans.payorder_id','=','payorders.id')
        ->where('consignments.job_number_prefix', 'LIKE', "%$search%")
        ->whereNull('delivery_challans.payorder_id')
        ->limit(20)
        ->get([
             'payorders.id as id',
             'consignments.job_number_prefix as text'
        ]);
        return response()->json($data);
    }

    public function create_deliveryintimation(Request $request)
    {

        $search = $request->input('search');
        $data = Payorder::Leftjoin('consignments','consignments.id','=','payorders.consignment_id')
        ->Leftjoin('delivery_intimations','delivery_intimations.payorder_id','=','payorders.id')
        ->where('consignments.job_number_prefix', 'LIKE', "%$search%")
        ->whereNull('delivery_intimations.payorder_id')
        ->limit(20)
        ->get([
             'payorders.id as id',
             'consignments.job_number_prefix as text'
        ]);
        return response()->json($data);
    }

    



    public function customer(Request $request)
    {
        $search = $request->input('search');
        $data = Customer::where('customer_name', 'LIKE', "%$search%")
        ->orWhere('company_name', 'LIKE', "%$search%")
                    ->limit(20)
                    ->get();
        $data = $data->map(function ($item) {
            return [
                'id' => $item->id,
                'text' => $item->customer_name,
            ];
        });
        return response()->json($data->all());
    }

    public function lc(Request $request)
    {
        $search = $request->input('search');
        $data = Consignment::where('lc', 'LIKE', "%$search%")
                    ->limit(20)
                    ->get();
        $data = $data->map(function ($item) {
            return [
                'id' => $item->lc,
                'text' => $item->lc,
            ];
        });
        return response()->json($data->all());
    }



    

   


    
}
