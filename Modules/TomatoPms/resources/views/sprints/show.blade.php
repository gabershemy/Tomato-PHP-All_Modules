<x-tomato-admin-container label="{{trans('tomato-admin::global.crud.view')}} {{__('Sprint')}} #{{$model->id}}">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
        
          <x-tomato-admin-row :label="__('Project')" :value="$model->Project->name" type="text" />

          
          <x-tomato-admin-row :label="__('Name')" :value="$model->name" type="string" />

          <x-tomato-admin-row :label="__('Description')" :value="$model->description" type="text" />

          <x-tomato-admin-row :label="__('Status')" :value="$model->status" type="string" />

          <x-tomato-admin-row :label="__('Icon')" :value="$model->icon" type="icon" />

          <x-tomato-admin-row :label="__('Color')" :value="$model->color" type="color" />

          <x-tomato-admin-row :label="__('Start date')" :value="$model->start_date" type="text" />

          <x-tomato-admin-row :label="__('End date')" :value="$model->end_date" type="text" />

    </div>
    <div class="flex justify-start gap-2 pt-3">
        <x-tomato-admin-button warning label="{{__('Edit')}}" :href="route('admin.sprints.edit', $model->id)"/>
        <x-tomato-admin-button danger :href="route('admin.sprints.destroy', $model->id)"
                               confirm="{{trans('tomato-admin::global.crud.delete-confirm')}}"
                               confirm-text="{{trans('tomato-admin::global.crud.delete-confirm-text')}}"
                               confirm-button="{{trans('tomato-admin::global.crud.delete-confirm-button')}}"
                               cancel-button="{{trans('tomato-admin::global.crud.delete-confirm-cancel-button')}}"
                               method="delete"  label="{{__('Delete')}}" />
        <x-tomato-admin-button secondary :href="route('admin.sprints.index')" label="{{__('Cancel')}}"/>
    </div>
</x-tomato-admin-container>
