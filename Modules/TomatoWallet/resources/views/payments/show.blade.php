<x-tomato-admin-container label="{{trans('tomato-admin::global.crud.view')}} {{__('payments')}} #{{$model->id}}">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
        
          <x-tomato-admin-row :label="__('Payment status')" :value="$model->Payment_status->name" type="text" />

          <x-tomato-admin-row :label="__('Uuid')" :value="$model->uuid" type="string" />

          
          <x-tomato-admin-row :label="__('Model table')" :value="$model->model_table" type="string" />

          
          <x-tomato-admin-row :label="__('Order table')" :value="$model->order_table" type="string" />

          <x-tomato-admin-row :label="__('Type')" :value="$model->type" type="string" />

          <x-tomato-admin-row :label="__('Payment method')" :value="$model->payment_method" type="string" />

          <x-tomato-admin-row :label="__('Transaction vendor')" :value="$model->transaction_vendor" type="string" />

          <x-tomato-admin-row :label="__('Transaction code')" :value="$model->transaction_code" type="string" />

          <x-tomato-admin-row :label="__('Amount')" :value="$model->amount" type="number" />

          <x-tomato-admin-row :label="__('Notes')" :value="$model->notes" type="string" />

          <x-tomato-admin-row :label="__('Currency')" :value="$model->currency" type="string" />

    </div>
    <div class="flex justify-start gap-2 pt-3">
        <x-tomato-admin-button warning label="{{__('Edit')}}" :href="route('admin.payments.edit', $model->id)"/>
        <x-tomato-admin-button danger :href="route('admin.payments.destroy', $model->id)"
                               confirm="{{trans('tomato-admin::global.crud.delete-confirm')}}"
                               confirm-text="{{trans('tomato-admin::global.crud.delete-confirm-text')}}"
                               confirm-button="{{trans('tomato-admin::global.crud.delete-confirm-button')}}"
                               cancel-button="{{trans('tomato-admin::global.crud.delete-confirm-cancel-button')}}"
                               method="delete"  label="{{__('Delete')}}" />
        <x-tomato-admin-button secondary :href="route('admin.payments.index')" label="{{__('Cancel')}}"/>
    </div>
</x-tomato-admin-container>
