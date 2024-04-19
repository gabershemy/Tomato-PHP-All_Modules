<x-tomato-admin-container label="{{trans('tomato-admin::global.crud.edit')}} {{__('Payment Status')}} #{{$model->id}}">
    <x-splade-form class="flex flex-col space-y-4" action="{{route('admin.payment-status.update', $model->id)}}" method="post" :default="$model">
        
        <x-tomato-translation label="{{__('Name')}}" name="name" :placeholder="__('Name')" />
        <x-tomato-translation label="{{__('Description')}}" name="description" :placeholder="__('Description')" />
        <x-tomato-admin-color :label="__('Color')" :placeholder="__('Color')" type='number' name="color" />
        <x-splade-input :label="__('Icon')" name="icon" type="icon"  :placeholder="__('Icon')" />

        <div class="flex justify-start gap-2 pt-3">
            <x-tomato-admin-submit  label="{{__('Save')}}" :spinner="true" />
            <x-tomato-admin-button danger :href="route('admin.payment-status.destroy', $model->id)"
                                   confirm="{{trans('tomato-admin::global.crud.delete-confirm')}}"
                                   confirm-text="{{trans('tomato-admin::global.crud.delete-confirm-text')}}"
                                   confirm-button="{{trans('tomato-admin::global.crud.delete-confirm-button')}}"
                                   cancel-button="{{trans('tomato-admin::global.crud.delete-confirm-cancel-button')}}"
                                   method="delete"  label="{{__('Delete')}}" />
            <x-tomato-admin-button secondary :href="route('admin.payment-status.index')" label="{{__('Cancel')}}"/>
        </div>
    </x-splade-form>
</x-tomato-admin-container>
