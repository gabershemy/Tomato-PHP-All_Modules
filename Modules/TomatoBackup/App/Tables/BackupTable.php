<?php

namespace Modules\TomatoBackup\App\Tables;

use Illuminate\Http\Request;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\Facades\Toast;
use ProtoneMedia\Splade\SpladeTable;
use Modules\TomatoBackup\App\Models\BackupDestination;
use Spatie\Backup\BackupDestination\Backup;
use Spatie\Backup\BackupDestination\BackupDestination as SpatieBackupDestination;

class BackupTable extends AbstractTable
{
    /**
     * Create a new instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the user is authorized to perform bulk actions and exports.
     *
     * @return bool
     */
    public function authorize(Request $request)
    {
        return true;
    }

    /**
     * The resource or query builder.
     *
     * @return mixed
     */
    public function for()
    {
        return BackupDestination::query();
    }

    /**
     * Configure the given SpladeTable.
     *
     * @param \ProtoneMedia\Splade\SpladeTable $table
     * @return void
     */
    public function configure(SpladeTable $table)
    {
        $table
            ->withGlobalSearch(label: trans('tomato-admin::global.search'),columns: ['id','path'])
            ->bulkAction(
                label: trans('tomato-admin::global.crud.delete'),
                each: function (BackupDestination $model) {
                    SpatieBackupDestination::create($model->disk, config('backup.backup.name'))
                        ->backups()
                        ->first(function (Backup $backup) use ($model) {
                            return $backup->path() === $model->path;
                        })
                        ->delete();

                    sleep(5);
                },
                after: fn () => Toast::danger(trans('tomato-backup::global.delete_backup'))->autoDismiss(2),
                confirm: true
            )
            ->export()
            ->defaultSort('id')
            ->column(key: "id",label: trans('tomato-backup::global.id'), sortable: true, hidden: true)
            ->column(key: "path",label: trans('tomato-backup::global.path'), sortable: true)
            ->column(key: 'disk', label: trans('tomato-backup::global.disk'), sortable: true)
            ->column(key: 'size', label: trans('tomato-backup::global.size'), sortable: true)
            ->column(key: 'date', label: trans('tomato-backup::global.date'), sortable: true)
            ->column(key: 'actions',label: trans('tomato-roles::global.roles.actions'))
            ->paginate(15);
    }
}
