<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\vendors;
use Auth;
use Spatie\Permission\Models\Role;

class BranchController  extends Controller
{
    public function BranchSearch(Request $request){
 
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

// Follow a branch
public function followBranch(Branch $branch)
{
    $user = auth()->user();
    if($user->followedBranches==null){
        return response()->json(['message' => 'th'], 200);

    }
    if (!$user->followedBranches->contains($branch->id)) {
        $user->followedBranches()->attach($branch->id);
        return response()->json(['message' => 'You are now following this branch'], 200);
    }

    return response()->json(['message' => 'You are already following this branch'], 400);
}

// Unfollow a branch
public function unfollowBranch(Branch $branch)
{
    $user = auth()->user();
    $user->followedBranches()->detach($branch->id);
    return response()->json(['message' => 'You have unfollowed this branch'], 200);
}


   }
