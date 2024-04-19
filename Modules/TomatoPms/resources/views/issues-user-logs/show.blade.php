<x-tomato-admin-container label="{{trans('tomato-admin::global.crud.view')}} {{__('IssuesUserLog')}} #{{$model->id}}">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
        
          <x-tomato-admin-row :label="__('User')" :value="$model->User->name" type="text" />

          <x-tomato-admin-row :label="__('Model type')" :value="$model->model_type" type="string" />

          
          <x-tomato-admin-row :label="__('Status')" :value="$model->status" type="string" />

          <x-tomato-admin-row :label="__('Action')" :value="$model->action" type="string" />

          <x-tomato-admin-row :label="__('Description')" :value="$model->description" type="rich" />

          
    </div>
    <div class="flex justify-start gap-2 pt-3">
        <x-tomato-admin-button warning label="{{__('Edit')}}" :href="route('admin.issues-user-logs.edit', $model->id)"/>
        <x-tomato-admin-button danger :href="route('admin.issues-user-logs.destroy', $model->id)"
                               confirm="{{trans('tomato-admin::global.crud.delete-confirm')}}"
                               confirm-text="{{trans('tomato-admin::global.crud.delete-confirm-text')}}"
                               confirm-button="{{trans('tomato-admin::global.crud.delete-confirm-button')}}"
                               cancel-button="{{trans('tomato-admin::global.crud.delete-confirm-cancel-button')}}"
                               method="delete"  label="{{__('Delete')}}" />
        <x-tomato-admin-button secondary :href="route('admin.issues-user-logs.index')" label="{{__('Cancel')}}"/>
    </div>
</x-tomato-admin-container>
