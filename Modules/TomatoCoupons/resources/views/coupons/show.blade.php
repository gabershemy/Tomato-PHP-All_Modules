<x-tomato-admin-container label="{{trans('tomato-admin::global.crud.view')}} {{__('coupons')}} #{{$model->id}}">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">

          <x-tomato-admin-row :label="__('Code')" :value="$model->code" type="string" />

          <x-tomato-admin-row :label="__('Amount')" :value="$model->amount" type="number" />

          <x-tomato-admin-row :label="__('Is limited')" :value="$model->is_limited" type="bool" />

          <x-tomato-admin-row :label="__('Use limit')" :value="$model->use_limit" type="number" />

          <x-tomato-admin-row :label="__('Use limit by user')" :value="$model->use_limit_by_user" type="number" />

          <x-tomato-admin-row :label="__('Order total limit')" :value="$model->order_total_limit" type="number" />

          <x-tomato-admin-row :label="__('Is activated')" :value="$model->is_activated" type="bool" />

          <x-tomato-admin-row :label="__('Is marketing')" :value="$model->is_marketing" type="bool" />

          <x-tomato-admin-row :label="__('Marketer name')" :value="$model->marketer_name" type="string" />

          <x-tomato-admin-row :label="__('Marketer type')" :value="$model->marketer_type" type="string" />

          <x-tomato-admin-row :label="__('Marketer amount')" :value="$model->marketer_amount" type="number" />

          <x-tomato-admin-row :label="__('Marketer amount max')" :value="$model->marketer_amount_max" type="number" />

          <x-tomato-admin-row :label="__('Marketer show amount max')" :value="$model->marketer_show_amount_max" type="bool" />

          <x-tomato-admin-row :label="__('Marketer hide total sales')" :value="$model->marketer_hide_total_sales" type="bool" />

          <x-tomato-admin-row :label="__('Is used')" :value="$model->is_used" type="number" />

    </div>
    <div class="flex justify-start gap-2 pt-3">
        <x-tomato-admin-button warning label="{{__('Edit')}}" :href="route('admin.coupons.edit', $model->id)"/>
        <x-tomato-admin-button danger :href="route('admin.coupons.destroy', $model->id)"
                               confirm="{{trans('tomato-admin::global.crud.delete-confirm')}}"
                               confirm-text="{{trans('tomato-admin::global.crud.delete-confirm-text')}}"
                               confirm-button="{{trans('tomato-admin::global.crud.delete-confirm-button')}}"
                               cancel-button="{{trans('tomato-admin::global.crud.delete-confirm-cancel-button')}}"
                               method="delete"  label="{{__('Delete')}}" />
        <x-tomato-admin-button secondary :href="route('admin.coupons.index')" label="{{__('Cancel')}}"/>
    </div>
</x-tomato-admin-container>
