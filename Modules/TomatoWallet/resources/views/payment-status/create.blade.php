<x-tomato-admin-container label="{{trans('tomato-admin::global.crud.create')}} {{__('Payment Status')}}">
    <x-splade-form class="flex flex-col space-y-4" action="{{route('admin.payment-status.store')}}" method="post">
        
        <x-tomato-translation label="{{__('Name')}}" name="name" :placeholder="__('Name')" />
        <x-tomato-translation label="{{__('Description')}}" name="description" :placeholder="__('Description')" />
        <x-tomato-admin-color :label="__('Color')" :placeholder="__('Color')" type='number' name="color" />
        <x-splade-input :label="__('Icon')" name="icon" type="icon"  :placeholder="__('Icon')" />

        <div class="flex justify-start gap-2 pt-3">
            <x-tomato-admin-submit  label="{{__('Save')}}" :spinner="true" />
            <x-tomato-admin-button secondary :href="route('admin.payment-status.index')" label="{{__('Cancel')}}"/>
        </div>
    </x-splade-form>
</x-tomato-admin-container>
