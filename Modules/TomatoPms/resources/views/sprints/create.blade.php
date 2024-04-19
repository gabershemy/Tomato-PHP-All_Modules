<x-tomato-admin-container label="{{trans('tomato-admin::global.crud.create')}} {{__('Sprint')}}">
    <x-splade-form class="flex flex-col space-y-4" action="{{route('admin.sprints.store')}}" method="post">

          <x-splade-select :label="__('Project')" :placeholder="__('Project')" name="project_id" remote-url="/admin/projects/api" remote-root="data" option-label="name" option-value="id" choices/>

          <x-splade-input :label="__('Name')" name="name" type="text"  :placeholder="__('Name')" />
          <x-splade-textarea :label="__('Description')" name="description" :placeholder="__('Description')" autosize />
            <div class="flex justify-start gap-4">
                <div class="w-full">
                    <x-tomato-admin-icon :label="__('Icon')" name="icon" type="icon"  :placeholder="__('Icon')" />
                </div>
                <x-tomato-admin-color :label="__('Color')" :placeholder="__('Color')" type='number' name="color" />
            </div>
            <div class="flex justify-between gap-4">
                <x-splade-input :label="__('Start date')" :placeholder="__('Start date')" name="start_date" date />
                <x-splade-input :label="__('End date')" :placeholder="__('End date')" name="end_date" date />
            </div>

        <div class="flex justify-start gap-2 pt-3">
            <x-tomato-admin-submit  label="{{__('Save')}}" :spinner="true" />
            <x-tomato-admin-button secondary :href="route('admin.sprints.index')" label="{{__('Cancel')}}"/>
        </div>
    </x-splade-form>
</x-tomato-admin-container>
