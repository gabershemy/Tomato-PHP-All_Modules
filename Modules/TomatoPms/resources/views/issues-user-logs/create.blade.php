<x-tomato-admin-container label="{{trans('tomato-admin::global.crud.create')}} {{__('IssuesUserLog')}}">
    <x-splade-form class="flex flex-col space-y-4" action="{{route('admin.issues-user-logs.store')}}" method="post">
        
          <x-splade-select :label="__('User id')" :placeholder="__('User id')" name="user_id" remote-url="/admin/users/api" remote-root="data" option-label="name" option-value="id" choices/>
          <x-splade-input :label="__('Model type')" name="model_type" type="text"  :placeholder="__('Model type')" />
          
          <x-splade-input :label="__('Status')" name="status" type="text"  :placeholder="__('Status')" />
          <x-splade-input :label="__('Action')" name="action" type="text"  :placeholder="__('Action')" />
          <x-tomato-admin-rich :label="__('Description')" name="description" :placeholder="__('Description')" autosize />
          

        <div class="flex justify-start gap-2 pt-3">
            <x-tomato-admin-submit  label="{{__('Save')}}" :spinner="true" />
            <x-tomato-admin-button secondary :href="route('admin.issues-user-logs.index')" label="{{__('Cancel')}}"/>
        </div>
    </x-splade-form>
</x-tomato-admin-container>
