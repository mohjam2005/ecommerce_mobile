<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Wishlist;
class WishlistController extends Controller
{
    protected $product=null;
    public function __construct(Product $product){
         $this->product=$product;
    }

    public function wishlist(Request $request){
        // dd($request->all());
        if (empty($request->slug)) {
            
            return response()->json([
                'status'=>false,
                'message'=>'Invalid Products',
                'code'=>422
            ]);

        
        }        
        $product = Product::where('slug', $request->slug)->first();
        // return $product;
        if (empty($product)) {
            return response()->json([
                'status'=>false,
                'message'=>'Invalid Products',
                'code'=>422
            ]);
            
        }

        $already_wishlist = Wishlist::where('user_id', auth()->user()->id)->where('cart_id',null)->where('product_id', $product->id)->first();
        // return $already_wishlist;
        if($already_wishlist) {
            return response()->json([
                'status'=>false,
                'message'=>'You already placed in wishlist',
                'code'=>422
            ]);
          
        }else{
            
            $wishlist = new Wishlist;
            $wishlist->user_id = auth()->user()->id;
            $wishlist->product_id = $product->id;
            $wishlist->price = ($product->price-($product->price*$product->discount)/100);
            $wishlist->quantity = 1;
            $wishlist->amount=$wishlist->price*$wishlist->quantity;
            if ($wishlist->product->stock < $wishlist->quantity || $wishlist->product->stock <= 0) return back()->with('error','Stock not sufficient!.');
            $wishlist->save();
        }
        return response()->json([
            'status'=>true,
            'message'=>'Product successfully added to wishlist',
            'code'=>200
        ]);
               
    }  
    
    public function wishlistDelete(Request $request){
        $wishlist = Wishlist::find($request->id);
        if ($wishlist) {
            $wishlist->delete();
            return response()->json([
                'status'=>true,
                'message'=>'Wishlist successfully removed',
                'code'=>200
            ]);
          
        }
        return response()->json([
            'status'=>false,
            'message'=>'Error please try again',
            'code'=>422
        ]);
          
    }     
}
