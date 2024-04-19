<x-tomato-admin-container label="{{trans('tomato-admin::global.crud.edit')}} {{__('Order Log')}} #{{$model->id}}">
    <x-splade-form class="flex flex-col space-y-4" action="{{route('admin.order-logs.update', $model->id)}}" method="post" :default="$model">
        
          <x-splade-select :label="__('User')" :placeholder="__('User')" name="user_id" remote-url="/admin/users/api" remote-root="model.data" option-label=name option-value="id" choices/>
          <x-splade-select :label="__('Order')" :placeholder="__('Order')" name="order_id" remote-url="/admin/orders/api" remote-root="model.data" option-label=name option-value="id" choices/>
          <x-splade-input :label="__('Status')" name="status" type="text"  :placeholder="__('Status')" />
          <x-splade-textarea :label="__('Note')" name="note" :placeholder="__('Note')" autosize />
          <x-splade-checkbox :label="__('Is closed')" name="is_closed" />

        <div class="flex justify-start gap-2 pt-3">
            <x-tomato-admin-submit  label="{{__('Save')}}" :spinner="true" />
            <x-tomato-admin-button danger :href="route('admin.order-logs.destroy', $model->id)"
                                   confirm="{{trans('tomato-admin::global.crud.delete-confirm')}}"
                                   confirm-text="{{trans('tomato-admin::global.crud.delete-confirm-text')}}"
                                   confirm-button="{{trans('tomato-admin::global.crud.delete-confirm-button')}}"
                                   cancel-button="{{trans('tomato-admin::global.crud.delete-confirm-cancel-button')}}"
                                   method="delete"  label="{{__('Delete')}}" />
            <x-tomato-admin-button secondary :href="route('admin.order-logs.index')" label="{{__('Cancel')}}"/>
        </div>
    </x-splade-form>
</x-tomato-admin-container>
