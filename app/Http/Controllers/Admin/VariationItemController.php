<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Value;
use App\Models\Attribute;
use App\Models\Variation;
use App\Models\Product;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Carbon\Carbon;
use Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\URL;
use Illuminate\Validation\Rule;
use Laravel\Ui\Presets\React;

class VariationItemController extends Controller
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
     * @return void
     */
    public function index(Request $request,$id)
    {

        $value = Value::find(Crypt::decryptString($id));
        $variation= Attribute::find(crypt::decryptString($id));
        if($value == false){
            return back()->with('warning','Record Not Found');
        };

        $pageItems = Value::where('attribute_id',$value->id)
        ->get();

    
        return view('admin.variations.variation-items.index',compact('value','pageItems','variation')); 

    }

    


   /**
     * Create a new controller instance.
     * @return void
     */
    public function store(Request $request)
    {
        // dd($request);
        Value::create([
            "attribute_id" => $request->Attribute_id,
            "title" => $request->title,
        ]);

        return back()->with('success','Record Created Success');
    }


    /**
     * Create a new controller instance.
     * @return void
     */
    public function edit(Request $request,$id)
    {
        $id = Crypt::decryptString($id);
        $model = Value::where('id',$id)->first();
        if($model == false){
            return back()->with('warning','Record Not Found');
        }

        // dd($model->menu);

        // $dropdowns = MenuItem::get_menu_drop_down($model->menu_id,$model->parent_id,$id);
        return view('admin.variations.variation-items.edit',compact('model')); 

    }
    

    /**
     * Create a new controller instance.
     * @return void
     */
    public function update(Request $request,$id)
    {

       $id = Crypt::decryptString($id); 
       $model = Value::where('id',$id)->first();

       $model->update([
            "title" => $request->title,
        ]);

    
        return redirect('/admin/variations_items/'.Crypt::encryptString($model->attribute_id).'/index')
        ->with('success','Record Created Success'); 

      

    }



    /**
     * Create a new controller instance.
     * @return void
     */
    public function delete($id)
    {
        $decryptedId = Crypt::decryptString($id);
        $data = Value::find($decryptedId);
        $variation = Variation::idExists($decryptedId);

        if ($variation) {
            $product = Product::find($variation->product_id);
            return back()->with('warning', 'You can\'t delete it because it\'s used in the product ' . $product->title);
        } else {
            if (!$data) {
                return back()->with('warning', 'Record Not Found');
            } else {
                $data->delete();
                return back()->with('success', 'Record Deleted Successfully');
            }
        }
    }

}
