<x-tomato-admin-container label="{{trans('tomato-admin::global.crud.create')}} {{__('Company')}}">
    <x-splade-form :default="['country_id' => setting('local_country')]" class="flex flex-col space-y-4" action="{{route('admin.companies.store')}}" method="post">

        <x-splade-file filepond preview name="logo" />
          <x-splade-select
              :label="__('Country')"
              :placeholder="__('Country')"
              name="country_id"
              :remote-url="route('admin.countries.api')"
              remote-root="data"
              option-label="name"
              option-value="id"
              choices
          />
          <x-splade-input :label="__('Name')" name="name" type="text"  :placeholder="__('Name')" required/>
          <x-splade-input :label="__('Ceo')" name="ceo" type="text"  :placeholder="__('Ceo')" />
          <x-splade-input :label="__('Address')" name="address" type="text"  :placeholder="__('Address')" />
          <x-splade-input :label="__('City')" name="city" type="text"  :placeholder="__('City')" />
          <x-splade-input :label="__('Zip')" name="zip" type="text"  :placeholder="__('Zip')" />
          <x-splade-input :label="__('Registration number')" name="registration_number" type="text"  :placeholder="__('Registration number')" />
          <x-splade-input :label="__('Tax number')" name="tax_number" type="text"  :placeholder="__('Tax number')" />
          <x-splade-input :label="__('Email')" name="email" type="email"  :placeholder="__('Email')" />
          <x-splade-input :label="__('Phone')" :placeholder="__('Phone')" type='tel' name="phone" />
          <x-splade-input :label="__('Website')" name="website" type="text"  :placeholder="__('Website')" />
          <x-splade-textarea :label="__('Notes')" name="notes" :placeholder="__('Notes')" autosize />

        <div class="flex justify-start gap-2 pt-3">
            <x-tomato-admin-submit  label="{{__('Save')}}" :spinner="true" />
            <x-tomato-admin-button secondary :href="route('admin.companies.index')" label="{{__('Cancel')}}"/>
        </div>
    </x-splade-form>
</x-tomato-admin-container>
