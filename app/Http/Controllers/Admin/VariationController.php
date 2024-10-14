<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Attribute;
use App\Models\MenuItem;
use App\Models\Slider;
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

class VariationController extends Controller
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

            $query = Attribute::Query();

            //Search
            $search = $request->get('search')['value'];
            if($search != ""){
               $query = $query->where(function ($s) use($search) {
                   $s->where('Attributes.title','like','%'.$search.'%');
               });
            }

            $count = $query->get();

            $records = $query->skip($request->start)
            ->take($request->length)
            ->get();
            
            $data = [];
            foreach ($records as $key => $value) {
                $is_enable = $value->is_enable ? 'checked' : '';

                $action = '<div class="btn-group">';
                $action .= '<a class="btn btn-info" href="'.URL::to('admin/variations/edit/'.Crypt::encryptString($value->id)).'">Edit</a>';

                // $action .= '<a class="btn btn-warning" href="'.URL::to('admin/menus_items/sort/'.Crypt::encryptString($value->id)).'">Sort</a>';

                $action .= '<a class="btn btn-success" href="'.URL::to('admin/variations_items/'.Crypt::encryptString($value->id).'/index').'">Items</a>';

                // $action .= '<a class="btn btn-danger" href="'.URL::to('admin/menus/delete/'.Crypt::encryptString($value->id)).'">Delete</a>';

                $action .= '</div>';
                
                array_push($data,[
                    $value->id,
                    $value->title,
                    '<div class="switchery-demo m-b-30">
                    <input data-id="'.Crypt::encryptString($value->id).'" '.$is_enable.' type="checkbox"  class="is_enable js-switch" data-color="#009efb"/></div>',
                   
                    $action
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
              
        return view('admin.variations.index');
    }


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function create()
    {
        return view('admin.variations.create');
    }


    /**
     * Create a new controller instance.
     * @return void
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(),[
            "title" => 'required|max:255',
        ]);

        if($validator->fails()){
            return back()
            ->withErrors($validator)
            ->withInput();
        }
        
        Attribute::create([
            'title' => $request->title,
        ]);

        return redirect('/admin/variations/index')->with('success','Record Created Success'); 

    }

   

     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function edit(Request $request,$id)
    {
        
        $id = Crypt::decryptString($id);
        $model = Attribute::find($id);
        if($model == false){  
            return back()->with('error','Record Not Found');
         }

        return view('admin.variations.edit',compact('model'));
    }


     /**
     * Create a new controller instance.
     * @return void
     */
    public function update(Request $request,$id)
    {    
        $id = Crypt::decryptString($id);
        $validator = Validator::make($request->all(),[
            "title" => 'required|max:255',
        ]);

        if($validator->fails()){
            return back()
            ->withErrors($validator)
            ->withInput();
        }

        $model = Attribute::find($id);
        if($model == false){  
           return back()->with('error','Record Not Found');
        }

        $model->title  = $request->title;
        $model->save();

        return redirect('/admin/variations/index')->with('success','Record Updated');

    }


     /**
     * Create a new controller instance.
     * @return void
     */
    public function delete($id)
    {

        $data = Menu::find(Crypt::decryptString($id));
        if($data == false){
            return back()->with('warning','Record Not Found');
        }else{
            $data->delete();
            return redirect('/admin/menus/index')->with('success','Record Deleted Success'); 
        }

    }



}
