<x-tomato-admin-container label="{{trans('tomato-admin::global.crud.view')}} {{__('Shipping Prices')}} #{{$model->id}}">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">

          <x-tomato-admin-row :label="__('Shipping vendor')" :value="$model->Shipping_vendor->name" type="text" />

          <x-tomato-admin-row :label="__('Delivery')" :value="$model->Delivery->name" type="text" />

          <x-tomato-admin-row :label="__('Country')" :value="$model->Country->name" type="text" />

          <x-tomato-admin-row :label="__('City')" :value="$model->City->name" type="text" />

          <x-tomato-admin-row :label="__('Area')" :value="$model->Area->name" type="text" />

          <x-tomato-admin-row :label="__('Type')" :value="$model->type" type="string" />

          <x-tomato-admin-row :label="__('Price')" :value="$model->price" type="number" />

    </div>
    <div class="flex justify-start gap-2 pt-3">
        <x-tomato-admin-button warning label="{{__('Edit')}}" :href="route('admin.shipping-prices.edit', $model->id)"/>
        <x-tomato-admin-button danger :href="route('admin.shipping-prices.destroy', $model->id)"
                               confirm="{{trans('tomato-admin::global.crud.delete-confirm')}}"
                               confirm-text="{{trans('tomato-admin::global.crud.delete-confirm-text')}}"
                               confirm-button="{{trans('tomato-admin::global.crud.delete-confirm-button')}}"
                               cancel-button="{{trans('tomato-admin::global.crud.delete-confirm-cancel-button')}}"
                               method="delete"  label="{{__('Delete')}}" />
        <x-tomato-admin-button secondary :href="route('admin.shipping-prices.index')" label="{{__('Cancel')}}"/>
    </div>
</x-tomato-admin-container>
