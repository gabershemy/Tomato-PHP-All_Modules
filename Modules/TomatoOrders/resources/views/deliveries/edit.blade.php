<x-tomato-admin-container label="{{trans('tomato-admin::global.crud.edit')}} {{__('Delivery')}} #{{$model->id}}">
    <x-splade-form class="flex flex-col space-y-4" action="{{route('admin.deliveries.update', $model->id)}}" method="post" :default="$model">

          <x-splade-input :label="__('Name')" name="name" type="text"  :placeholder="__('Name')" />
          <x-splade-input :label="__('Phone')" :placeholder="__('Phone')" type='tel' name="phone" />
          <x-splade-input :label="__('Address')" name="address" type="text"  :placeholder="__('Address')" />
          <x-splade-checkbox :label="__('Is activated')" name="is_activated" />

        <div class="flex justify-start gap-2 pt-3">
            <x-tomato-admin-submit  label="{{__('Save')}}" :spinner="true" />
            <x-tomato-admin-button danger :href="route('admin.deliveries.destroy', $model->id)"
                                   confirm="{{trans('tomato-admin::global.crud.delete-confirm')}}"
                                   confirm-text="{{trans('tomato-admin::global.crud.delete-confirm-text')}}"
                                   confirm-button="{{trans('tomato-admin::global.crud.delete-confirm-button')}}"
                                   cancel-button="{{trans('tomato-admin::global.crud.delete-confirm-cancel-button')}}"
                                   method="delete"  label="{{__('Delete')}}" />
            <x-tomato-admin-button secondary :href="route('admin.deliveries.index')" label="{{__('Cancel')}}"/>
        </div>
    </x-splade-form>
</x-tomato-admin-container>
