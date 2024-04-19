<?php

namespace Modules\TomatoWallet\App\Tables;

use Illuminate\Http\Request;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\Facades\Toast;
use ProtoneMedia\Splade\SpladeTable;
use Illuminate\Database\Eloquent\Builder;

class PaymentTable extends AbstractTable
{
    /**
     * Create a new instance.
     *
     * @return void
     */
    public function __construct(public Builder|null $query=null)
    {
        if(!$query){
            $this->query = \Modules\TomatoWallet\App\Models\Payment::query();
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
                columns: ['id','uuid',]
            )
            ->bulkAction(
                label: trans('tomato-admin::global.crud.delete'),
                each: fn (\Modules\TomatoWallet\App\Models\Payment $model) => $model->delete(),
                after: fn () => Toast::danger(__('Payment Has Been Deleted'))->autoDismiss(2),
                confirm: true
            )
            ->defaultSort('id', 'desc')
            ->column(
                key: 'id',
                label: __('Id'),
                sortable: true
            )
            ->column(
                key: 'payment_status_id',
                label: __('Payment status id'),
                sortable: true
            )
            ->column(
                key: 'uuid',
                label: __('Uuid'),
                sortable: true
            )
            ->column(
                key: 'model_id',
                label: __('Model id'),
                sortable: true
            )
            ->column(
                key: 'model_table',
                label: __('Model table'),
                sortable: true
            )
            ->column(
                key: 'order_id',
                label: __('Order id'),
                sortable: true
            )
            ->column(
                key: 'order_table',
                label: __('Order table'),
                sortable: true
            )
            ->column(
                key: 'type',
                label: __('Type'),
                sortable: true
            )
            ->column(
                key: 'payment_method',
                label: __('Payment method'),
                sortable: true
            )
            ->column(
                key: 'transaction_vendor',
                label: __('Transaction vendor'),
                sortable: true
            )
            ->column(
                key: 'transaction_code',
                label: __('Transaction code'),
                sortable: true
            )
            ->column(
                key: 'amount',
                label: __('Amount'),
                sortable: true
            )
            ->column(
                key: 'notes',
                label: __('Notes'),
                sortable: true
            )
            ->column(
                key: 'currency',
                label: __('Currency'),
                sortable: true
            )
            ->column(key: 'actions',label: trans('tomato-admin::global.crud.actions'))
            ->export()
            ->paginate(10);
    }
}
