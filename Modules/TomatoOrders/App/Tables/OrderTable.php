<?php

namespace Modules\TomatoOrders\App\Tables;

use Illuminate\Http\Request;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\Facades\Toast;
use ProtoneMedia\Splade\SpladeTable;
use Illuminate\Database\Eloquent\Builder;
use Modules\TomatoRoles\App\Services\TomatoRoles;

class OrderTable extends AbstractTable
{
    /**
     * Create a new instance.
     *
     * @return void
     */
    public function __construct(
        public mixed $query=null
    )
    {
        if(!$this->query){
            $this->query = \Modules\TomatoOrders\App\Models\Order::query();
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
            return auth('web')->user()->can('admin.orders.index');
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
                columns: ['id','uuid','name','phone']
            )
            ->selectFilter(
                key:'account_id',
                option_label: "name",
                option_value: "id",
                remote_root: "data",
                remote_url: route('admin.accounts.api')
            )
            ->selectFilter(
                key:'branch_id',
                option_label: "name",
                option_value: "id",
                remote_root: "data",
                remote_url: route('admin.branches.api')
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
                    setting('ordering_pending_status') => str(setting('ordering_pending_status'))->ucfirst(),
                    setting('ordering_prepared_status') => str(setting('ordering_prepared_status'))->ucfirst(),
                    setting('ordering_withdrew_status') => str(setting('ordering_withdrew_status'))->ucfirst(),
                    setting('ordering_shipped_status') => str(setting('ordering_shipped_status'))->ucfirst(),
                    setting('ordering_delivered_status') => str(setting('ordering_delivered_status'))->ucfirst(),
                    setting('ordering_cancelled_status') => str(setting('ordering_cancelled_status'))->ucfirst(),
                    setting('ordering_refunded_status') => str(setting('ordering_refunded_status'))->ucfirst(),
                    setting('ordering_paid_status') => str(setting('ordering_paid_status'))->ucfirst(),
                ]
            )
            ->boolFilter(key: 'is_approved')
            ->dateFilter()
            ->defaultSort('id', 'desc')
            ->column(
                key: 'id',
                label: __('Id'),
                hidden: true,
                sortable: true,
            )
            ->column(
                key: 'status',
                label: __('Status'),
                sortable: true
            )
            ->column(
                key: 'uuid',
                label: __('Uuid'),
                sortable: true
            )
            ->column(
                key: 'source',
                label: __('Source'),
                sortable: true
            )
            ->column(
                key: 'name',
                label: __('Name'),
                sortable: true
            )
            ->column(
                key: 'phone',
                label: __('Phone'),
                sortable: true
            )
            ->column(
                key: 'total',
                label: __('Total'),
                sortable: true
            )
            ->column(
                key: 'created_at',
                label: __('Created At'),
                sortable: true
            )
            ->column(key: 'actions',label: trans('tomato-admin::global.crud.actions'))
            ->paginate(10);


        if(auth('web')->user() && class_exists(TomatoRoles::class)){
            if(auth('web')->user()->can('admin.orders.export')){
                $table->export();
            }
            if(auth('web')->user()->can('admin.orders.destroy')){
                $table->bulkAction(
                    label: trans('tomato-admin::global.crud.delete'),
                    each: fn (\Modules\TomatoOrders\App\Models\Order $model) => $model->delete(),
                    after: fn () => Toast::danger(__('Order Has Been Deleted'))->autoDismiss(2),
                    confirm: true
                );
            }
        }
        else {
            $table->bulkAction(
                label: trans('tomato-admin::global.crud.delete'),
                each: fn (\Modules\TomatoOrders\App\Models\Order $model) => $model->delete(),
                after: fn () => Toast::danger(__('Order Has Been Deleted'))->autoDismiss(2),
                confirm: true
            );
            $table->export();
        }
    }
}
