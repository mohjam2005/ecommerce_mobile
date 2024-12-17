<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Notification;
use App\Notifications\StatusNotification;
use App\User;
use Illuminate\Support\Facades\Validator;
use App\Models\ProductReview;
class ProductReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reviews=ProductReview::getAllReview();
        
        return view('backend.review.index')->with('reviews',$reviews);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        $validator  = Validator::make($request->all(), [
           'rate'=>'required|numeric|min:1',
            'slug'=>'required',
       ],[
           
       ]);
       if($validator ->fails()){
           return response()->json([
               'status'=>false,
               'message'=>$validator->errors(),
               'code'=>422
           ]);


        }
        $product_info=Product::getProductBySlug($request->slug);
         //  return $product_info;
        // return $request->all();
        $data=$request->all();
        $data['product_id']=$product_info->id;
        $data['user_id']=$request->user()->id;
        $data['status']='active';
        $data['review']=$request->review;
         $status=ProductReview::create($data);
        ///////////send notifcation for admin////
        ///vendor_id from product ////

        $user=User::where('id',$product_info->vendor_id)->first();
        $details=[
            'title'=>'New Product Rating!',
            'actionURL'=>route('product-detail',$product_info->slug),
            'fas'=>'fa-star'
        ];
        Notification::send($user,new StatusNotification($details));
        if($status){
            return response()->json([
                'status'=>true,
                'message'=>'Successful create',
                'code'=>200,
             ]);
            
            }
        else{
            return response()->json([
                'status'=>false,
                'message'=>'user not exist',
                'code'=>422
            ]);
        
        }
        // return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
 
        $review=ProductReview::find($id);
        // return $review;
        return response()->json([
            'status'=>true,
            'code'=>200,
            'data'=>$review,
 
        ]);

     }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
         $review=ProductReview::find($id);
         if($review){
            // $product_info=Product::getProductBySlug($request->slug);
            //  return $product_info;
            // return $request->all();
            $data=$request->all();
            $status=$review->fill($data)->update();

            // $user=User::where('role','admin')->get();
            // return $user;
            // $details=[
            //     'title'=>'Update Product Rating!',
            //     'actionURL'=>route('product-detail',$product_info->id),
            //     'fas'=>'fa-star'
            // ];
            // Notification::send($user,new StatusNotification($details));
            if($status){

                return response()->json([
                    'status'=>true,
                    'code'=>200,
                    'data'=>'successfully updated'
                ]);
            }
            else{
                return response()->json([
                    'status'=>false,
                    'code'=>200,
                    'data'=>'fail updated'
                ]);
 
            }
        }
        else{
            return response()->json([
                'status'=>false,
                'code'=>200,
                'data'=>'review not exist'
            ]);
        
        }

        return redirect()->route('review.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $review=ProductReview::find($id);
        $status=$review->delete();
        if($status){
            request()->session()->flash('success','Successfully deleted review');
        }
        else{
            request()->session()->flash('error','Something went wrong! Try again');
        }
        return redirect()->route('review.index');
    }
}