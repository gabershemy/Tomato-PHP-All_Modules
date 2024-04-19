<x-tomato-admin-container label="{{trans('tomato-admin::global.crud.edit')}} {{__('InventoryReport')}} #{{$model->id}}">
    <x-splade-form class="flex flex-col space-y-4" action="{{route('admin.inventory-reports.update', $model->id)}}" method="post" :default="$model">
        
          <x-splade-select :label="__('Branch id')" :placeholder="__('Branch id')" name="branch_id" remote-url="/admin/branches/api" remote-root="model.data" option-label=name option-value="id" choices/>
          <x-splade-input :label="__('Item type')" name="item_type" type="text"  :placeholder="__('Item type')" />
          
          <x-splade-input :label="__('Qty')" :placeholder="__('Qty')" type='number' name="qty" />
          

        <div class="flex justify-start gap-2 pt-3">
            <x-tomato-admin-submit  label="{{__('Save')}}" :spinner="true" />
            <x-tomato-admin-button danger :href="route('admin.inventory-reports.destroy', $model->id)"
                                   confirm="{{trans('tomato-admin::global.crud.delete-confirm')}}"
                                   confirm-text="{{trans('tomato-admin::global.crud.delete-confirm-text')}}"
                                   confirm-button="{{trans('tomato-admin::global.crud.delete-confirm-button')}}"
                                   cancel-button="{{trans('tomato-admin::global.crud.delete-confirm-cancel-button')}}"
                                   method="delete"  label="{{__('Delete')}}" />
            <x-tomato-admin-button secondary :href="route('admin.inventory-reports.index')" label="{{__('Cancel')}}"/>
        </div>
    </x-splade-form>
</x-tomato-admin-container>
