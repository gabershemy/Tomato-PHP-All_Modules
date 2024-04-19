<x-tomato-admin-container label="{{trans('tomato-admin::global.crud.view')}} {{__('Project')}} #{{$model->id}}">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">

          <x-tomato-admin-row :label="__('User')" :value="$model->user?->name" type="text" />

          <x-tomato-admin-row :label="__('Project leader')" :value="$model->projectLeader?->name" type="text" />

          <x-tomato-admin-row :label="__('Default assignee')" :value="$model->defaultAssignee?->name" type="text" />

          <x-tomato-admin-row :label="__('Account')" :value="$model->account?->name" type="text" />

          <x-tomato-admin-row :label="__('Category')" :value="$model->category?->name" type="text" />

          <x-tomato-admin-row :label="__('Name')" :value="$model->name" type="string" />

          <x-tomato-admin-row :label="__('View')" :value="$model->view" type="string" />

          <x-tomato-admin-row :label="__('Status')" :value="$model->status" type="string" />

          <x-tomato-admin-row :label="__('Key')" :value="$model->key" type="string" />

          <x-tomato-admin-row :label="__('Url')" :value="$model->url" type="string" />

          <x-tomato-admin-row :label="__('Description')" :value="$model->description" type="rich" />

          <x-tomato-admin-row :label="__('Body')" :value="$model->body" type="rich" />

          <x-tomato-admin-row :label="__('Icon')" :value="$model->icon" type="icon" />

          <x-tomato-admin-row :label="__('Color')" :value="$model->color" type="color" />

          <x-tomato-admin-row :label="__('Type')" :value="$model->type" type="string" />

          <x-tomato-admin-row :label="__('Currency')" :value="$model->currency" type="string" />

          <x-tomato-admin-row :label="__('Rate')" :value="$model->rate" type="number" />

          <x-tomato-admin-row :label="__('Rate per')" :value="$model->rate_per" type="string" />

          <x-tomato-admin-row :label="__('Total')" :value="$model->total" type="number" />

          <x-tomato-admin-row :label="__('Is activated')" :value="$model->is_activated" type="bool" />

          <x-tomato-admin-row :label="__('Is started')" :value="$model->is_started" type="bool" />

          <x-tomato-admin-row :label="__('Is done')" :value="$model->is_done" type="bool" />

    </div>
    <div class="flex justify-start gap-2 pt-3">
        <x-tomato-admin-button warning label="{{__('Edit')}}" :href="route('admin.projects.edit', $model->id)"/>
        <x-tomato-admin-button danger :href="route('admin.projects.destroy', $model->id)"
                               confirm="{{trans('tomato-admin::global.crud.delete-confirm')}}"
                               confirm-text="{{trans('tomato-admin::global.crud.delete-confirm-text')}}"
                               confirm-button="{{trans('tomato-admin::global.crud.delete-confirm-button')}}"
                               cancel-button="{{trans('tomato-admin::global.crud.delete-confirm-cancel-button')}}"
                               method="delete"  label="{{__('Delete')}}" />
        <x-tomato-admin-button secondary :href="route('admin.projects.index')" label="{{__('Cancel')}}"/>
    </div>

    @if(class_exists(\TomatoPHP\TomatoTasks\Models\Issue::class))
        <x-tomato-admin-relations-group :relations="['sprints'=>__('Sprints')]">
            <x-tomato-admin-relations
                :model="$model"
                name="sprints"
                :table="\TomatoPHP\TomatoTasks\Tables\SprintTable::class"
                view="tomato-pms::projects.sprints"
            />
        </x-tomato-admin-relations-group>
    @endif
</x-tomato-admin-container>
