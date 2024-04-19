<x-tomato-admin-container label="{{trans('tomato-admin::global.crud.view')}} {{__('Orders Items')}} #{{$model->id}}">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
        
          <x-tomato-admin-row :label="__('Order')" :value="$model->Order->name" type="text" />

          <x-tomato-admin-row :label="__('Account')" :value="$model->Account->name" type="text" />

          <x-tomato-admin-row :label="__('Product')" :value="$model->Product->name" type="text" />

          
          
          <x-tomato-admin-row :label="__('Item')" :value="$model->item" type="string" />

          <x-tomato-admin-row :label="__('Price')" :value="$model->price" type="number" />

          <x-tomato-admin-row :label="__('Discount')" :value="$model->discount" type="number" />

          <x-tomato-admin-row :label="__('Tax')" :value="$model->tax" type="number" />

          <x-tomato-admin-row :label="__('Total')" :value="$model->total" type="number" />

          <x-tomato-admin-row :label="__('Returned')" :value="$model->returned" type="number" />

          <x-tomato-admin-row :label="__('Qty')" :value="$model->qty" type="number" />

          <x-tomato-admin-row :label="__('Returned qty')" :value="$model->returned_qty" type="number" />

          <x-tomato-admin-row :label="__('Is free')" :value="$model->is_free" type="bool" />

          <x-tomato-admin-row :label="__('Is returned')" :value="$model->is_returned" type="bool" />

          
    </div>
    <div class="flex justify-start gap-2 pt-3">
        <x-tomato-admin-button warning label="{{__('Edit')}}" :href="route('admin.orders-items.edit', $model->id)"/>
        <x-tomato-admin-button danger :href="route('admin.orders-items.destroy', $model->id)"
                               confirm="{{trans('tomato-admin::global.crud.delete-confirm')}}"
                               confirm-text="{{trans('tomato-admin::global.crud.delete-confirm-text')}}"
                               confirm-button="{{trans('tomato-admin::global.crud.delete-confirm-button')}}"
                               cancel-button="{{trans('tomato-admin::global.crud.delete-confirm-cancel-button')}}"
                               method="delete"  label="{{__('Delete')}}" />
        <x-tomato-admin-button secondary :href="route('admin.orders-items.index')" label="{{__('Cancel')}}"/>
    </div>
</x-tomato-admin-container>
