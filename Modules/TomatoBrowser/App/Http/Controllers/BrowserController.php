<?php


namespace Modules\TomatoBrowser\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use ProtoneMedia\Splade\Facades\Toast;

class BrowserController extends Controller
{
    public function index(Request $request)
    {
       if(is_developer()){
           if ($request->has('folder_path')) {
               $request->validate([
                   "folder_path" => "required",
                   "folder_name" => "required",
                   "type" => "required",
               ]);

               $root = $request->get('folder_path');
               $name = $request->get('folder_name');
               $type = $request->get('type');
           } else if ($request->has('file_path')) {
               $name = $request->get('file_name');
               $setFilePath = $request->get('file_path');
               $root = str_replace('/' . $name, '', $request->get('file_path'));
           } else {
               $root = base_path();
               $name = base_path();
               $type = "home";
           }

           if ($request->has('file_path')) {
               $getFile = File::get($setFilePath);

               $folders =  File::directories($root);
               $files =  File::files($root);
               $foldersArray = [];
               $filesArray = [];

               foreach ($folders as $folder) {
                   $foldersArray[] = [
                       "path" => $folder,
                       "name" => str_replace($root . '/', '', $folder),
                   ];
               }

               foreach ($files as $file) {
                   $filesArray[] = [
                       "path" => $file->getRealPath(),
                       "name" => str_replace($root . '/', '', $file),
                   ];
               }

               $exploadName = explode('/', $root);
               $count = count($exploadName);
               $setName = $exploadName[$count - 1];

               $ex = File::extension($setFilePath);

               if ($ex === 'webp' || $ex === 'jpg' || $ex === 'png' || $ex === 'svg' || $ex === 'jpeg' || $ex === 'ico' ||  $ex === 'gif' || $ex === 'tif') {
                   $imagBase64 = base64_encode($getFile);
                   $getFile = $imagBase64;
               }

               return view('tomato-browser::index',[
                   "folders" => $foldersArray,
                   "files" => $filesArray,
                   "back_path" => $root,
                   "back_name" => $setName,
                   "current_path" => $root,
                   "file" => $getFile,
                   "ex" => $ex,
                   "path" => $setFilePath,
                   "history" => [
                       "folders" => $foldersArray,
                       "files" => $filesArray,
                       "back_path" => $root,
                       "back_name" => $setName,
                       "current_path" => $root,
                       "file" => $getFile,
                       "ex" => $ex,
                       "path" => $setFilePath
                   ],
               ]);
           } elseif ($request->has('content')) {
               $checkIfFileEx = File::exists($request->get('path'));
               if ($checkIfFileEx) {
                   File::put($request->get('path'), $request->get('content'));

                   Toast::success(__('Your File Has Been Uploaded Success'))->autoDismiss(2);
                   return back();
               }
           } else {
               $folders =  File::directories($root);
               $files =  File::files($root);
               $foldersArray = [];
               $filesArray = [];

               foreach ($folders as $folder) {
                   $foldersArray[] = [
                       "path" => $folder,
                       "name" => str_replace($root . '/', '', $folder),
                   ];
               }

               foreach ($files as $file) {
                   $ex = File::extension($file);
                   $filesArray[] = [
                       "path" => $file->getRealPath(),
                       "name" => str_replace($root . '/', '', $file),
                       "ex" => $ex
                   ];
               }

               if ($root == base_path()) {
                   $filesArray[] = [
                       "path" => base_path('.env'),
                       "name" => ".env",
                   ];
               }

               $exploadName = explode('/', $root);
               $count = count($exploadName);
               $setName = $exploadName[$count - 2];

               return view('tomato-browser::index',[
                   "folders" => $foldersArray,
                   "files" => $filesArray,
                   "back_path" => str_replace('/' . $name, '', $root),
                   "back_name" => $setName,
                   "current_path" => $root,
                   "file" => false,
                   "ex" => false,
                   "path" => false,
                   "history" => [
                       "folders" => $foldersArray,
                       "files" => $filesArray,
                       "back_path" => str_replace('/' . $name, '', $root),
                       "back_name" => $setName,
                       "current_path" => $root,
                       "file" => false,
                       "ex" => false,
                       "path" => false
                   ],
               ]);
           }
       }

       return developer_redirect();
    }

    public function upload(Request $request)
    {
        $request->validate([
            "filePath" => "required|string"
        ]);

        $filePath = $request->get('filePath');

        return view('tomato-browser::upload', compact('filePath'));
    }
    public function store(Request $request)
    {
        if(is_developer()) {
            $request->validate([
                "media" => "required|array",
                "path" => "required|string"
            ]);

            if ($request->hasFile('media')) {
                foreach ($request->file('media') as $file) {
                    $file->move($request->get('path'), $file->getClientOriginalName());
                }
            }

            Toast::success(__('Your File Has Been Uploaded Success'))->autoDismiss(2);
            return redirect()->route('admin.browser.index');
        }

        return developer_redirect();
    }

    public function destroy(Request $request)
    {
        $request->validate([
            "path" => "required|string"
        ]);

        if(File::exists($request->get('path'))){
            File::delete($request->get('path'));
        }

        Toast::success(__('Your File Has Been Deleted Success'))->autoDismiss(2);
        return back();
    }


}
