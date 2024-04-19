<?php

namespace Modules\TomatoInvoices\App\Tables;

use Illuminate\Http\Request;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\Facades\Toast;
use ProtoneMedia\Splade\SpladeTable;
use Modules\TomatoInvoices\App\Services\TomatoRoles;

class InvoiceTable extends AbstractTable
{
    /**
     * Create a new instance.
     *
     * @return void
     */
    public function __construct(public mixed $query=null)
    {
        if(!$query){
            $this->query = \Modules\TomatoInvoices\App\Models\Invoice::query();
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
                columns: ['id','uuid','name','phone',]
            )
            ->defaultSort('id', 'desc')
            ->column(
                key: 'id',
                label: __('Id'),
                hidden: true,
                sortable: true
            )
            ->column(
                key: 'uuid',
                label: __('Uuid'),
                sortable: true
            )
            ->column(
                key: 'user.name',
                label: __('User id'),
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
                key: 'type',
                label: __('Type'),
                sortable: true
            )
            ->column(
                key: 'status',
                label: __('Status'),
                sortable: true
            )
            ->column(
                key: 'total',
                label: __('Total'),
                sortable: true
            )
            ->column(
                key: 'paid',
                label: __('Paid'),
                sortable: true
            )
            ->column(
                key: 'due_date',
                label: __('Due date'),
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
            if(auth('web')->user()->can('admin.invoices.export')){
                $table->export();
            }
            if(auth('web')->user()->can('admin.invoices.destroy')){
                $table->bulkAction(
                    label: trans('tomato-admin::global.crud.delete'),
                    each: fn (\Modules\TomatoInvoices\App\Models\Invoice $model) => $model->delete(),
                    after: fn () => Toast::danger(__('Invoice Has Been Deleted'))->autoDismiss(2),
                    confirm: true
                );
            }
        }
        else {
            $table->bulkAction(
                label: trans('tomato-admin::global.crud.delete'),
                each: fn (\Modules\TomatoInvoices\App\Models\Invoice $model) => $model->delete(),
                after: fn () => Toast::danger(__('Invoice Has Been Deleted'))->autoDismiss(2),
                confirm: true
            );
            $table->export();
        }
    }
}
