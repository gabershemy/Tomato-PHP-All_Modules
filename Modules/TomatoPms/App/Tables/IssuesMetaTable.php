<?php

namespace Modules\TomatoPms\App\Tables;

use Illuminate\Http\Request;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\Facades\Toast;
use ProtoneMedia\Splade\SpladeTable;
use Illuminate\Database\Eloquent\Builder;

class IssuesMetaTable extends AbstractTable
{
    /**
     * Create a new instance.
     *
     * @return void
     */
    public function __construct(public mixed $query=null)
    {
        if(!$query){
            $this->query = \Modules\TomatoPms\App\Models\IssuesMeta::query();
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
                each: fn (\Modules\TomatoPms\App\Models\IssuesMeta $model) => $model->delete(),
                after: fn () => Toast::danger(__('IssuesMeta Has Been Deleted'))->autoDismiss(2),
                confirm: true
            )
            ->defaultSort('id', 'desc')
            ->column(
                key: 'id',
                label: __('Id'),
                sortable: true
            )
            ->column(
                key: 'issue_id',
                label: __('Issue id'),
                sortable: true
            )
            ->column(
                key: 'user_id',
                label: __('User id'),
                sortable: true
            )
            ->column(
                key: 'linked_id',
                label: __('Linked id'),
                sortable: true
            )
            ->column(
                key: 'model',
                label: __('Model'),
                sortable: true
            )
            ->column(
                key: 'model_id',
                label: __('Model id'),
                sortable: true
            )
            ->column(
                key: 'key',
                label: __('Key'),
                sortable: true
            )
            ->column(
                key: 'value',
                label: __('Value'),
                sortable: true
            )
            ->column(
                key: 'type',
                label: __('Type'),
                sortable: true
            )
            ->column(
                key: 'group',
                label: __('Group'),
                sortable: true
            )
            ->column(key: 'actions',label: trans('tomato-admin::global.crud.actions'))
            ->export()
            ->paginate(10);
    }
}
