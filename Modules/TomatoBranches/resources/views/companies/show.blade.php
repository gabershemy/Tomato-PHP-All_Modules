<x-tomato-admin-container label="{{trans('tomato-admin::global.crud.view')}} {{__('Companies')}} #{{$model->id}}">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
        
          <x-tomato-admin-row :label="__('Country')" :value="$model->Country->name" type="text" />

          <x-tomato-admin-row :label="__('Name')" :value="$model->name" type="string" />

          <x-tomato-admin-row :label="__('Ceo')" :value="$model->ceo" type="string" />

          <x-tomato-admin-row :label="__('Address')" :value="$model->address" type="string" />

          <x-tomato-admin-row :label="__('City')" :value="$model->city" type="string" />

          <x-tomato-admin-row :label="__('Zip')" :value="$model->zip" type="string" />

          <x-tomato-admin-row :label="__('Registration number')" :value="$model->registration_number" type="string" />

          <x-tomato-admin-row :label="__('Tax number')" :value="$model->tax_number" type="string" />

          <x-tomato-admin-row :label="__('Email')" :value="$model->email" type="email" />

          <x-tomato-admin-row :label="__('Phone')" :value="$model->phone" type="tel" />

          <x-tomato-admin-row :label="__('Website')" :value="$model->website" type="string" />

          <x-tomato-admin-row :label="__('Notes')" :value="$model->notes" type="text" />

    </div>
    <div class="flex justify-start gap-2 pt-3">
        <x-tomato-admin-button warning label="{{__('Edit')}}" :href="route('admin.companies.edit', $model->id)"/>
        <x-tomato-admin-button danger :href="route('admin.companies.destroy', $model->id)"
                               confirm="{{trans('tomato-admin::global.crud.delete-confirm')}}"
                               confirm-text="{{trans('tomato-admin::global.crud.delete-confirm-text')}}"
                               confirm-button="{{trans('tomato-admin::global.crud.delete-confirm-button')}}"
                               cancel-button="{{trans('tomato-admin::global.crud.delete-confirm-cancel-button')}}"
                               method="delete"  label="{{__('Delete')}}" />
        <x-tomato-admin-button secondary :href="route('admin.companies.index')" label="{{__('Cancel')}}"/>
    </div>
</x-tomato-admin-container>
