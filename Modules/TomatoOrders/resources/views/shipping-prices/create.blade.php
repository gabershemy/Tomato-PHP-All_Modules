<x-tomato-admin-container label="{{trans('tomato-admin::global.crud.create')}} {{__('Shipping Price')}}">
    <x-splade-form class="flex flex-col space-y-4" action="{{route('admin.shipping-prices.store')}}" method="post" :default="['type' => 'boy']">

        <x-splade-select choices :label="__('Type')" name="type" :placeholder="__('Type')">
            <option value="boy">{{__('Delivery Boy')}}</option>
            <option value="company">{{__('Shipping Company')}}</option>
        </x-splade-select>

          <x-splade-select v-if="form.type === 'company'" :label="__('Shipping vendor')" :placeholder="__('Shipping vendor')" name="shipping_vendor_id" remote-url="/admin/shipping-vendors/api" remote-root="data" option-label="name" option-value="id" choices/>
          <x-splade-select v-if="form.type === 'boy'" :label="__('Delivery')" :placeholder="__('Delivery')" name="delivery_id" remote-url="/admin/deliveries/api" remote-root="data" option-label="name" option-value="id" choices/>
          <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
              <x-splade-select :label="__('Country')" :placeholder="__('Country')" name="country_id" remote-url="/admin/countries/api" remote-root="data" option-label=name option-value="id" choices/>
              <x-splade-select :label="__('City')" :placeholder="__('City')" name="city_id" remote-url="`/admin/cities/api?country_id=${form.country_id}`" remote-root="data" option-label=name option-value="id" choices/>
              <x-splade-select :label="__('Area')" :placeholder="__('Area')" name="area_id" remote-url="`/admin/areas/api?city_id=${form.city_id}`" remote-root="data" option-label=name option-value="id" choices/>
          </div>
        <x-splade-input :label="__('Price')" :placeholder="__('Price')" type='number' name="price" />

        <div class="flex justify-start gap-2 pt-3">
            <x-tomato-admin-submit  label="{{__('Save')}}" :spinner="true" />
            <x-tomato-admin-button secondary :href="route('admin.shipping-prices.index')" label="{{__('Cancel')}}"/>
        </div>
    </x-splade-form>
</x-tomato-admin-container>
