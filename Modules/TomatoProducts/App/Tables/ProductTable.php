<?php

namespace Modules\TomatoProducts\App\Tables;

use Illuminate\Http\Request;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\Facades\Toast;
use ProtoneMedia\Splade\SpladeTable;
use Illuminate\Database\Eloquent\Builder;
use Modules\TomatoInventory\App\Facades\TomatoInventory;
use Modules\TomatoOrders\App\Facades\TomatoOrdering;
use Modules\TomatoRoles\App\Services\TomatoRoles;

class ProductTable extends AbstractTable
{
    /**
     * Create a new instance.
     *
     * @return void
     */
    public function __construct(public mixed $query=null)
    {
        if(!$query){
            $this->query = \Modules\TomatoProducts\App\Models\Product::query();
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
            return auth('web')->user()->can('admin.products.index');
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
                columns: ['id','name','sku','barcode',]
            )
            ->selectFilter(
                label: __('Type'),
                key: 'type',
                options: [
                    'product' =>  __('Product'),
                    'digital' =>  __('Digital'),
                ],
            )
            ->bulkAction(
                label: __('Attach Category'),
                type: 'modal',
                href: route('admin.products.category.attach'),
                style:'primary'
            )
            ->boolFilter(
                label: __('Is Activated?'),
                key: 'is_activated'
            )
            ->boolFilter(
                label: __('Is Trend?'),
                key: 'is_trend'
            )
            ->boolFilter(
                label: __('Is Shipped?'),
                key: 'is_shipped'
            )
            ->boolFilter(
                label: __('Has Options?'),
                key: 'has_options'
            )
            ->boolFilter(
                label: __('Has unlimited stock?'),
                key: 'has_unlimited_stock'
            )
            ->defaultSort('id', 'desc')
            ->column(
                key: 'id',
                label: __('Id'),
                sortable: true
            )
            ->column(
                key: 'category_id',
                label: __('Category id'),
                sortable: true
            )
            ->column(
                key: 'name',
                label: __('Name'),
                searchable: true,
                sortable: true
            )
            ->column(
                key: 'slug',
                label: __('Slug'),
                sortable: true
            )
            ->column(
                key: 'sku',
                label: __('Sku'),
                searchable: true,
                sortable: true
            )
            ->column(
                key: 'barcode',
                label: __('Barcode'),
                searchable: true,
                sortable: true
            )
            ->column(
                key: 'type',
                label: __('Type'),
                sortable: true
            )
            ->column(
                key: 'about',
                label: __('About'),
                sortable: true
            )
            ->column(
                key: 'description',
                label: __('Description'),
                sortable: true
            )
            ->column(
                key: 'details',
                label: __('Details'),
                sortable: true
            )
            ->column(
                key: 'price',
                label: __('Price'),
                sortable: true
            )
            ->column(
                key: 'discount',
                label: __('Discount'),
                sortable: true
            )
            ->column(
                key: 'discount_to',
                label: __('Discount to'),
                sortable: true
            )
            ->column(
                key: 'vat',
                label: __('Vat'),
                sortable: true
            )
            ->column(
                key: 'is_in_stock',
                label: __('Is in stock'),
                sortable: true
            )
            ->column(
                key: 'is_activated',
                label: __('Is activated'),
                sortable: true
            )
            ->column(
                key: 'is_shipped',
                label: __('Is shipped'),
                sortable: true
            )
            ->column(
                key: 'is_trend',
                label: __('Is trend'),
                sortable: true
            )
            ->column(
                key: 'has_options',
                label: __('Has options'),
                sortable: true
            )
            ->column(
                key: 'has_multi_price',
                label: __('Has multi price'),
                sortable: true
            )
            ->column(
                key: 'has_unlimited_stock',
                label: __('Has unlimited stock'),
                sortable: true
            )
            ->column(
                key: 'has_max_cart',
                label: __('Has max cart'),
                sortable: true
            )
            ->column(
                key: 'min_cart',
                label: __('Min cart'),
                sortable: true
            )
            ->column(
                key: 'max_cart',
                label: __('Max cart'),
                sortable: true
            )
            ->column(
                key: 'has_socket_alert',
                label: __('Has socket alert'),
                sortable: true
            )
            ->column(
                key: 'min_socket_alert',
                label: __('Min socket alert'),
                sortable: true
            )
            ->column(
                key: 'max_socket_alert',
                label: __('Max socket alert'),
                sortable: true
            )
            ->column(key: 'actions',label: trans('tomato-admin::global.crud.actions'))
            ->paginate(15);


        if(auth('web')->user() && class_exists(TomatoRoles::class)){
            if(auth('web')->user()->can('admin.products.export')){
                $table->export();
            }
            if(auth('web')->user()->can('admin.products.destroy')){
                $table->bulkAction(
                    label: trans('tomato-admin::global.crud.delete'),
                    each: fn (\Modules\TomatoProducts\App\Models\Product $model) => $model->delete(),
                    after: fn () => Toast::danger(__('Product Has Been Deleted'))->autoDismiss(2),
                    confirm: true
                );
            }
        }
        else {
            $table->bulkAction(
                label: trans('tomato-admin::global.crud.delete'),
                each: fn (\Modules\TomatoProducts\App\Models\Product $model) => $model->delete(),
                after: fn () => Toast::danger(__('Product Has Been Deleted'))->autoDismiss(2),
                confirm: true
            );
            $table->export();
        }

        if(class_exists(TomatoInventory::class)){
            $table->bulkAction(
                label: __('Create Inventory Request'),
                type: 'modal',
                href: route('admin.products.inventory.attach'),
                style:'primary'
            );

        }

        if(class_exists(TomatoOrdering::class)){
            $table->bulkAction(
                label: __('Create New Order'),
                type: 'modal',
                href: route('admin.products.orders.attach'),
                style:'primary'
            );

        }
    }
}
