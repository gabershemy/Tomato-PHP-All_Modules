<x-tomato-admin-container label="{{__('Update Project Status')}} #{{$model->id}}">
    <x-splade-form class="flex flex-col space-y-4" action="{{route('admin.projects.update', $model->id)}}" method="post" :default="$model">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <x-splade-select :label="__('Category')" :placeholder="__('Category')" name="category_id" remote-url="/admin/categories/api?type='projects'" remote-root="data" option-label="name" option-value="id" choices/>
            <x-splade-select choices :label="__('View')" name="view" type="text"  :placeholder="__('View')">
                <option value="list">{{__('List')}}</option>
                <option value="kanban">{{__('Kanban')}}</option>
                <option value="calendar">{{__('Calendar')}}</option>
            </x-splade-select>
            <x-splade-select choices :label="__('Status')" name="status" type="text"  :placeholder="__('Status')">
                <option value="pending">{{__('Pending')}}</option>
                <option value="in-progress">{{__('In progress')}}</option>
                <option value="done">{{__('Done')}}</option>
            </x-splade-select>
            <x-splade-select choices :label="__('Type')" name="type" type="text"  :placeholder="__('Type')" >
                <option value="project">{{__('Project')}}</option>
                <option value="open-source">{{__('Open Source')}}</option>
                <option value="traning">{{__('Traning')}}</option>
            </x-splade-select>
        </div>
        <x-splade-checkbox :label="__('Is Activated')" name="is_activated" />

        <div class="flex justify-start gap-2 pt-3">
            <x-tomato-admin-submit  label="{{__('Save')}}" :spinner="true" />
            <x-tomato-admin-button secondary :href="route('admin.projects.index')" label="{{__('Cancel')}}"/>
        </div>
    </x-splade-form>
</x-tomato-admin-container>
