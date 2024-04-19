<?php

namespace Modules\TomatoPms\App\Tables;

use Illuminate\Http\Request;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\Facades\Toast;
use ProtoneMedia\Splade\SpladeTable;
use Illuminate\Database\Eloquent\Builder;

class TimerTable extends AbstractTable
{
    /**
     * Create a new instance.
     *
     * @return void
     */
    public function __construct(public mixed $query=null)
    {
        if(!$query){
            $this->query = \Modules\TomatoPms\App\Models\Timer::query();
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
                each: fn (\Modules\TomatoPms\App\Models\Timer $model) => $model->delete(),
                after: fn () => Toast::danger(__('Timer Has Been Deleted'))->autoDismiss(2),
                confirm: true
            )
            ->selectFilter(
                key: 'employee_id',
                label: __('Employee'),
                remote_url: route('admin.users.api'),
            )
            ->boolFilter(
                key: 'is_running',
                label: __('Is running'),
            )
            ->boolFilter(
                key: 'is_done',
                label: __('Is done'),
            )
            ->dateFilter()
            ->defaultSort('id', 'desc')
            ->column(
                key: 'id',
                label: __('Id'),
                sortable: true
            )
            ->column(
                key: 'issue.summary',
                label: __('Issue'),
                sortable: true
            )
            ->column(
                key: 'employee.name',
                label: __('Employee'),
                sortable: true
            )
            ->column(
                key: 'start_at',
                label: __('Start at'),
                sortable: true
            )
            ->column(
                key: 'end_at',
                label: __('End at'),
                sortable: true
            )
            ->column(
                key: 'total_time',
                label: __('Total time'),
                sortable: true
            )
            ->column(
                key: 'total_money',
                label: __('Total money'),
                sortable: true
            )
            ->column(
                key: 'is_running',
                label: __('Is running'),
                sortable: true
            )
            ->column(
                key: 'is_done',
                label: __('Is done'),
                sortable: true
            )
            ->column(
                key: 'is_billable',
                label: __('Is billable'),
                sortable: true
            )
            ->column(
                key: 'is_paid',
                label: __('Is paid'),
                sortable: true
            )
            ->column(key: 'actions',label: trans('tomato-admin::global.crud.actions'))
            ->export()
            ->paginate(10);
    }
}
