<x-tomato-admin-container label="{{ trans('tomato-admin::global.crud.edit') }} {{ __('Referral Code') }} #{{ $model->id }}">
    <x-splade-form class="flex flex-col space-y-4" action="{{ route('admin.referral-codes.update', $model->id) }}" method="post" :default="$model">

        <x-splade-select :label="__('Account')" :placeholder="__('Account')" name="account_id" remote-url="/admin/accounts/api" remote-root="data" option-label="name" option-value="id" choices />
        <x-splade-input :label="__('Name')" name="name" type="text" :placeholder="__('Name')" />
        <x-splade-input :label="__('Code')" name="code" type="text" :placeholder="__('Code')" />
        <x-splade-checkbox :label="__('Is activated')" name="is_activated" />
        <x-splade-checkbox :label="__('Is public')" name="is_public" />

        <div class="flex justify-start gap-2 pt-3">
            <x-tomato-admin-submit label="{{ __('Save') }}" :spinner="true" />
            <x-tomato-admin-button danger :href="route('admin.referral-codes.destroy', $model->id)"
                confirm="{{ trans('tomato-admin::global.crud.delete-confirm') }}"
                confirm-text="{{ trans('tomato-admin::global.crud.delete-confirm-text') }}"
                confirm-button="{{ trans('tomato-admin::global.crud.delete-confirm-button') }}"
                cancel-button="{{ trans('tomato-admin::global.crud.delete-confirm-cancel-button') }}" method="delete"
                label="{{ __('Delete') }}" />
            <x-tomato-admin-button secondary :href="route('admin.referral-codes.index')" label="{{ __('Cancel') }}" />
        </div>
    </x-splade-form>
</x-tomato-admin-container>
