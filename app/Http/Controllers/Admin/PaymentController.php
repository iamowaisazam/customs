<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Collection;
use App\Models\Page;
use App\Models\Product;
use App\Models\ProductCollection;
use App\Models\Slider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\PaymentMethod;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Carbon\Carbon;
use Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\URL;
use Illuminate\Validation\Rule;
use Laravel\Ui\Presets\React;

class PaymentController extends Controller
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
    public function index(Request $request)
    {

        if($request->ajax()){

            $query = PaymentMethod::Query();
            //Search
            $search = $request->get('search')['value'];
            
            if($search != ""){
               $query = $query->where(function ($s) use($search) {
                   $s->where('PaymentMethods.title','like','%'.$search.'%');
               });
            }
            $query = $query->orderBy('id', 'desc');
            $count = $query->get();

            $records = $query->skip($request->start)
            ->take($request->length)
            ->get();
            
            $data = [];
            foreach ($records as $key => $value) {

                $action = '<div class="btn-group">';
                $action .= '<a class="btn btn-info" href="'.URL::to('admin/payment/edit/'.Crypt::encryptString($value->id)).'">Edit</a>';
                $action .= '<a class="btn btn-danger" href="'.URL::to('admin/payment/delete/'.Crypt::encryptString($value->id)).'">Delete</a>';

                $action .= '</div>';
                // $img = $value->image ? asset('public/'.$value->image->path) : '';

                array_push($data,[
                    $value->id,
                    $value->title,
                    $value->message,
                    $action,
                 ]
                );       
            }

            return response()->json([
                "draw" => $request->draw,
                "recordsTotal" => count($count),
                "recordsFiltered" => count($count),
                'data'=> $data,
            ]);
        }
              
        return view('admin.payment.index');
    }


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function create()
    {
        return view('admin.payment.create');
    }


    /**
     * Create a new controller instance.
     * @return void
     */
    public function store(Request $request)
    {

        // dd($request->all());

        $validator = Validator::make($request->all(),[
            "title" => 'required|max:255',
            'slug' => [ 'required','max:255',Rule::unique('pages')],
            "shortdetails" => 'max:500',
        ]);

        if($validator->fails()){
            return back()
            ->withErrors($validator)
            ->withInput();
        }
        
        PaymentMethod::create([
            'title' => $request->title,
            "slug" => $request->slug,
            "message" => $request->shortdetails,
        ]);

        return redirect('/admin/payment/index')->with('success','Record Created Success'); 

    }

   

     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function edit(Request $request,$id)
    {
        
        $id = Crypt::decryptString($id);
        $model = PaymentMethod::find($id);
        if($model == false){  
            return back()->with('error','Record Not Found');
         }

        return view('admin.payment.edit',compact('model'));

    }


     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function update(Request $request,$id)
    {    

        $id = Crypt::decryptString($id);
        $validator = Validator::make($request->all(),[
            "title" => 'required|max:255',
            'slug' => [ 'required','max:255',Rule::unique('pages')->ignore($id)],
            "shortdetails" => 'max:500',
        ]);

        if($validator->fails()){
            return back()
            ->withErrors($validator)
            ->withInput();
        }
        
      
        $model = PaymentMethod::find($id);
        if($model == false){  
           return back()->with('error','Record Not Found');
        }
        $model->title  = $request->title;
        $model->slug  = $request->slug;
        $model->message =   $request->shortdetails;

        $model->save();

        return redirect('/admin/payment/index')->with('success','Record Updated');

    }


     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function delete($id)
    {

        $data = PaymentMethod::find(Crypt::decryptString($id));
        PaymentMethod::where('id',$data->id)->delete();
        
        if($data == false){
            return back()->with('warning','Record Not Found');
        }else{
            $data->delete();
            return redirect('/admin/payment/index')->with('success','Record Deleted Success'); 
        }

    }

    


    
}
