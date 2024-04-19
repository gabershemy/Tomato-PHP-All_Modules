<x-tomato-admin-container label="{{trans('tomato-admin::global.crud.view')}} {{__('inventory-reports')}} #{{$model->id}}">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
        
          <x-tomato-admin-row :label="__('Branch')" :value="$model->Branch->name" type="text" />

          <x-tomato-admin-row :label="__('Item type')" :value="$model->item_type" type="string" />

          
          <x-tomato-admin-row :label="__('Qty')" :value="$model->qty" type="number" />

          
    </div>
    <div class="flex justify-start gap-2 pt-3">
        <x-tomato-admin-button warning label="{{__('Edit')}}" :href="route('admin.inventory-reports.edit', $model->id)"/>
        <x-tomato-admin-button danger :href="route('admin.inventory-reports.destroy', $model->id)"
                               confirm="{{trans('tomato-admin::global.crud.delete-confirm')}}"
                               confirm-text="{{trans('tomato-admin::global.crud.delete-confirm-text')}}"
                               confirm-button="{{trans('tomato-admin::global.crud.delete-confirm-button')}}"
                               cancel-button="{{trans('tomato-admin::global.crud.delete-confirm-cancel-button')}}"
                               method="delete"  label="{{__('Delete')}}" />
        <x-tomato-admin-button secondary :href="route('admin.inventory-reports.index')" label="{{__('Cancel')}}"/>
    </div>
</x-tomato-admin-container>
