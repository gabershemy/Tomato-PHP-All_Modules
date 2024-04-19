<x-tomato-admin-container label="{{trans('tomato-admin::global.crud.view')}} {{__('Wallets')}} #{{$model->id}}">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">

          <x-tomato-admin-row :label="__('Holder')" :value="$model->holder?->name" type="string" />

          <x-tomato-admin-row :label="__('Name')" :value="$model->name" type="string" />

          <x-tomato-admin-row :label="__('Slug')" :value="$model->slug" type="string" />

          <x-tomato-admin-row :label="__('Uuid')" :value="$model->uuid" type="string" />

          <x-tomato-admin-row :label="__('Description')" :value="$model->description" type="string" />

          <x-tomato-admin-row :label="__('Balance')" value="{!! dollar($model->balance) !!}" type="string" />

    </div>
    <div class="flex justify-start gap-2 pt-3">
        <x-tomato-admin-button secondary :href="route('admin.wallets.index')" label="{{__('Cancel')}}"/>
    </div>
</x-tomato-admin-container>
