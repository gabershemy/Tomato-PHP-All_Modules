<?php

namespace Modules\TomatoBranches\App\Tables;

use Illuminate\Http\Request;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\Facades\Toast;
use ProtoneMedia\Splade\SpladeTable;
use Illuminate\Database\Eloquent\Builder;
use TomatoPHP\TomatoRoles\Services\TomatoRoles;

class BranchTable extends AbstractTable
{
    /**
     * Create a new instance.
     *
     * @return void
     */
    public function __construct(public mixed $query)
    {
        if(!$this->query){
            $this->query = \Modules\TomatoBranches\App\Models\Branch::query();
        }
    }

    /**
     * Determine if the user is authorized to perform bulk actions and exports.
     *
     * @return bool
     */
    public function authorize(Request $request)
    {
        if(auth('web')->user() && class_exists(TomatoRoles::class)){
            return auth('web')->user()->can('admin.branches.index');
        }
        else {
            return true;
        }
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
                columns: ['id','name','phone',]
            )

            ->defaultSort('id', 'desc')
            ->column(
                key: 'id',
                label: __('Id'),
                hidden: true,
                sortable: true
            )
            ->column(
                key: 'branch_number',
                label: __('Branch Number'),
                sortable: true
            )
            ->column(
                key: 'company.name',
                label: __('Company'),
                sortable: true
            )
            ->column(
                key: 'name',
                label: __('Name'),
                sortable: true
            )
            ->column(key: 'actions',label: trans('tomato-admin::global.crud.actions'))
            ->paginate(10);



        if(auth('web')->user() && class_exists(TomatoRoles::class)){
            if(auth('web')->user()->can('admin.branches.export')){
                $table->export();
            }
            if(auth('web')->user()->can('admin.branches.destroy')){
                $table->bulkAction(
                    label: trans('tomato-admin::global.crud.delete'),
                    each: fn (\Modules\TomatoBranches\App\Models\Branch $model) => $model->delete(),
                    after: fn () => Toast::danger(__('Branch Has Been Deleted'))->autoDismiss(2),
                    confirm: true
                );
            }
        }
        else {
            $table->bulkAction(
                label: trans('tomato-admin::global.crud.delete'),
                each: fn (\Modules\TomatoBranches\App\Models\Branch $model) => $model->delete(),
                after: fn () => Toast::danger(__('Branch Has Been Deleted'))->autoDismiss(2),
                confirm: true
            );
            $table->export();
        }
    }
}
