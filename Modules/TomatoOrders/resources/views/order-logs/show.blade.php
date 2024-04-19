<x-tomato-admin-container label="{{trans('tomato-admin::global.crud.view')}} {{__('Order Logs')}} #{{$model->id}}">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
        
          <x-tomato-admin-row :label="__('User')" :value="$model->User->name" type="text" />

          <x-tomato-admin-row :label="__('Order')" :value="$model->Order->name" type="text" />

          <x-tomato-admin-row :label="__('Status')" :value="$model->status" type="string" />

          <x-tomato-admin-row :label="__('Note')" :value="$model->note" type="text" />

          <x-tomato-admin-row :label="__('Is closed')" :value="$model->is_closed" type="bool" />

    </div>
    <div class="flex justify-start gap-2 pt-3">
        <x-tomato-admin-button warning label="{{__('Edit')}}" :href="route('admin.order-logs.edit', $model->id)"/>
        <x-tomato-admin-button danger :href="route('admin.order-logs.destroy', $model->id)"
                               confirm="{{trans('tomato-admin::global.crud.delete-confirm')}}"
                               confirm-text="{{trans('tomato-admin::global.crud.delete-confirm-text')}}"
                               confirm-button="{{trans('tomato-admin::global.crud.delete-confirm-button')}}"
                               cancel-button="{{trans('tomato-admin::global.crud.delete-confirm-cancel-button')}}"
                               method="delete"  label="{{__('Delete')}}" />
        <x-tomato-admin-button secondary :href="route('admin.order-logs.index')" label="{{__('Cancel')}}"/>
    </div>
</x-tomato-admin-container>
