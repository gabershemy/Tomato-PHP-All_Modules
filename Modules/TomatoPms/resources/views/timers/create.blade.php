<x-tomato-admin-container label="{{trans('tomato-admin::global.crud.create')}} {{__('Timer')}}">
    <x-splade-form class="flex flex-col space-y-4" action="{{route('admin.timers.store')}}" method="post">

          <x-splade-select :label="__('Project')" :placeholder="__('Project')" name="project_id" remote-url="/admin/projects/api" remote-root="data" option-label="name" option-value="id" choices/>
          <x-splade-select v-bind:disabled="!form.project_id" :label="__('Issue')" :placeholder="__('Issue')" name="issue_id" remote-url="`/admin/issues/api?project_id=${form.project_id}`" remote-root="data" option-label="summary" option-value="id" choices/>
          <x-splade-select :label="__('Employee')" :placeholder="__('Employee')" name="employee_id" remote-url="/admin/users/api" remote-root="data" option-label="name" option-value="id" choices/>
          <x-splade-input :label="__('Description')" name="description" type="text"  :placeholder="__('Description')" />
          <x-splade-input date time name="start_at" :label="__('Start at')" />
          <x-splade-input date time name="end_at" :label="__('End at')" />
          <x-splade-checkbox :label="__('Is running')" name="is_running"  />
          <x-splade-checkbox :label="__('Is billable')" name="is_billable"  />

        <div class="flex justify-start gap-2 pt-3">
            <x-tomato-admin-submit  label="{{__('Save')}}" :spinner="true" />
            <x-tomato-admin-button secondary :href="route('admin.timers.index')" label="{{__('Cancel')}}"/>
        </div>
    </x-splade-form>
</x-tomato-admin-container>
