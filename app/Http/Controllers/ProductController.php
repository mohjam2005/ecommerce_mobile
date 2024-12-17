<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\ProductVariant;
use App\Models\ProductImage;
use Storage;


use Auth;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Retrieve product with its color and size variants
        $product = Product::with('variants','product_images')
      
        ->withAvg('getReview', 'rate') // Calculates average rating
        ->with('likes') // Optionally load likes
        ->findOrFail($id);

 

        return response()->json($product);
    }

    public function getProductsWithRatings()
    {
        // Get products with average rating, ordering as desired
        $products = Product::withAvg('getReview', 'rate') // Calculates average rating
             ->paginate(10); // Optional: Paginate results

        return response()->json($products);
    }

    public function productSearch(Request $request){
 
        $products=Product::with('likes')->orwhere('title','like','%'.$request->search.'%')
                    ->orwhere('slug','like','%'.$request->search.'%')
                    ->orwhere('description','like','%'.$request->search.'%')
                    ->orwhere('summary','like','%'.$request->search.'%')
                    ->orwhere('price','like','%'.$request->search.'%')
                    ->orderBy('id','DESC')
                    ->paginate('9')->map(function ($product) {
                        $product->is_liked = $product->is_liked; // Adds the is_liked attribute
                        return $product;
                    });

                return response()->json($products);
     }

    public function likeProduct(Product $product)
    {
        $user = auth()->user();
        if($user->followedBranches==null){
            $user->likedProducts()->attach($product->id);
            return response()->json(['message' => 'Product liked'], 200);
        }
        else{
            if (!$user->likedProducts->contains($product->id)) {
                $user->likedProducts()->attach($product->id);
                return response()->json(['message' => 'Product liked'], 200);
            }
    
            return response()->json(['message' => 'Already liked'], 400);

        }
      
    }

    // Unlike a product
    public function unlikeProduct(Product $product)
    {
        $user = auth()->user();
        $user->likedProducts()->detach($product->id);
        return response()->json(['message' => 'Product unliked'], 200);
    }


    public function productLike(){
        $products = Product::with('likes') // Optionally load likes
        ->get()
        ->map(function ($product) {
            $product->is_liked = $product->is_liked; // Adds the is_liked attribute
            return $product;
        });

    return response()->json($products);

    }

     // Most Sold Products
     public function mostSold(Request $request)
     {
        $vendor = $request->vendor;

        $products = Product::where('vendor_id', $vendor)
            ->with('likes') // Optionally load likes
            ->mostSold()
            ->withAvg('getReview', 'rate') // Calculates average rating
            ->paginate(20);
        
        // Use `map` only on the items within the paginated collection
        $products->getCollection()->transform(function ($product) {
            $product->is_liked = $product->is_liked; // Adds the is_liked attribute
            return $product;
        });
        
        return response()->json($products);
     }
 
     // New Products
     public function newProducts(Request $request)
     {
        $vendor = $request->vendor;

            $products = Product::where('vendor_id', $vendor)
                ->with('likes') // Optionally load likes
                ->newProducts()
                ->withAvg('getReview', 'rate') // Calculates average rating
                ->latest()
                ->paginate(20);

            // Use `map` only on the items within the paginated collection
            $products->getCollection()->transform(function ($product) {
                $product->is_liked = $product->is_liked; // Adds the is_liked attribute
                return $product;
            });

            return response()->json($products);

       

      
     }
 
     // Discounted Products
     public function discountedProducts(Request $request)
     {
        $vendor = $request->vendor;

        $products = Product::where('vendor_id', $vendor)
            ->with('likes') // Optionally load likes
            ->discounted() 
            ->withAvg('getReview', 'rate') // Calculates average rating
            ->latest()
            ->paginate(20);

        // Use `map` only on the items within the paginated collection
        $products->getCollection()->transform(function ($product) {
            $product->is_liked = $product->is_liked; // Adds the is_liked attribute
            return $product;
        });

        return response()->json($products);

     
        
     }

    public function index()
    {
        $products=Product::getAllProduct();
        // return $products;
        return view('backend.product.index')->with('products',$products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brand=Brand::where('vendor_id',Auth::user()->branch_id)->get();
        $category=Category::where('is_parent',1)->where('vendor_id',Auth::user()->branch_id)->get();
        // return $category;
        return view('backend.product.create')->with('categories',$category)->with('brands',$brand);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function ImageUpload( $product_id ,$file){
        $product=Product::find($product_id);
        $allowed_extensions = ['jpeg',"JPEG",
        'png','PNG','jpg',"JPG","gif","GIF",'jfif']; // must be an array. Extensions disallowed to be uploaded
            $hidden_extensions = ['php'];
              $extension = \File::extension($file->getClientOriginalName());

         
            if(in_array($extension,$allowed_extensions)){

                         $direction = 'store';
                        $filename = saveBase64Image($image,$direction);
                        $file=$image;
                        $imageName = $image->getClientOriginalName();
                        $image->move(public_path('Attachments/'), $imageName);
                       
                        $product->product_images()->create([
                            'image' => $imageName,
                            'product_id'=>$product_id
                        ]);
                    }
                

   
            
            else{
                $upload_success=false;
            }


            if( $upload_success ) {
                return response()->json(
                    ['status'=>true,'code'=>200,'message'=>'Upload Successful']
                );

                // $data=['success'=>true,'imageObject'=>$create,'name'=>$filename,'path'=>asset('/setting_image/'.$filename),'real_name'=>$file->getClientOriginalName(),'type'=>$request->type];
                // return $data;
            }
            else {
                return \Response::json('error', 400);
            }
    
       


     
    }
    public function store(Request $request)
    {
        // return $request->all();
        $validator = Validator::make($request->all(), [
            'title' => 'string|required',
            'summary' => 'string|required',
            'description' => 'string|nullable',
            // 'photo' => 'required',
            'size' => 'nullable',
            'stock' => 'required|numeric',
            'cat_id' => 'required|exists:categories,id',
            'is_featured' => 'sometimes|in:1',
            'status' => 'required|in:active,inactive',
            'condition' => 'required|in:default,new,hot',
            'price' => 'required|numeric',
            'discount' => 'nullable|numeric'
        ]);
        
        if ($validator->fails()) {
            // return response()->json([
            //     'errors' => $validator->errors(),
            // ], 422);
        }
         // $this->validate($request,[
        //     'title'=>'string|required',
        //     'summary'=>'string|required',
        //     'description'=>'string|nullable',
        //      'photo'=>'required',
        //     'size'=>'nullable',
        //     'stock'=>"required|numeric",
        //     'cat_id'=>'required|exists:categories,id',
        //     // 'brand_id'=>'nullable|exists:brands,id',
        //     // 'child_cat_id'=>'nullable|exists:categories,id',
        //     'is_featured'=>'sometimes|in:1',
        //     'status'=>'required|in:active,inactive',
        //     'condition'=>'required|in:default,new,hot',
        //     'price'=>'required|numeric',
        //     'discount'=>'nullable|numeric'
        // ]);
        // dd($request);

        $data=$request->all();
        $slug=Str::slug($request->title);
        $count=Product::where('slug',$slug)->count();
        if($count>0){
            $slug=$slug.'-'.date('ymdis').'-'.rand(0,999);
        }
        $data['slug']=$slug;
        $data['is_featured']=$request->input('is_featured',0);
        $size=$request->input('size');
        if($size){
            $data['size']=implode(',',$size);
        }
        else{
            $data['size']='';
        }
        // return $size;
        // return $data;
        $image = $request->file('pic');
        if($image){
            $data['photo']=ShippingController::uploadImage($image);

        }
       
        $data['vendor_id']=Auth::user()->branch_id;

        $status=Product::create($data);
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('image', 'public');
                $status->product_images()->create(['image' => $path]);
            }
        }

        // $imageArray= $request->pics;
        //  if($imageArray){
        //     foreach ($imageArray as $image){

        //     $this->ImageUpload( $status->id ,$image);

        //     }

        // }
        $variants=$request->variants;
        //  // Add variants
        //  $variants = [
        //     ['color' => 'Red', 'size' => 'M', 'price' => 20.00, 'stock' => 10],
        //     ['color' => 'Blue', 'size' => 'L', 'price' => 22.00, 'stock' => 5],
        //     // Add more variants as needed
        // ];

        $status->variants()->createMany($variants);

        if($status){
            request()->session()->flash('success','Product Successfully added');
        }
        else{
            request()->session()->flash('error','Please try again!!');
        }
        return redirect()->route('product.index');

    }

    public function updateVariants(Request $request, $productId)
    {
        // Validate the request
        $validated = $request->validate([
            'variants' => 'required|array',
            'variants.*.id' => 'nullable|exists:product_variants,id',
            'variants.*.color' => 'required|string',
            'variants.*.size' => 'required|string',
            // 'variants.*.price' => 'required|numeric',
            // 'variants.*.stock' => 'required|integer',
        ]);

        // Find the product
        $product = Product::findOrFail($productId);

        foreach ($validated['variants'] as $variantData) {
            if (isset($variantData['id'])) {
                // Update existing variant
                $variant = ProductVariant::findOrFail($variantData['id']);
                $variant->update($variantData);
            } else {
                // Create a new variant
                $product->variants()->create($variantData);
            }
        }

        return response()->json([
            'message' => 'Variants updated successfully.',
            'product' => $product->load('variants'),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $brand=Brand::where('vendor_id',Auth::user()->branch_id)->get();
        $product=Product::with('variants')->findOrFail($id);
        $category=Category::where('vendor_id',Auth::user()->branch_id)->where('is_parent',1)->get();
        $items=Product::where('id',$id)->get();
        // return $items;
        return view('backend.product.edit')->with('product',$product)
                    ->with('brands',$brand)
                    ->with('categories',$category)->with('items',$items);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product=Product::findOrFail($id);
        $this->validate($request,[
            'title'=>'string|required',
            'summary'=>'string|required',
            'description'=>'string|nullable',
            // 'photo'=>'string|required',
            'size'=>'nullable',
            'stock'=>"required|numeric",
            'cat_id'=>'required|exists:categories,id',
            'child_cat_id'=>'nullable|exists:categories,id',
            'is_featured'=>'sometimes|in:1',
            'brand_id'=>'nullable|exists:brands,id',
            'status'=>'required|in:active,inactive',
            'condition'=>'required|in:default,new,hot',
            'price'=>'required|numeric',
            'discount'=>'nullable|numeric'
        ]);

        $data=$request->all();
        $data['is_featured']=$request->input('is_featured',0);
        $size=$request->input('size');
        if($size){
            $data['size']=implode(',',$size);
        }
        else{
            $data['size']='';
        }
        // return $data;
        $image = $request->file('pic');
        if($image){
            $data['photo']=ShippingController::uploadImage($image);

        }
        $data['vendor_id']=Auth::user()->branch_id;

        $status=$product->fill($data)->save();
         // Delete selected images
            if ($request->has('delete_images')) {
                foreach ($request->delete_images as $imageId) {
                    $image = ProductImage::findOrFail($imageId);
                    Storage::disk('public')->delete($image->image);
                    $image->delete();
                }
            }

            // Handle new image uploads
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $path = $image->store('product_images', 'public');
                    $product->product_images()->create(['image' => $path]);
                }
            }

        // ProductVariant::where('product_id', $product->id)->delete();

            // Update variants (or pivot data)
            if ($request->has('variants')) {
                foreach ($request->variants as $variantId => $data) {
                    ProductVariant::where('id', $variantId)->update($data);
                }
            }
        if($status){
            request()->session()->flash('success','Product Successfully updated');
        }
        else{
            request()->session()->flash('error','Please try again!!');
        }
        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product=Product::findOrFail($id);
        $status=$product->delete();
        
        if($status){
            request()->session()->flash('success','Product successfully deleted');
        }
        else{
            request()->session()->flash('error','Error while deleting product');
        }
        return redirect()->route('product.index');
    }
}
