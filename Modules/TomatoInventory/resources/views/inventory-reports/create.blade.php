<x-tomato-admin-container label="{{trans('tomato-admin::global.crud.create')}} {{__('InventoryReport')}}">
    <x-splade-form class="flex flex-col space-y-4" action="{{route('admin.inventory-reports.store')}}" method="post">
        
          <x-splade-select :label="__('Branch id')" :placeholder="__('Branch id')" name="branch_id" remote-url="/admin/branches/api" remote-root="model.data" option-label=name option-value="id" choices/>
          <x-splade-input :label="__('Item type')" name="item_type" type="text"  :placeholder="__('Item type')" />
          
          <x-splade-input :label="__('Qty')" :placeholder="__('Qty')" type='number' name="qty" />
          

        <div class="flex justify-start gap-2 pt-3">
            <x-tomato-admin-submit  label="{{__('Save')}}" :spinner="true" />
            <x-tomato-admin-button secondary :href="route('admin.inventory-reports.index')" label="{{__('Cancel')}}"/>
        </div>
    </x-splade-form>
</x-tomato-admin-container>
