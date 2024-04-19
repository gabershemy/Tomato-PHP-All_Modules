<x-tomato-admin-container label="{{trans('tomato-admin::global.crud.edit')}} {{__('Project')}} #{{$model->id}}">
    <x-splade-form class="flex flex-col space-y-4" action="{{route('admin.projects.update', $model->id)}}" method="post" :default="$model">

        <x-splade-input :label="__('Name')" name="name" type="text"  :placeholder="__('Name')" />
        <x-splade-input :label="__('Key')" name="key" type="text"  :placeholder="__('Key')" />

        <div class="flex justify-start gap-4">
            <div class="w-full">
                <x-tomato-admin-icon :label="__('Icon')" name="icon" type="icon"  :placeholder="__('Icon')" />
            </div>
            <x-tomato-admin-color :label="__('Color')" :placeholder="__('Color')" type='number' name="color" />
        </div>

{{--        --}}
{{--          <x-splade-select :label="__('User id')" :placeholder="__('User id')" name="user_id" remote-url="/admin/users/api" remote-root="data" option-label="name" option-value="id" choices/>--}}

{{--          <x-splade-select :label="__('Project leader id')" :placeholder="__('Project leader id')" name="project_leader_id" remote-url="/admin/users/api" remote-root="data" option-label="name" option-value="id" choices/>--}}
{{--          <x-splade-select :label="__('Default assignee id')" :placeholder="__('Default assignee id')" name="default_assignee_id" remote-url="/admin/users/api" remote-root="data" option-label="name" option-value="id" choices/>--}}
{{--          <x-splade-select :label="__('Account id')" :placeholder="__('Account id')" name="account_id" remote-url="/admin/accounts/api" remote-root="data" option-label="name" option-value="id" choices/>--}}
{{--          <x-splade-select :label="__('Category id')" :placeholder="__('Category id')" name="category_id" remote-url="/admin/categories/api" remote-root="data" option-label="name" option-value="id" choices/>--}}
{{--          <x-splade-input :label="__('Name')" name="name" type="text"  :placeholder="__('Name')" />--}}
{{--          <x-splade-input :label="__('View')" name="view" type="text"  :placeholder="__('View')" />--}}
{{--          <x-splade-input :label="__('Status')" name="status" type="text"  :placeholder="__('Status')" />--}}
{{--          <x-splade-input :label="__('Key')" name="key" type="text"  :placeholder="__('Key')" />--}}
{{--          <x-splade-input :label="__('Url')" name="url" type="text"  :placeholder="__('Url')" />--}}
{{--          <x-tomato-admin-rich :label="__('Description')" name="description" :placeholder="__('Description')" autosize />--}}
{{--          <x-tomato-admin-rich :label="__('Body')" name="body" :placeholder="__('Body')" autosize />--}}
{{--          <x-splade-input :label="__('Icon')" name="icon" type="icon"  :placeholder="__('Icon')" />--}}
{{--          <x-tomato-admin-color :label="__('Color')" :placeholder="__('Color')" type='number' name="color" />--}}
{{--          <x-splade-input :label="__('Type')" name="type" type="text"  :placeholder="__('Type')" />--}}
{{--          <x-splade-input :label="__('Currency')" name="currency" type="text"  :placeholder="__('Currency')" />--}}
{{--          <x-splade-input :label="__('Rate')" :placeholder="__('Rate')" type='number' name="rate" />--}}
{{--          <x-splade-input :label="__('Rate per')" name="rate_per" type="text"  :placeholder="__('Rate per')" />--}}
{{--          <x-splade-input :label="__('Total')" :placeholder="__('Total')" type='number' name="total" />--}}
{{--          <x-splade-checkbox :label="__('Is activated')" name="is_activated" label="Is activated" />--}}
{{--          <x-splade-checkbox :label="__('Is started')" name="is_started" label="Is started" />--}}
{{--          <x-splade-checkbox :label="__('Is done')" name="is_done" label="Is done" />--}}

        <div class="flex justify-start gap-2 pt-3">
            <x-tomato-admin-submit  label="{{__('Save')}}" :spinner="true" />
            <x-tomato-admin-button danger :href="route('admin.projects.destroy', $model->id)"
                                   confirm="{{trans('tomato-admin::global.crud.delete-confirm')}}"
                                   confirm-text="{{trans('tomato-admin::global.crud.delete-confirm-text')}}"
                                   confirm-button="{{trans('tomato-admin::global.crud.delete-confirm-button')}}"
                                   cancel-button="{{trans('tomato-admin::global.crud.delete-confirm-cancel-button')}}"
                                   method="delete"  label="{{__('Delete')}}" />
            <x-tomato-admin-button secondary :href="route('admin.projects.index')" label="{{__('Cancel')}}"/>
        </div>
    </x-splade-form>
</x-tomato-admin-container>
