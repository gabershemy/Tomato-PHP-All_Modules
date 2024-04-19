<x-tomato-admin-container label="{{trans('tomato-admin::global.crud.create')}} {{__('Account')}}">
    <x-splade-form class="flex flex-col gap-4" :default="['country_id' => setting('local_country')]" action="{{route('admin.orders.account.store')}}" method="post">
        <x-splade-input label="{{__('Name')}}" name="name" type="text"  placeholder="{{__('Name')}}" required/>
        <x-splade-input label="{{__('Phone')}}" name="phone" type="tel"  placeholder="{{__('Phone')}}" required/>
        <x-tomato-location />
        <x-splade-textarea label="{{__('Street')}}" name="street"  placeholder="{{__('Street')}}" required/>
        <div class="flex justify-between gap-4">
            <x-splade-input label="{{__('Home Number')}}" name="home_number"  type="number" placeholder="{{__('Address')}}" required/>
            <x-splade-input label="{{__('Floor Number')}}" name="floor_number" type="number"  placeholder="{{__('Floor Number')}}" required />
            <x-splade-input label="{{__('Flat Number')}}" name="flat_number"  type="number" placeholder="{{__('Flat Number')}}" required/>
        </div>
        <x-splade-input label="{{__('ZIP')}}" name="zip" type="number"  placeholder="{{__('ZIP')}}" />

        <div class="flex justify-start gap-2 pt-3">
            <x-tomato-admin-submit  label="{{__('Save')}}" :spinner="true" />
            <x-tomato-admin-button secondary type="button" @click.prevent="modal.close" label="{{__('Cancel')}}"/>
        </div>

    </x-splade-form>
</x-tomato-admin-container>
