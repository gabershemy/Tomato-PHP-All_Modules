<?php

namespace Modules\OneTheme\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\TomatoEcommerce\App\Models\Wishlist;
use ProtoneMedia\Splade\Facades\Toast;

class ProfileWishlistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Wishlist::query()->with('product')->where('account_id', auth('accounts')->user()->id)->paginate(10);
        return view('one-theme::profile.wishlist.index', compact('products'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        if(!auth('accounts')->user()){
            Toast::danger(__('You must be logged in to add product to wishlist.'))->autoDismiss(2);
            return redirect()->back();
        }

        $request->validate([
            "product_id" => "required|integer|exists:products,id"
        ]);

        $wishlist = \Modules\TomatoEcommerce\App\Models\Wishlist::where('account_id', auth('accounts')->user()->id)
            ->where('product_id', $request->get('product_id'))->first();

        if($wishlist){
            $wishlist->delete();

            Toast::success(__('Product removed from wishlist.'))->autoDismiss(2);
            return redirect()->back();
        }

        $wishlist = new \Modules\TomatoEcommerce\App\Models\Wishlist;
        $wishlist->account_id = auth('accounts')->user()->id;
        $wishlist->product_id = $request->get('product_id');
        $wishlist->save();

        Toast::success(__('Product added to wishlist.'))->autoDismiss(2);
        return redirect()->back();
    }
}
