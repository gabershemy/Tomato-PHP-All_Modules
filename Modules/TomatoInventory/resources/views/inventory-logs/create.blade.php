<x-tomato-admin-container label="{{trans('tomato-admin::global.crud.create')}} {{__('InventoryLog')}}">
    <x-splade-form class="flex flex-col space-y-4" action="{{route('admin.inventory-logs.store')}}" method="post">
        
          <x-splade-select :label="__('User id')" :placeholder="__('User id')" name="user_id" remote-url="/admin/users/api" remote-root="model.data" option-label=name option-value="id" choices/>
          <x-splade-select :label="__('Inventory id')" :placeholder="__('Inventory id')" name="inventory_id" remote-url="/admin/inventories/api" remote-root="model.data" option-label=name option-value="id" choices/>
          <x-splade-input :label="__('Status')" name="status" type="text"  :placeholder="__('Status')" />
          <x-splade-textarea :label="__('Note')" name="note" :placeholder="__('Note')" autosize />
          <x-splade-checkbox :label="__('Is closed')" name="is_closed" label="Is closed" />

        <div class="flex justify-start gap-2 pt-3">
            <x-tomato-admin-submit  label="{{__('Save')}}" :spinner="true" />
            <x-tomato-admin-button secondary :href="route('admin.inventory-logs.index')" label="{{__('Cancel')}}"/>
        </div>
    </x-splade-form>
</x-tomato-admin-container>
