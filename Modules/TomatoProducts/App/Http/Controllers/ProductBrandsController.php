<?php

namespace Modules\TomatoProducts\App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use ProtoneMedia\Splade\Facades\Toast;
use Modules\TomatoCategory\App\Models\Type;

class ProductBrandsController extends Controller
{

    public function index(){
        return view('tomato-products::product-brands.index');
    }

    public function create(){
        return view('tomato-products::product-brands.form');
    }

    public function store(Request $request){
        $getItemIfExists = Type::where('key', $request->get('key'))->first();
        if($getItemIfExists){
            $request->validate([
                "name" => "required|array",
                "name*" => "required|string|max:255",
                "key" => "required|string|unique:types,key,".$getItemIfExists->id,
            ]);

            $getItemIfExists->update([
                'name' => $request->get('name'),
                'key' => $request->get('key'),
                'color' => $request->get('color')??null,
                'icon' => $request->get('icon')??null,
            ]);
        }
        else {
            $request->validate([
                "name" => "required|array",
                "name*" => "required|string|max:255",
                "key" => "required|string|unique:types,key",
            ]);

            Type::create([
                'name' => $request->get('name'),
                'key' => $request->get('key'),
                'for' => 'products',
                'type' => 'brands',
                'color' => $request->get('color')??null,
                'icon' => $request->get('icon')??null,
            ]);
        }

        Toast::success(__('Option has been updated successfully'))->autoDismiss(2);
        return back();
    }

    public function edit(Type $item){
        return view('tomato-products::product-brands.form', [
            "item" => $item
        ]);
    }

    public function destroy(Type $item){
        $item->delete();

        Toast::success(__('Option deleted successfully'))->autoDismiss(2);
        return back();
    }

}
