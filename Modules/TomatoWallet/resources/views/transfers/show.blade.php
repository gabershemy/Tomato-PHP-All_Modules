<x-tomato-admin-container label="{{trans('tomato-admin::global.crud.view')}} {{__('Transfers')}} #{{$model->id}}">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">

          <x-tomato-admin-row :label="__('Deposit')" :value="$model->Deposit->id" type="text" />

          <x-tomato-admin-row :label="__('Withdraw')" :value="$model->Withdraw->id" type="text" />

          <x-tomato-admin-row :label="__('From')" :value="$model->from?->name" type="string" />
          <x-tomato-admin-row :label="__('To')" :value="$model->to?->name" type="string" />
          <x-tomato-admin-row :label="__('Status')" :value="$model->status" type="string" />

          <x-tomato-admin-row :label="__('Discount')" value="{!! dollar($model->discount) !!}" type="string" />
          <x-tomato-admin-row :label="__('Fee')" value="{!! dollar($model->fee) !!}" type="string" />


          <x-tomato-admin-row :label="__('Uuid')" :value="$model->uuid" type="string" />

    </div>
    <div class="flex justify-start gap-2 pt-3">
        <x-tomato-admin-button secondary :href="route('admin.transfers.index')" label="{{__('Cancel')}}"/>
    </div>
</x-tomato-admin-container>
