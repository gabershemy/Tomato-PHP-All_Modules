<x-tomato-admin-container label="{{__('Update Project Details')}} #{{$model->id}}">
    <x-splade-form class="flex flex-col space-y-4" action="{{route('admin.projects.update', $model->id)}}" method="post" :default="$model">

          <x-splade-input :label="__('Url')" name="url" type="text"  :placeholder="__('Url')" />
          <x-splade-textarea :label="__('Description')" name="description" :placeholder="__('Description')" autosize />
          <x-tomato-admin-rich :label="__('Body')" name="body" :placeholder="__('Body')" autosize />

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
