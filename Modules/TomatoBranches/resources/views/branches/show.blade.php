<x-tomato-admin-container label="{{trans('tomato-admin::global.crud.view')}} {{__('branches')}} #{{$model->id}}">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">

          <x-tomato-admin-row :label="__('Company')" :value="$model->company?->name" type="string" />

          <x-tomato-admin-row :label="__('Name')" :value="$model->name" type="string" />

          <x-tomato-admin-row :label="__('Branch Number')" :value="$model->branch_number" type="string" />

          <x-tomato-admin-row :label="__('Phone')" :value="$model->phone" type="tel" />

          <x-tomato-admin-row :label="__('Address')" :value="$model->address" type="string" />

    </div>
    <div class="flex justify-start gap-2 pt-3">
        <x-tomato-admin-button warning label="{{__('Edit')}}" :href="route('admin.branches.edit', $model->id)"/>
        <x-tomato-admin-button danger :href="route('admin.branches.destroy', $model->id)"
                               confirm="{{trans('tomato-admin::global.crud.delete-confirm')}}"
                               confirm-text="{{trans('tomato-admin::global.crud.delete-confirm-text')}}"
                               confirm-button="{{trans('tomato-admin::global.crud.delete-confirm-button')}}"
                               cancel-button="{{trans('tomato-admin::global.crud.delete-confirm-cancel-button')}}"
                               method="delete"  label="{{__('Delete')}}" />
        <x-tomato-admin-button secondary :href="route('admin.branches.index')" label="{{__('Cancel')}}"/>
    </div>
</x-tomato-admin-container>
