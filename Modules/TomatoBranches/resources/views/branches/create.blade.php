<x-tomato-admin-container label="{{trans('tomato-admin::global.crud.create')}} {{__('Branch')}}">
    <x-splade-form class="flex flex-col space-y-4" action="{{route('admin.branches.store')}}" method="post">

          <x-splade-select
              choices
              :label="__('Company Name')"
              name="company_id"
              :placeholder="__('Company Name')"
              remote-root="data"
              remote-url="{{route('admin.companies.api')}}"
              option-label="name"
              option-value="id"
          />
          <x-splade-input :label="__('Name')" name="name" type="text"  :placeholder="__('Name')" />
          <x-splade-input :label="__('Branch Number')" name="branch_number" type="number"  :placeholder="__('Branch Number')" />
        <x-splade-input :label="__('Phone')" :placeholder="__('Phone')" type='tel' name="phone" />
          <x-splade-input :label="__('Address')" name="address" type="text"  :placeholder="__('Address')" />

        <div class="flex justify-start gap-2 pt-3">
            <x-tomato-admin-submit  label="{{__('Save')}}" :spinner="true" />
            <x-tomato-admin-button secondary :href="route('admin.branches.index')" label="{{__('Cancel')}}"/>
        </div>
    </x-splade-form>
</x-tomato-admin-container>
