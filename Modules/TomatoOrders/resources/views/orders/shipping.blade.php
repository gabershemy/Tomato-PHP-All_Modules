<x-tomato-admin-container label="{{__('Shipping Order')}} # {{$model->uuid}}">
    <x-splade-form method="POST" action="{{route('admin.orders.ship', $model->id)}}" :default="array_merge($model->toArray(), [
        'shipping' => ($model->shipping > 0) ? $model->shipping : (setting('ordering_active_shipping_fees') ? setting('ordering_shipping_fees') : 0),
    ])" class="flex flex-col gap-4">
        <x-splade-select
            choices
            remote-url="{{route('admin.shipping-vendors.api')}}"
            remote-root="data"
            name="shipping_vendor_id"
            label="{{__('Shipping vendor')}}"
            placeholder="{{__('Shipping vendor')}}"
            option-label="name"
            option-value="id"
        />
        <x-splade-select
            choices
            v-bind:disabled="!form.shipping_vendor_id"
            remote-url="`{{route('admin.deliveries.api')}}?shipping_vendor_id=${form.shipping_vendor_id}`"
            remote-root="data"
            name="shipper_id"
            label="{{__('Shipping Delivery Boy')}}"
            placeholder="{{__('Shipping Delivery Boy')}}"
            option-label="name"
            option-value="id"
        />
        <x-splade-textarea name="address" type="text"  label="{{__('Address')}}" placeholder="{{__('Your Address')}}" />
        <div class="grid grid-cols-1 gap-4 lg:grid-cols-3">
            <x-splade-select
                choices
                remote-url="{{route('admin.countries.api')}}"
                remote-root="data"
                name="country_id"
                label="{{__('County')}}"
                placeholder="{{__('Your County')}}"
                option-label="name"
                option-value="id"
            />
            <x-splade-select
                choices
                remote-url="`{{route('admin.cities.api') . '?country_id='}}${form.country_id}`"
                remote-root="data"
                name="city_id"
                label="{{__('City')}}"
                placeholder="{{__('Your City')}}"
                option-label="name"
                option-value="id"
            />
            <x-splade-select
                choices
                remote-url="`{{route('admin.areas.api') . '?city_id='}}${form.city_id}`"
                remote-root="data"
                name="area_id"
                label="{{__('Area')}}"
                placeholder="{{__('Your Area')}}"
                option-label="name"
                option-value="id"
            />
        </div>

        <x-tomato-admin-submit spinner label="{{__('Ship')}}" />
    </x-splade-form>
</x-tomato-admin-container>
