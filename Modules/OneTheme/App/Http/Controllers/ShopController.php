<?php

namespace Modules\OneTheme\App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\TomatoCategory\App\Models\Category;
use Modules\TomatoCategory\App\Models\Type;
use Modules\TomatoCms\App\Models\Page;
use Modules\TomatoProducts\App\Models\Product;

class ShopController extends Controller
{
    public function index(Request $request){
        $page = Page::where('slug', '/shop')->first();
        if(!$page){
            $page = new Page();
            $page->title = 'Shop';
            $page->slug = '/shop';
            $page->is_active = true;
            $page->save();
        }
        $products = Product::query();

        if($request->has('search')){
            $products->where('name', 'LIKE', '%'.$request->get('search').'%');
            $products->orWhere('sku',  $request->get('search'));
            $products->orWhere('barcode',  $request->get('search'));
        }

        $options = Type::where('for', 'product-options')->where('type', 'type')->get();

        foreach ($options as $option){
            if($request->has($option->key)){
                $products->whereHas('productMetas', function ($q) use ($request, $option){
                    $q->where('key', 'options')
                        ->whereJsonContains('value->'. $option->key,$request->get($option->key));
                });
            }
        }

        if($request->has('categories')){
            $products->whereIn('category_id', $request->get('categories'))->orWhereHas('categories', function ($q) use ($request){
                $q->whereIn('id', $request->get('categories'));
            });
        }

        if($request->has('orderBy')){
            if($request->get('orderBy') === 'popular'){
                //Order Product By Top Rating
                $products->orderBy('is_trend', 'desc');
            }
            if($request->get('orderBy') === 'rating'){
                //Order Product By Top Rating
                $products->withCount('productReviews')->orderBy('product_reviews_count', 'desc');
            }
            if($request->get('orderBy') === 'newest'){
                $products->orderBy('created_at', 'desc');
            }
            if($request->get('orderBy') === 'lowToHigh'){
                $products->orderBy(DB::raw('ABS(price + vat) - ABS(discount)'),'ASC' );
            }
            if($request->get('orderBy') === 'highToLow'){
                $products->orderBy(DB::raw('ABS(price + vat) - ABS(discount)'),'DESC' );
            }
        }
        else {
            $products->inRandomOrder();
        }


        $products = $products->paginate(9);
        $categories = Category::where('for', 'product-categories')->where('menu', true)->where('activated', true)->get();

        return view('one-theme::index', compact('products', 'categories', 'options', 'page'));
    }

    public function product($slug){
        $product = Product::where('slug',$slug)->first();
        if($product){
            return view('one-theme::shop.product', compact('product'));
        }

        abort(404);
    }

    public function category($slug){
        return view('one-theme::shop.category');
    }
}
