<x-tomato-admin-container label="{{trans('tomato-admin::global.crud.create')}} {{__('Delivery')}}">
    <x-splade-form class="flex flex-col space-y-4" action="{{route('admin.deliveries.store')}}" method="post">
        <x-splade-select
            choices
            remote-url="{{route('admin.shipping-vendors.api')}}"
            remote-root="data"
            name="shipping_vendor_id"
            label="{{__('Shipping Vendor')}}"
            placeholder="{{__('Shipping Vendor')}}"
            option-label="name"
            option-value="id"
        />

          <x-splade-input :label="__('Name')" name="name" type="text"  :placeholder="__('Name')" />
          <x-splade-input :label="__('Phone')" :placeholder="__('Phone')" type='tel' name="phone" />
          <x-splade-input :label="__('Address')" name="address" type="text"  :placeholder="__('Address')" />
          <x-splade-checkbox :label="__('Is activated')" name="is_activated" />

        <div class="flex justify-start gap-2 pt-3">
            <x-tomato-admin-submit  label="{{__('Save')}}" :spinner="true" />
            <x-tomato-admin-button secondary :href="route('admin.deliveries.index')" label="{{__('Cancel')}}"/>
        </div>
    </x-splade-form>
</x-tomato-admin-container>
