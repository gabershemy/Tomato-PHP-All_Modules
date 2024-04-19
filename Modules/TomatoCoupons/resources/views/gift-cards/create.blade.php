<x-tomato-admin-container label="{{ trans('tomato-admin::global.crud.create') }} {{ __('Gift Card') }}">
    <x-splade-form class="flex flex-col space-y-4" action="{{ route('admin.gift-cards.store') }}" method="post"
        :default="[
            'code' => explode('-', \Illuminate\Support\Str::uuid())[0],
            'currency' => 'USD',
            'is_activated' => true,
        ]">

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
            <x-tomato-admin-button secondary :href="route('admin.gift-cards.index')" label="{{ __('Cancel') }}" />
        </div>
    </x-splade-form>
</x-tomato-admin-container>
