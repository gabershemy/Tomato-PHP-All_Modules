<?php

namespace Modules\TomatoInventory\App\Tables;

use Illuminate\Http\Request;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\Facades\Toast;
use ProtoneMedia\Splade\SpladeTable;

class InventoryLogTable extends AbstractTable
{
    /**
     * Create a new instance.
     *
     * @return void
     */
    public function __construct(public mixed $query=null)
    {
        if(!$query){
            $this->query = \Modules\TomatoInventory\App\Models\InventoryLog::query();
        }
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
        return $this->query;
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
            ->withGlobalSearch(
                label: trans('tomato-admin::global.search'),
                columns: ['id',]
            )
            ->bulkAction(
                label: trans('tomato-admin::global.crud.delete'),
                each: fn (\Modules\TomatoInventory\App\Models\InventoryLog $model) => $model->delete(),
                after: fn () => Toast::danger(__('InventoryLog Has Been Deleted'))->autoDismiss(2),
                confirm: true
            )
            ->defaultSort('id', 'desc')
            ->column(
                key: 'id',
                label: __('Id'),
                hidden: true,
                sortable: true
            )
            ->column(
                key: 'user.name',
                label: __('Employee'),
                sortable: false
            )
            ->column(
                key: 'status',
                label: __('Status'),
                sortable: true
            )
            ->column(
                key: 'note',
                label: __('Note'),
                sortable: true
            )
            ->column(
                key: 'created_at',
                label: __('Date'),
                sortable: true
            )
            ->export()
            ->paginate(10);
    }
}
