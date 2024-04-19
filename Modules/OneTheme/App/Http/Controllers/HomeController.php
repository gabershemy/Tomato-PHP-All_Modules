<?php

namespace Modules\OneTheme\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\Facades\Toast;
use Modules\TomatoCategory\App\Models\Type;
use Modules\TomatoCms\App\Models\Page;
use Modules\TomatoCrm\App\Models\Contact;
use Modules\TomatoProducts\App\Models\FormRequest;
use Modules\TomatoSupport\App\Models\Question;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $page = Page::where('slug', '/')->first();
        if(!$page){
            $page = new Page();
            $page->title = 'Home';
            $page->slug = '/';
            $page->is_active = true;
            $page->save();
        }
        return view('one-theme::index', compact('page'));
    }


    public function about()
    {
        $page = Page::where('slug', '/about')->first();
        if(!$page){
            $page = new Page();
            $page->title = 'About';
            $page->slug = '/about';
            $page->is_active = true;
            $page->save();
        }
        return view('one-theme::index', compact('page'));
    }

    public function returns()
    {
        $page = Page::where('slug', '/returns')->first();
        if(!$page){
            $page = new Page();
            $page->title = 'Returns';
            $page->slug = '/returns';
            $page->is_active = true;
            $page->save();
        }
        return view('one-theme::index', compact('page'));
    }

    public function contact()
    {
        $page = Page::where('slug', '/contact')->first();
        if(!$page){
            $page = new Page();
            $page->title = 'Contact Us';
            $page->slug = '/contact';
            $page->is_active = true;
            $page->save();
        }
        return view('one-theme::index', compact('page'));
    }

    public function terms()
    {
        $page = Page::where('slug', '/terms')->first();
        if(!$page){
            $page = new Page();
            $page->title = 'Terms';
            $page->slug = '/terms';
            $page->is_active = true;
            $page->save();
        }
        return view('one-theme::index', compact('page'));
    }

    public function privacy()
    {
        $page = Page::where('slug', '/privacy')->first();
        if(!$page){
            $page = new Page();
            $page->title = 'Privacy';
            $page->slug = '/privacy';
            $page->is_active = true;
            $page->save();
        }
        return view('one-theme::index', compact('page'));
    }

    public function faq(Request $request){
        if(class_exists(\Modules\TomatoSupport\App\Models\Question::class)){
            $page = Page::where('slug', 'faq')->first();
            if(!$page){
                $page = new Page();
                $page->title = 'FAQ';
                $page->slug = '/faq';
                $page->is_active = true;
                $page->save();
            }
            $questions = Question::query();

            if($request->has('search')){
                $questions->where('qa', 'like', "%{$request->get('search')}%");
            }

            $questions = $questions->paginate(12);

            return view('one-theme::index', compact('questions', 'page'));
        }
        else {
            return redirect()->to('/');
        }
    }


    public function send(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|min:12',
            'subject' => 'required|string|max:255',
            'message' => 'required|string'
        ]);

        $contact = new Contact();
        $contact->type_id = Type::first()?->id;
        $contact->status_id = Type::first()?->id;
        $contact->name = $request->get('name');
        $contact->email = $request->get('email');
        $contact->phone = $request->get('phone');
        $contact->subject = $request->get('subject');
        $contact->message = $request->get('message');
        $contact->save();

        Toast::success(__('Your message has been sent successfully!'))->autoDismiss(2);
        return back();
    }

    public function form(Request $request){
        $rules = [];
        $userModel = get_class(auth()->user()->getModel());
        $request->merge([
            "model_type" => $userModel,
            "model_id" => auth()->user()->id,
            "payload" => $request->has('payload') ? $request->get('payload') : $request->all(),
        ]);

        if($request->has('service_id') && config('tomato-forms.service_type', null)){
            $request->merge([
                "service_type" => config('tomato-forms.service_type'),
                "service_id" => $request->get('service_id'),
            ]);
        }

        $getFromFields = \Modules\TomatoProducts\App\Models\Form::find($request->get('form_id'))?->fields;
        if($getFromFields){
            foreach ($getFromFields as $field){

                $validations = [];

                if($field->is_required){
                    $validations[] = "required";
                }

                if($field->has_validation){
                    if($field->validations){
                        foreach ($field->validations as $key=>$validation){
                            if($key === 'max'){
                                $validations[] = "max:{$validation}";
                            }
                            if($key === 'min'){
                                $validations[] = "min:{$validation}";
                            }
                            if($key === 'type'){
                                $validations[] = "{$validation}";
                            }
                        }
                    }
                }

                $rules["payload.{$field->name}"] = $validations;
            }
        }

        $request->validate([
            "form_id" => "required|exists:forms,id",
            "payload" => "nullable|array"
        ]);

        $request->validate($rules);

        FormRequest::create($request->all());

        Toast::success(__('Your message has been sent successfully!'))->autoDismiss(2);
        return redirect()->back();
    }


}
