<?php

namespace Modules\TomatoCoupons\App\Tables;

use Illuminate\Http\Request;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\Facades\Toast;
use ProtoneMedia\Splade\SpladeTable;
use Illuminate\Database\Eloquent\Builder;

class CouponTable extends AbstractTable
{
    /**
     * Create a new instance.
     *
     * @return void
     */
    public function __construct()
    {

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
        return  \Modules\TomatoCoupons\App\Models\Coupon::query();
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
                columns: ['id','code',]
            )
            ->bulkAction(
                label: trans('tomato-admin::global.crud.delete'),
                each: fn (\Modules\TomatoCoupons\App\Models\Coupon $model) => $model->delete(),
                after: fn () => Toast::danger(__('Coupon Has Been Deleted'))->autoDismiss(2),
                confirm: true
            )
            ->defaultSort('id', 'desc')
            ->column(
                key: 'id',
                label: __('ID'),
                hidden: true,
                sortable: true
            )
            ->column(
                key: 'code',
                label: __('Code'),
                sortable: true
            )
            ->column(
                key: 'amount',
                label: __('Amount'),
                sortable: true
            )
            ->column(
                key: 'is_activated',
                label: __('Is activated'),
                sortable: true
            )
            ->column(key: 'actions',label: trans('tomato-admin::global.crud.actions'))
            ->export()
            ->paginate(10);
    }
}
