<x-tomato-admin-container label="{{trans('tomato-admin::global.crud.view')}} {{__('Transactions')}} #{{$model->id}}">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">

          <x-tomato-admin-row :label="__('Wallet')" :value="$model->wallet?->name" type="text" />

          <x-tomato-admin-row :label="__('Payable')" :value="$model->payable?->name" type="string" />


          <x-tomato-admin-row :label="__('Type')" :value="$model->type" type="string" />
          <x-tomato-admin-row :label="__('Amount')" value="{!! dollar($model->amount) !!}" type="string" />


          <x-tomato-admin-row :label="__('Confirmed')" :value="$model->confirmed" type="bool" />


          <x-tomato-admin-row :label="__('Uuid')" :value="$model->uuid" type="string" />

    </div>
    <div class="flex justify-start gap-2 pt-3">

        <x-tomato-admin-button secondary :href="route('admin.transactions.index')" label="{{__('Cancel')}}"/>
    </div>
</x-tomato-admin-container>
