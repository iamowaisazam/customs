<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Attribute;
use App\Models\Collection;
use App\Models\ProductCollection;
use App\Models\Variation;
use App\Models\VariationAttribute;
use App\Models\Role;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Carbon\Carbon;
use Auth;
use Collator;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\URL;
use Illuminate\Validation\Rule;
use Laravel\Ui\Presets\React;

class ProductController extends Controller
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
    public function index(Request $request)
    {

        $categoryDropdown = Category::get_category_dropdown();


        if($request->ajax()){

            $query = Product::Query();

    
            $search = $request->get('search')['value'];
            if($search != ""){
               $query = $query->where(function ($s) use($search) {
                   $s->where('products.title','like','%'.$search.'%')
                   ->orwhere('products.slug','like','%'.$search.'%')
                   ->orwhere('products.description','like','%'.$search.'%');
               });
            }

            if($request->has('category_id') && $request->category_id != '' ){
                $query->where('category_id',$request->category_id);
            }

            if($request->has('is_enable') && $request->is_enable != ''){
                $query->where('is_enable',$request->is_enable);
            }

            if($request->has('is_featured') &&  $request->is_featured != ''){
                $query->where('is_featured',$request->is_featured);
            }



            $count = $query->get();

            $records = $query->skip($request->start)
            ->take($request->length)->orderBy('id','desc')
            ->get();
            
            $data = [];
            foreach ($records as $key => $value) {

                $is_enable = $value->is_enable ? 'checked' : '';
                $is_featured = $value->is_featured ? 'checked' : '';

                $action = '<div class="btn-group">';

                $action .= '<a class="btn btn-info" href="'.URL::to('admin/products/edit/'.Crypt::encryptString($value->id)).'">Edit</a>';
                $action .= '<a class="btn btn-danger" href="'.URL::to('admin/products/delete/'.Crypt::encryptString($value->id)).'">Delete</a>';

                $action .= '</div>';

                $thumb_path = $value->image ? $value->image : ''; 
                $img = '<img  style="width:100px;height:50px" src="'.asset($thumb_path).'" />';

                array_push($data,[
                    $action,
                    '<input data-id="'.Crypt::encryptString($value->id).'" '.$is_enable.' type="checkbox"  class="is_enable " data-color="#009efb"/>',
                    '<input data-id="'.Crypt::encryptString($value->id).'" '.$is_featured.' type="checkbox"  class="is_featured" data-color="#009efb"/>',
                    $value->id,
                    $value->get_category() ? $value->get_category()->title : '-',
                    $img,
                    $value->title,
                    $value->slug,
                    $value->price,
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
        

        $categories = Category::all();
        
        
        return view('admin.products.index',compact('categories','categoryDropdown'));
    }

    


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function create()
    {

        $categories = Category::all();

        return view('admin.products.create',compact('categories'));
    }


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            "title" => 'required|max:255',
            'slug' => [ 'required','max:255',Rule::unique('products'),
            ],
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $product = Product::create([
            'title' => $request->title,
            'slug' => $request->slug,
            'is_enable' => 0,
        ]);

        return redirect('/admin/products/edit/'.Crypt::encryptString($product->id))->with('success','Record Created Success'); 
    }

   

     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function edit(Request $request, $id)
    {
        $id = Crypt::decryptString($id);
        $product = Product::find($id);
        if (!$product) {  
            return back()->with('error', 'Record Not Found');
        }
    
        // Convert images string to an array
        $productImages = explode(',', $product->images);
    
        $categories = Category::all();
        $brands = Brand::all();
        $attributes = Attribute::with('values')->get();
        $collections = Collection::where('is_enable', 1)->get();
    
        return view('admin.products.edit', compact('product', 'productImages', 'categories', 'brands', 'attributes', 'collections'));
    }

    function generateAttributeCombinations($attributes) {
        $result = [[]]; // Initialize with an empty combination
    
        foreach ($attributes as $attribute) {
            $currentResult = [];
    
            foreach ($result as $item) {
                foreach ($attribute['values'] as $value) {
                    $currentResult[] = array_merge($item, [ $value]);
                }
            }
    
            $result = $currentResult;
        }
    
        return $result;
    }


     /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function update(Request $request,$id)
    // {

    //     // dd($request->all());

        
    //     $id = Crypt::decryptString($id);
    //     $validator = Validator::make($request->all(), [
    //         "title" => 'required|max:255',
    //         "details" => 'max:500',
    //         "description" => 'max:9000',
    //         "category_id" => 'integer',
    //         'meta_title' => 'max:255',
    //         'meta_description' => 'max:255',
    //         'meta_keywords' => 'max:255',
    //         'slug' => [
    //             'required',
    //             'max:255',
    //             Rule::unique('products')->ignore($id),
    //         ],
    //     ]);

    //     if ($validator->fails()) {
    //         return back()
    //             ->withErrors($validator)
    //             ->withInput();
    //     }

    //     $product = Product::find($id);
    //     if($product == false){  
    //        return back()->with('error','Record Not Found');
    //     }


    //     ProductCollection::where('product_id',$product->id)->delete();
    //     if($request->has('collections')){
    //         foreach ($request->collections as $collect) {
                
    //             ProductCollection::create([
    //                 'product_id' =>    $product->id,
    //                 'collection_id' => $collect,
    //             ]);

    //         }
    //     }


    //     if($request->has('gallery')){
    //         $new_images = $request->gallery;
    //         $product->images = implode(',',$new_images);
    //     }

    //     $product->title = $request->title;
    //     $product->slug = $request->slug;
    //     $product->details = $request->details;
    //     $product->description = $request->description;

    //     $product->category_id = $request->category_id;

    //     $product->meta_title = $request->meta_title;
    //     $product->meta_description = $request->meta_description;
    //     $product->meta_keywords = $request->meta_keywords;

    //     $product->image = $request->image;
    //     $product->hover_image = $request->hover_image;

    //     $product->selling_price = $request->selling_price;
    //     $product->price = $request->price;

    //     $product->sku = $request->sku;   
    //     $product->tags = $request->tags;
    //     $product->save();

    //     return back()->with('success','Record Updated');

    // }

    public function update(Request $request, $id)
    {
        $id = Crypt::decryptString($id); // Decrypt the ID if encrypted
        
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'slug' => [
                'required',
                'max:255',
                Rule::unique('products')->ignore($id),
            ],
            'details' => 'max:500',
            'description' => 'max:9000',
            'category_id' => 'integer',
            'meta_title' => 'max:255',
            'meta_description' => 'max:255',
            'meta_keywords' => 'max:255',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
    
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['error' => 'Record not found'], 404);
        }
    
        // Update product fields
        $product->title = $request->title;
        $product->slug = $request->slug;
        $product->details = $request->details;
        $product->description = $request->description;
        $product->category_id = $request->category_id;
        $product->meta_title = $request->meta_title;
        $product->meta_description = $request->meta_description;
        $product->meta_keywords = $request->meta_keywords;
        $product->selling_price = $request->selling_price;
        $product->price = $request->price;
        $product->sku = $request->sku;
        $product->tags = $request->tags;

        $product->image = $request->image;
        $product->hover_image = $request->hover_image;
    
        // Handle collections
        ProductCollection::where('product_id', $product->id)->delete();
        if ($request->has('collections')) {
            foreach ($request->collections as $collect) {
                ProductCollection::create([
                    'product_id' => $product->id,
                    'collection_id' => $collect,
                ]);
            }
        }
    
        // Handle gallery
        if ($request->has('gallery')) {
            $product->images = implode(',', $request->gallery);
        }
    
        $product->save();
    
        return response()->json(['success' => 'Record updated successfully'], 200);
    }
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function delete($id)
    {
        $product = Product::find(Crypt::decryptString($id));

        if($product == false){
            return back()->with('warning','Record Not Found');
        }else{
            ProductCollection::where('product_id',$product->id)->delete();
            $product->delete();
            return redirect('/admin/products/index')->with('success','Record Deleted Success'); 
        }

    }

    

        /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function remove_image(Request $request,$id)
    {
        $id = Crypt::decryptString($id);
        $product = Product::find($id);
        if($product == false){  
           return back()->with('error','Record Not Found');
        }

         $images = explode(',',$product->images); 
         $array_without_strawberries = array_diff($images, array($request->image));
         $product->images = implode(',',$array_without_strawberries);
         $product->save();
        return back()->with('success','Record Removed Success'); 

    }

    

    /**
     * Create a new controller instance.
     * @return void
     */
    public function variations(Request $request, $id)
    {
        $id = Crypt::decryptString($id);
        $product = Product::find($id);
    
        // Delete existing variations
        Variation::where('product_id', $id)->delete();
    
        // Generate new attribute combinations
        $values = $product->generateAttributeCombinations($request->attr);
    
        $variations = [];
    
        foreach ($values as $combination) {
            $sku = [];
            foreach ($combination as $item) {
                array_push($sku, $item['title']);
            }
    
            $ProductVariation = Variation::create([
                "product_id" => $id,
                "title" => implode('-', $sku),
                "sku" => implode('-', $sku),
                "value" => implode('-', $sku)
            ]);
    
            foreach ($combination as $item) {
                VariationAttribute::create([
                    "variation_id" => $ProductVariation->id,
                    "attribute_id" => $item['attribute_id'],
                    "value_id" => $item['id'],
                    "value" => $item['title'],
                ]);
            }
    
            $variations[] = $ProductVariation->load('attributes');
        }
    
        // Return the newly created variations as JSON
        return response()->json([
            'success' => true,
            'message' => 'Variations Generated Successfully',
        ]);
    }
    


    /**
     * Create a new controller instance.
     * @return void
     */
    // public function remove_variation(Request $request,$id)
    // {
    //     Variation::where('id',$id)->delete();
    //     // return back()->with('success','Remove Variation Successfully');
    //     return response()->json(['success' => true, 'message' => 'Variation removed successfully.']);

    // }
    public function remove_variation(Request $request, $id)
    {
        $variation = Variation::find($id);

        if ($variation) {
            $variation->delete();
            return response()->json(['success' => true, 'message' => 'Variation removed successfully.']);
        } else {
            \Log::warning('Variation not found.');
            return response()->json(['success' => false, 'message' => 'Variation not found.']);
        }
    }
    public function getvariations(Request $request, $id)
    
    {
        $id = Crypt::decryptString($id);
       
      
        $variations = Variation::where('product_id', $id)->with('attributes')->get();
    
        if ($variations->isNotEmpty()) {
            return response()->json([
                'success' => true,
                'message' => 'Variations found successfully',
                'variations' => $variations
            ]);
        } else {

            return response()->json(['success' => false, 'message' => 'Variations not found.']);
        }
    }
    
    public function variationsUpdate(Request $request,$id){
        $variations = $request->input('variations');

        foreach ($variations as $variationData) {
            $variation = Variation::find($variationData['id']);
            
            if ($variation) {
                $variation->quantity = $variationData['quantity'];
                $variation->price = $variationData['price'];
                $variation->image = $variationData['thumbnail'];
                $variation->save();
            }
        }
    
        return response()->json(['message' => 'Variations updated successfully']);

       
    }
}
