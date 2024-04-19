<x-tomato-admin-container label="{{trans('tomato-admin::global.crud.create')}} {{__('Transfer')}}">
    <x-splade-form class="flex flex-col space-y-4" action="{{route('admin.transfers.store')}}" method="post">
        
          <x-splade-select :label="__('Deposit id')" :placeholder="__('Deposit id')" name="deposit_id" remote-url="/admin/transactions/api" remote-root="model.data" option-label=name option-value="id" choices/>
          <x-splade-select :label="__('Withdraw id')" :placeholder="__('Withdraw id')" name="withdraw_id" remote-url="/admin/transactions/api" remote-root="model.data" option-label=name option-value="id" choices/>
          <x-splade-input :label="__('From type')" name="from_type" type="text"  :placeholder="__('From type')" />
          
          <x-splade-input :label="__('To type')" name="to_type" type="text"  :placeholder="__('To type')" />
          
          <x-splade-input :label="__('Status')" name="status" type="text"  :placeholder="__('Status')" />
          <x-splade-input :label="__('Status last')" name="status_last" type="text"  :placeholder="__('Status last')" />
          
          
          <x-splade-input :label="__('Uuid')" name="uuid" type="text"  :placeholder="__('Uuid')" />

        <div class="flex justify-start gap-2 pt-3">
            <x-tomato-admin-submit  label="{{__('Save')}}" :spinner="true" />
            <x-tomato-admin-button secondary :href="route('admin.transfers.index')" label="{{__('Cancel')}}"/>
        </div>
    </x-splade-form>
</x-tomato-admin-container>
