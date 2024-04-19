<?php

namespace Modules\TomatoOrders\App\Tables;

use Illuminate\Http\Request;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\Facades\Toast;
use ProtoneMedia\Splade\SpladeTable;
use Illuminate\Database\Eloquent\Builder;
use Modules\TomatoRoles\App\Services\TomatoRoles;

class ShippingVendorTable extends AbstractTable
{
    /**
     * Create a new instance.
     *
     * @return void
     */
    public function __construct(public mixed $query=null)
    {
        if(!$query){
            $this->query = \Modules\TomatoOrders\App\Models\ShippingVendor::query();
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
            return auth('web')->user()->can('admin.shipping-vendors.index');
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
                sortable: true
            )
            ->column(
                key: 'name',
                label: __('Name'),
                sortable: true
            )
            ->column(
                key: 'contact_person',
                label: __('Contact person'),
                sortable: true
            )
            ->column(
                key: 'phone',
                label: __('Phone'),
                sortable: true
            )
            ->column(
                key: 'address',
                label: __('Address'),
                sortable: true
            )
            ->column(
                key: 'is_activated',
                label: __('Is activated'),
                sortable: true
            )
            ->column(key: 'actions',label: trans('tomato-admin::global.crud.actions'))
            ->paginate(10);



        if(auth('web')->user() && class_exists(TomatoRoles::class)){
            if(auth('web')->user()->can('admin.shipping-vendors.export')){
                $table->export();
            }
            if(auth('web')->user()->can('admin.shipping-vendors.destroy')){
                $table->bulkAction(
                    label: trans('tomato-admin::global.crud.delete'),
                    each: fn (\Modules\TomatoOrders\App\Models\ShippingVendor $model) => $model->delete(),
                    after: fn () => Toast::danger(__('Shipping Vendor Has Been Deleted'))->autoDismiss(2),
                    confirm: true
                );
            }
        }
        else {
            $table->bulkAction(
                label: trans('tomato-admin::global.crud.delete'),
                each: fn (\Modules\TomatoOrders\App\Models\ShippingVendor $model) => $model->delete(),
                after: fn () => Toast::danger(__('Shipping Vendor Has Been Deleted'))->autoDismiss(2),
                confirm: true
            );
            $table->export();
        }
    }
}
