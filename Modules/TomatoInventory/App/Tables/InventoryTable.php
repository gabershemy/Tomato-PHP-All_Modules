<?php

namespace Modules\TomatoInventory\App\Tables;

use Illuminate\Http\Request;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\Facades\Toast;
use ProtoneMedia\Splade\SpladeTable;
use Modules\TomatoRoles\App\Services\TomatoRoles;

class InventoryTable extends AbstractTable
{
    /**
     * Create a new instance.
     *
     * @return void
     */
    public function __construct(public mixed $query=null)
    {
        if(!$query){
            $this->query = \Modules\TomatoInventory\App\Models\Inventory::query();
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
            return auth('web')->user()->can('admin.inventories.index');
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
                    "not-available" => __("Not Available"),
                    "part-available" => __("Part Available"),
                    "canceled" => __("Canceled"),
                    "done" => __("Done"),
                ]
            )
            ->selectFilter(
                key:'type',
                options: [
                    "in" => __("In"),
                    "out" => __("Out")
                ]
            )
            ->dateFilter()
            ->defaultSort('id', 'desc')
            ->column(
                key: 'id',
                label: __('Id'),
                hidden: true,
                sortable: true
            )
            ->column(
                key: 'items',
                label: __('Items'),
                sortable: false
            )
            ->column(
                key: 'status',
                label: __('Status'),
                sortable: true
            )
            ->column(
                key: 'branch.name',
                label: __('Branch'),
                sortable: true
            )
            ->column(
                key: 'order.uuid',
                label: __('Order'),
                searchable: true,
                sortable: true
            )
            ->column(
                key: 'type',
                label: __('Type'),
                sortable: true
            )
            ->column(
                key: 'is_activated',
                label: __('Is activated'),
                sortable: true
            )
            ->column(
                key: 'total',
                label: __('Total'),
                sortable: true
            )
            ->column(
                key: 'uuid',
                label: __('UUID'),
                searchable: true,
                sortable: true
            )
            ->column(
                key: 'created_at',
                label: __('Date'),
                sortable: true
            )
            ->column(key: 'actions',label: trans('tomato-admin::global.crud.actions'))

            ->paginate(10);


        if(auth('web')->user() && class_exists(TomatoRoles::class)){
            if(auth('web')->user()->can('admin.inventories.export')){
                $table->export();
            }
            if(auth('web')->user()->can('admin.inventories.destroy')){
                $table->bulkAction(
                    label: trans('tomato-admin::global.crud.delete'),
                    each: fn (\Modules\TomatoInventory\App\Models\Inventory $model) => $model->delete(),
                    after: fn () => Toast::danger(__('Inventory Has Been Deleted'))->autoDismiss(2),
                    confirm: true
                );
            }
        }
        else {
            $table->bulkAction(
                label: trans('tomato-admin::global.crud.delete'),
                each: fn (\Modules\TomatoInventory\App\Models\Inventory $model) => $model->delete(),
                after: fn () => Toast::danger(__('Inventory Has Been Deleted'))->autoDismiss(2),
                confirm: true
            );
            $table->export();
        }
    }
}
