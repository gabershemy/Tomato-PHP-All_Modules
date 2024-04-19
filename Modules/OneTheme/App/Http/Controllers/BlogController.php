<?php

namespace Modules\OneTheme\App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\TomatoCategory\App\Models\Category;
use Modules\TomatoCms\App\Models\Page;
use Modules\TomatoCms\App\Models\Post;

class BlogController extends Controller
{
    public function index(Request $request){
        $page = Page::where('slug', '/blog')->first();
        if(!$page){
            $page = new Page();
            $page->title = 'Blog';
            $page->slug = '/blog';
            $page->is_active = true;
            $page->save();
        }

        $posts = Post::query();
        if ($request->has('search')) {
            $search = $request->get('search');
            $posts->where("title", "LIKE", "%" . $search . "%")
                ->where('type', 'post');
        }
        if($request->has('category_id')){
            $posts->whereHas('categories', function ($q) use ($request) {
                $q->where('category_id', $request->get('category_id'));
            });
        }

        $posts = $posts->where('activated', true)->orderBy('id', 'desc')
                        ->paginate(12);

        return view('one-theme::index', [
            "categories" => Category::where('for', 'category')->get(),
            "posts" =>  $posts,
            'page' => $page,
        ]);
    }

    public function post($slug){
        $getPost = Post::where('slug', $slug)->first();
        if ($getPost) {
            $getPost->views += 1;
            $getPost->save();
            if (count($getPost->categories)) {
                $id = $getPost->categories[0]->id;
                $refBlog = Post::whereHas('categories', function ($q) use ($id) {
                    $q->where('category_id', $id);
                })->where('type', 'post')->where('id', '!=', $getPost->id)->get()->take(3);
            } else {
                $refBlog = [];
            }

            return view('one-theme::blog.post', [
                "post" =>  $getPost,
                "ref" => $refBlog
            ]);
        } else {
            return redirect()->to(app()->getLocale() .'/blog');
        }
    }
}
