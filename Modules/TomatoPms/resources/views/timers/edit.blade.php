<x-tomato-admin-container label="{{trans('tomato-admin::global.crud.edit')}} {{__('Timer')}} #{{$model->id}}">
    <x-splade-form class="flex flex-col space-y-4" action="{{route('admin.timers.update', $model->id)}}" method="post" :default="$model">
          <x-splade-checkbox :label="__('Is billable')" name="is_billable" label="Is billable" />

        <div class="flex justify-start gap-2 pt-3">
            <x-tomato-admin-button :data="[
                'is_running' => false,
                'is_done' => true,
            ]" href="{{route('admin.timers.update', $model->id)}}" method="POST" danger confirm>
                {{__('End')}}
            </x-tomato-admin-button>
            <x-tomato-admin-submit  label="{{__('Save')}}" :spinner="true" />
            <x-tomato-admin-button danger :href="route('admin.timers.destroy', $model->id)"
                                   confirm="{{trans('tomato-admin::global.crud.delete-confirm')}}"
                                   confirm-text="{{trans('tomato-admin::global.crud.delete-confirm-text')}}"
                                   confirm-button="{{trans('tomato-admin::global.crud.delete-confirm-button')}}"
                                   cancel-button="{{trans('tomato-admin::global.crud.delete-confirm-cancel-button')}}"
                                   method="delete"  label="{{__('Delete')}}" />
            <x-tomato-admin-button secondary @click.prevent="modal.close" type="button" label="{{__('Cancel')}}"/>
        </div>
    </x-splade-form>
</x-tomato-admin-container>
