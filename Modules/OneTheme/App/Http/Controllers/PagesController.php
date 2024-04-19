<?php

namespace Modules\OneTheme\App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class PagesController extends Controller
{
    public function contact(){
        return view('one-theme::pages.contact');
    }

    public function page($slug){
        return view('one-theme::pages.page');
    }
}
