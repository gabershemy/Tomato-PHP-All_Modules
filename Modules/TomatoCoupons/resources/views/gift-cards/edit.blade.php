<x-tomato-admin-container label="{{ trans('tomato-admin::global.crud.edit') }} {{ __('Gift Card') }} #{{ $model->id }}">
    <x-splade-form class="flex flex-col space-y-4" action="{{ route('admin.gift-cards.update', $model->id) }}" method="post" :default="$model">

        <x-splade-input :label="__('Name')" name="name" type="text" :placeholder="__('Name')" />
        <x-splade-input :label="__('Code')" name="code" type="text" :placeholder="__('Code')" />
        <x-splade-input :label="__('Balance')" :placeholder="__('Balance')" type='number' name="balance" />
        <x-splade-select choices :label="__('Currency')" name="currency" :placeholder="__('Currency')">
            @foreach (\Modules\TomatoLocations\App\Models\Currency::all() as $currency)
                <option value="{{ $currency->iso }}">{{ $currency->name }}</option>
            @endforeach
        </x-splade-select>
        <x-splade-checkbox :label="__('Is activated')" name="is_activated" />
        <x-splade-checkbox :label="__('Is expired')" name="is_expired" />

        <div class="flex justify-start gap-2 pt-3">
            <x-tomato-admin-submit label="{{ __('Save') }}" :spinner="true" />
            <x-tomato-admin-button danger :href="route('admin.gift-cards.destroy', $model->id)"
                confirm="{{ trans('tomato-admin::global.crud.delete-confirm') }}"
                confirm-text="{{ trans('tomato-admin::global.crud.delete-confirm-text') }}"
                confirm-button="{{ trans('tomato-admin::global.crud.delete-confirm-button') }}"
                cancel-button="{{ trans('tomato-admin::global.crud.delete-confirm-cancel-button') }}" method="delete"
                label="{{ __('Delete') }}" />
            <x-tomato-admin-button secondary :href="route('admin.gift-cards.index')" label="{{ __('Cancel') }}" />
        </div>
    </x-splade-form>
</x-tomato-admin-container>
