<?php

namespace Modules\TomatoPms\App\Tables;

use Illuminate\Http\Request;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\Facades\Toast;
use ProtoneMedia\Splade\SpladeTable;
use Illuminate\Database\Eloquent\Builder;
use Modules\TomatoCategory\App\Models\Type;

class IssueTable extends AbstractTable
{
    /**
     * Create a new instance.
     *
     * @return void
     */
    public function __construct(public mixed $query=null)
    {
        if(!$query){
            $this->query = \Modules\TomatoPms\App\Models\Issue::query();
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
                each: fn (\Modules\TomatoPms\App\Models\Issue $model) => $model->delete(),
                after: fn () => Toast::danger(__('Issue Has Been Deleted'))->autoDismiss(2),
                confirm: true
            )
            ->selectFilter(
                key: 'type',
                label: __('Type'),
                options: Type::where('for', 'issues')->where('type', 'types')->get()->pluck('name', 'key')->toArray()
            )
            ->selectFilter(
                key: 'status',
                label: __('Status'),
                options: Type::where('for', 'issues')->where('type', 'status')->get()->pluck('name', 'key')->toArray()
            )
            ->defaultSort('id', 'desc')
            ->column(
                key: 'id',
                label: __('Id'),
                sortable: true,hidden: true
            )
            ->column(
                key: 'summary',
                label: __('Summary'),
                sortable: true
            )
            ->column(
                key: 'status',
                label: __('Status'),
                sortable: true
            )
            ->column(key: 'actions',label: trans('tomato-admin::global.crud.actions'))
            ->export()
            ->paginate(10);
    }
}
