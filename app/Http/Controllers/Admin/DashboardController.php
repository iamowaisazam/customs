<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Filemanager;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\Collection;
use App\Models\Category;
use App\Models\Product;

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
        $totalOrder = Order::count();
        $totalCollection = Collection::count();
        $totalCategory = Category::count();
        $totalProduct = Product::count();
        
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


     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function update_file_url(Request $request)
    {
        $files = Filemanager::all();
        foreach ($files as $key => $file) {
            $file->preview = asset($file->path);
            $file->save();
        }
        
    }



    

   


    
}
