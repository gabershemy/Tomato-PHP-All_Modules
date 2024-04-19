<x-tomato-admin-container label="{{trans('tomato-admin::global.crud.edit')}} {{__('Shipping vendor')}} #{{$model->id}}">
    <x-splade-form class="flex flex-col space-y-4" action="{{route('admin.shipping-vendors.update', $model->id)}}" method="post" :default="$model">
        <x-splade-file label="{{__('Logo')}}" preview filepond  name="logo"/>
        <x-splade-input :label="__('Name')" name="name" type="text"  :placeholder="__('Name')" />
        <x-splade-input :label="__('Contact person')" name="contact_person" type="text"  :placeholder="__('Contact person')" />
        <x-splade-input :label="__('Delivery Estimation')" name="delivery_estimation" type="text"  :placeholder="__('Delivery Estimation')" />
        <x-splade-input :label="__('Phone')" :placeholder="__('Phone')" type='tel' name="phone" />
        <x-splade-input :label="__('Address')" name="address" type="text"  :placeholder="__('Address')" />
        <x-splade-checkbox :label="__('Is activated')" name="is_activated" />



        <div class="flex justify-start gap-2 pt-3">
            <x-tomato-admin-submit  label="{{__('Save')}}" :spinner="true" />
            <x-tomato-admin-button danger :href="route('admin.shipping-vendors.destroy', $model->id)"
                                   confirm="{{trans('tomato-admin::global.crud.delete-confirm')}}"
                                   confirm-text="{{trans('tomato-admin::global.crud.delete-confirm-text')}}"
                                   confirm-button="{{trans('tomato-admin::global.crud.delete-confirm-button')}}"
                                   cancel-button="{{trans('tomato-admin::global.crud.delete-confirm-cancel-button')}}"
                                   method="delete"  label="{{__('Delete')}}" />
            <x-tomato-admin-button secondary :href="route('admin.shipping-vendors.index')" label="{{__('Cancel')}}"/>
        </div>
    </x-splade-form>
</x-tomato-admin-container>
