<?php

namespace Modules\TomatoOrders\App\Tables;

use Illuminate\Http\Request;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\Facades\Toast;
use ProtoneMedia\Splade\SpladeTable;
use Illuminate\Database\Eloquent\Builder;
use Modules\TomatoRoles\App\Services\TomatoRoles;

class ShippingPriceTable extends AbstractTable
{
    /**
     * Create a new instance.
     *
     * @return void
     */
    public function __construct(public mixed $query=null)
    {
        if(!$query){
            $this->query = \Modules\TomatoOrders\App\Models\ShippingPrice::query();
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
            return auth('web')->user()->can('admin.shipping-prices.index');
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
            ->defaultSort('id', 'desc')
            ->column(
                key: 'id',
                label: __('Id'),
                sortable: true
            )
            ->column(
                key: 'shippingVendor.name',
                label: __('Shipping vendor'),
                sortable: true
            )
            ->column(
                key: 'delivery.name',
                label: __('Delivery'),
                sortable: true
            )
            ->column(
                key: 'country.name',
                label: __('Country'),
                sortable: true
            )
            ->column(
                key: 'city.name',
                label: __('City'),
                sortable: true
            )
            ->column(
                key: 'area.name',
                label: __('Area'),
                sortable: true
            )
            ->column(
                key: 'price',
                label: __('Price'),
                sortable: true
            )
            ->column(key: 'actions',label: trans('tomato-admin::global.crud.actions'))
            ->paginate(10);


        if(auth('web')->user() && class_exists(TomatoRoles::class)){
            if(auth('web')->user()->can('admin.shipping-prices.export')){
                $table->export();
            }
            if(auth('web')->user()->can('admin.shipping-prices.destroy')){
                $table->bulkAction(
                    label: trans('tomato-admin::global.crud.delete'),
                    each: fn (\Modules\TomatoOrders\App\Models\ShippingPrice $model) => $model->delete(),
                    after: fn () => Toast::danger(__('Shipping Price Has Been Deleted'))->autoDismiss(2),
                    confirm: true
                );
            }
        }
        else {
            $table->bulkAction(
                label: trans('tomato-admin::global.crud.delete'),
                each: fn (\Modules\TomatoOrders\App\Models\ShippingPrice $model) => $model->delete(),
                after: fn () => Toast::danger(__('Shipping Price Has Been Deleted'))->autoDismiss(2),
                confirm: true
            );
            $table->export();
        }
    }
}
