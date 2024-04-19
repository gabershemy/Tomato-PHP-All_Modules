<?php

namespace Modules\TomatoProducts\App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;
use ProtoneMedia\Splade\Facades\Toast;
use Modules\TomatoCategory\App\Models\Category;
use Modules\TomatoCategory\App\Models\Type;
use Modules\TomatoProducts\App\Models\Product;

class ProductCategoryController extends Controller
{

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('tomato-products::product-categories.index');
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function create()
    {
        return view('tomato-products::product-categories.form');
    }


    /**
     * Store a newly created resource in storage.
     * @param Request $request
     */
    public function store(Request $request)
    {
        $getItemIfExists = Category::where('slug', $request->get('slug'))->first();

        $request->merge([
            "for" => "product-categories",
        ]);

        if($getItemIfExists){
            $request->validate([
                "parent_id" => "nullable|integer|exists:categories,id",
                "name" => "required|array",
                "slug" => "required|string|max:255|unique:categories,slug," . $getItemIfExists->id,
                "name*" => "required|string|max:255",
                "color" => "nullable|string|max:255",
                "icon" => "nullable|string|max:255",
                "description" => "nullable|string|max:255",
                "activated" => "nullable|boolean",
                "menu" => "nullable|boolean",
            ]);

            $getItemIfExists->update($request->all());

            if($request->hasFile('image')){
                $getItemIfExists->clearMediaCollection('image');
                $getItemIfExists->addMedia($request->file('image'))->toMediaCollection('image');
            }

            Toast::success(__('Category updated successfully!'))->autoDismiss(2);
            return back();
        }
        else {
            $request->validate([
                "image" => "nullable|file|max:2048",
                "parent_id" => "nullable|integer|exists:categories,id",
                "name" => "required|array",
                "slug" => "required|string|max:255|unique:categories,slug",
                "name*" => "required|string|max:255",
                "color" => "nullable|string|max:255",
                "icon" => "nullable|string|max:255",
                "description" => "nullable|string|max:255",
                "activated" => "nullable|boolean",
                "menu" => "nullable|boolean",
            ]);

            $category = Category::create($request->all());
            if($request->hasFile('image')){
                $category->addMedia($request->file('image'))->toMediaCollection('image');
            }

            Toast::success(__('Category created successfully!'))->autoDismiss(2);
            return back();
        }
    }

    public function edit(Category $item){
        $item->image = $item->getMedia('image')->first()?->getUrl();
        return view('tomato-products::product-categories.form', [
            "item" => $item
        ]);
    }

    public function destroy(Category $item){
        $item->delete();

        Toast::success(__('Category deleted successfully'))->autoDismiss(2);
        return back();
    }

    public function category(Request $request)
    {
        $request->validate([
           "ids" => "required|string"
        ]);

        $ids = explode(',', $request->get('ids'));
        $categories = Category::where('for', 'product-categories')->get();

        return view('tomato-products::product-categories.attach', [
            "categories" => $categories,
            "ids" => $ids,
        ]);
    }

    public function attach(Request $request)
    {
        $request->validate([
            "ids" => "required|array|min:1",
            "ids*"=> "required|exists:products,id",
            "category_id" => "required|exists:categories,id"
        ]);

        $products = Product::whereIn('id', $request->get('ids'))->get();
        foreach ($products as $product){
            $product->category_id = $request->get('category_id');
            $product->save();
        }

        Toast::success(__('Product Categories has been updated'))->autoDismiss(2);
        return back();
    }


}
