<?php

namespace Modules\TomatoInventory\App\Tables;

use Illuminate\Http\Request;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\Facades\Toast;
use ProtoneMedia\Splade\SpladeTable;
use Modules\TomatoRoles\App\Services\TomatoRoles;

class RefundTable extends AbstractTable
{
    /**
     * Create a new instance.
     *
     * @return void
     */
    public function __construct(public mixed $query=null)
    {
        if(!$query){
            $this->query = \Modules\TomatoInventory\App\Models\Refund::query();
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
            ->selectFilter(
                key:'order_id',
                option_label: "uuid",
                option_value: "id",
                remote_root: "data",
                remote_url: route('admin.orders.api'),
                queryBy: 'uuid'
            )
            ->selectFilter(
                key:'branch_id',
                option_label: "name",
                option_value: "id",
                remote_root: "data",
                remote_url: route('admin.branches.api')
            )
            ->selectFilter(
                key:'status',
                options: [
                    "pending" => __("Pending"),
                    "factory" => __("Factory"),
                    "bad" => __("Bad"),
                    "inventory" => __("Inventory"),
                ]
            )
            ->boolFilter(
                key:'is_activated'
            )
            ->defaultSort('id', 'desc')
            ->column(key: 'actions',label: trans('tomato-admin::global.crud.actions'))
            ->column(
                key: 'id',
                label: __('Id'),
                sortable: true
            )
            ->column(
                key: 'status',
                label: __('Status'),
                sortable: true
            )
            ->column(
                key: 'is_activated',
                label: __('Is activated'),
                sortable: true
            )
            ->column(
                key: 'user.name',
                label: __('User'),
                sortable: true
            )
            ->column(
                key: 'branch.name',
                label: __('Branch'),
                sortable: true
            )
            ->column(
                key: 'order.uuid',
                label: __('Order #'),
                sortable: true
            )

            ->column(
                key: 'total',
                label: __('Total'),
                sortable: true
            )
            ->paginate(10);



        if(auth('web')->user() && class_exists(TomatoRoles::class)){
            if(auth('web')->user()->can('admin.refunds.export')){
                $table->export();
            }
            if(auth('web')->user()->can('admin.refunds.destroy')){
                $table->bulkAction(
                    label: trans('tomato-admin::global.crud.delete'),
                    each: fn (\Modules\TomatoInventory\App\Models\Refund $model) => $model->delete(),
                    after: fn () => Toast::danger(__('Refund Has Been Deleted'))->autoDismiss(2),
                    confirm: true
                );
            }
        }
        else {
            $table->bulkAction(
                label: trans('tomato-admin::global.crud.delete'),
                each: fn (\Modules\TomatoInventory\App\Models\Refund $model) => $model->delete(),
                after: fn () => Toast::danger(__('Refund Has Been Deleted'))->autoDismiss(2),
                confirm: true
            );
            $table->export();
        }
    }
}
