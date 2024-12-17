<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\vendors;
use App\User;
use App\Models\ProductReview;


class BranchController extends Controller
{
    public function getVendorReviews($vendorId)
    {
        // Retrieve all reviews for products belonging to the specified vendor
        // $reviews = ProductReview::whereHas('productto', function ($query) use ($vendorId) {
        //     $query->where('vendor_id', $vendorId);
        // })->paginate(10); // Optional: Paginate the results

        $reviews = ProductReview::join('products', 'product_reviews.product_id', '=', 'products.id')
            ->where('products.vendor_id', $vendorId)
            ->select('product_reviews.*') // Ensure only product review fields are selected
            ->paginate(10);
            

        return response()->json($reviews);
    }

    public function vendorSearch(Request $request){
 
        $vendors=vendors::with('followers')->orwhere('branch_name','like','%'.$request->search.'%')
                    ->orderBy('id','DESC')
                    ->paginate('9')->map(function ($vendor) {
                         
                        $vendor->is_follow =$vendor->is_follow; // Adds the is_liked attribute
                        return $vendor;
                    });

                return response()->json($vendors);
     }
    //
    public function followBranch(vendors $branch)
{
    $user = auth()->user();
      if($user->followedBranches==null){
         $user->followedBranches()->attach($branch->id);
         return response()->json(['message' => 'You are now following this branch'], 200);


    }else{
        if (!$user->followedBranches->contains($branch->id)) {
            $user->followedBranches()->attach($branch->id);
            return response()->json(['message' => 'You are now following this branch'], 200);
        }
    
        return response()->json(['message' => 'You are already following this branch'], 400);

    }
   
}

// Unfollow a branch
public function unfollowBranch(vendors $branch)
{
    $user = auth()->user();
    $user->followedBranches()->detach($branch->id);
    return response()->json(['message' => 'You have unfollowed this branch'], 200);
}

}
