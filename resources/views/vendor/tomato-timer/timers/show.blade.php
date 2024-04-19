<x-tomato-admin-container label="{{trans('tomato-admin::global.crud.view')}} {{__('Timer')}} #{{$model->id}}">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">

          <x-tomato-admin-row :label="__('Project')" :value="$model->project?->name" type="text" />

          <x-tomato-admin-row :label="__('Issue')" :value="$model->issue?->summary" type="text" />

          <x-tomato-admin-row :label="__('Account')" :value="$model->account?->name" type="text" />

          <x-tomato-admin-row :label="__('Employee')" :value="$model->employee?->name" type="text" />

          <x-tomato-admin-row :label="__('Type')" :value="$model->type" type="string" />

          <x-tomato-admin-row :label="__('Status')" :value="$model->status" type="string" />

          <x-tomato-admin-row :label="__('Color')" :value="$model->color" type="color" />

          <x-tomato-admin-row :label="__('Icon')" :value="$model->icon" type="icon" />

          <x-tomato-admin-row :label="__('Description')" :value="$model->description" type="string" />

          <x-tomato-admin-row :label="__('Total time')" :value="$model->total_time" type="number" />

          <x-tomato-admin-row :label="__('Total money')" :value="$model->total_money" type="number" />
          <x-tomato-admin-row :label="__('Start at')" :value="$model->start_at" type="datetime" />
          <x-tomato-admin-row :label="__('End at')" :value="$model->end_at" type="datetime" />


          <x-tomato-admin-row :label="__('Is running')" :value="$model->is_running" type="bool" />

          <x-tomato-admin-row :label="__('Is done')" :value="$model->is_done" type="bool" />

          <x-tomato-admin-row :label="__('Is billable')" :value="$model->is_billable" type="bool" />

          <x-tomato-admin-row :label="__('Is paid')" :value="$model->is_paid" type="bool" />

    </div>
    <div class="flex justify-start gap-2 pt-3">
        <x-tomato-admin-button warning label="{{__('Edit')}}" :href="route('admin.timers.edit', $model->id)"/>
        <x-tomato-admin-button danger :href="route('admin.timers.destroy', $model->id)"
                               confirm="{{trans('tomato-admin::global.crud.delete-confirm')}}"
                               confirm-text="{{trans('tomato-admin::global.crud.delete-confirm-text')}}"
                               confirm-button="{{trans('tomato-admin::global.crud.delete-confirm-button')}}"
                               cancel-button="{{trans('tomato-admin::global.crud.delete-confirm-cancel-button')}}"
                               method="delete"  label="{{__('Delete')}}" />
        <x-tomato-admin-button secondary :href="route('admin.timers.index')" label="{{__('Cancel')}}"/>
    </div>
</x-tomato-admin-container>
