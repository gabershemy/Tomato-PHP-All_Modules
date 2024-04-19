<?php

namespace Modules\TomatoBackup\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use ProtoneMedia\Splade\Facades\Toast;
use Modules\TomatoBackup\App\Jobs\CreateBackupJob;
use Modules\TomatoBackup\App\Models\BackupDestination;
use TomatoPHP\TomatoAdmin\Facade\Tomato;
use Spatie\Backup\BackupDestination\Backup;
use Spatie\Backup\BackupDestination\BackupDestination as SpatieBackupDestination;

class BackupController extends Controller
{
    /**
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        if(is_developer()){
            return Tomato::index(
                request: $request,
                model: BackupDestination::class,
                view: 'tomato-backup::backup.index',
                table: \Modules\TomatoBackup\App\Tables\BackupTable::class,
            );
        }
        else {
            return developer_redirect();
        }

    }

    /**
     * @param Request $request
     * @return View
     */
    public function create(Request $request): View
    {
        return view('tomato-backup::backup.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
           "type" => "required|string|max:255"
        ]);

        $option = "";
        if($request->get('type') === 'db'){
            $option = "only-db";
        }
        else if ($request->get('type') === 'files'){
            $option = "only-files";
        }

        dispatch(new CreateBackupJob($option))
            ->onQueue(config('backup.queue'))
            ->afterResponse();

        Toast::title(trans('tomato-backup::global.start_backup'))->success()->autoDismiss(2);
        return redirect()->back();

    }

    public function download(Request $request, BackupDestination $record): \Symfony\Component\HttpFoundation\StreamedResponse
    {
        return Storage::disk($record->disk)->download($record->path);
    }

    public function destroy(Request $request, BackupDestination $record): RedirectResponse
    {
        SpatieBackupDestination::create($record->disk, config('backup.backup.name'))
            ->backups()
            ->first(function (Backup $backup) use ($record) {
                return $backup->path() === $record->path;
            })
            ->delete();

        sleep(5);
        Toast::title(trans('tomato-backup::global.delete_backup'))->success()->autoDismiss(2);
        return redirect()->route('admin.backup.index');
    }
}
