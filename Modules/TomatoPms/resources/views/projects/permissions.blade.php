<x-tomato-admin-container label="{{__('Update Project Permissions')}} #{{$model->id}}">
    <x-splade-form class="flex flex-col space-y-4" action="{{route('admin.projects.update', $model->id)}}" method="post" :default="$model">

      <x-splade-select :label="__('Project leader')" :placeholder="__('Project leader')" name="project_leader_id" remote-url="/admin/users/api" remote-root="data" option-label="name" option-value="id" choices/>
      <x-splade-select :label="__('Default assignee')" :placeholder="__('Default assignee')" name="default_assignee_id" remote-url="/admin/users/api" remote-root="data" option-label="name" option-value="id" choices/>
      <x-splade-select :label="__('Account')" :placeholder="__('Account')" name="account_id" remote-url="/admin/accounts/api" remote-root="data" option-label="name" option-value="id" choices/>
      <x-splade-select :label="__('Employees')" multiple :placeholder="__('Employees')" name="employees" remote-url="/admin/users/api" remote-root="data" option-label="name" option-value="id" choices/>


        <div class="flex justify-start gap-2 pt-3">
            <x-tomato-admin-submit  label="{{__('Save')}}" :spinner="true" />
            <x-tomato-admin-button secondary :href="route('admin.projects.index')" label="{{__('Cancel')}}"/>
        </div>
    </x-splade-form>
</x-tomato-admin-container>
