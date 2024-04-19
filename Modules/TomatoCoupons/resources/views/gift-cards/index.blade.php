<x-tomato-admin-layout>
    <x-slot:header>
        {{ __('Gift Card') }}
    </x-slot:header>
    <x-slot:buttons>
        <x-tomato-admin-button :modal="true" :href="route('admin.gift-cards.create')" type="link">
            {{ trans('tomato-admin::global.crud.create-new') }} {{ __('Gift Card') }}
        </x-tomato-admin-button>
    </x-slot:buttons>

    <div class="pb-12">
        <div class="mx-auto">
            <x-splade-table :for="$table" striped>
                <x-splade-cell balance>
                    <x-tomato-admin-row table type="number" :value="$item->balance" />
                </x-splade-cell>
                <x-splade-cell is_activated>
                    <x-tomato-admin-row table type="bool" :value="$item->is_activated" />
                </x-splade-cell>
                <x-splade-cell is_expired>
                    <x-tomato-admin-row table type="bool" :value="$item->is_expired" />
                </x-splade-cell>

                <x-splade-cell actions>
                    <div class="flex justify-start">
                        <x-tomato-admin-button success type="icon"
                            title="{{ trans('tomato-admin::global.crud.view') }}" modal :href="route('admin.gift-cards.show', $item->id)">
                            <x-heroicon-s-eye class="h-6 w-6" />
                        </x-tomato-admin-button>
                        <x-tomato-admin-button warning type="icon"
                            title="{{ trans('tomato-admin::global.crud.edit') }}" modal :href="route('admin.gift-cards.edit', $item->id)">
                            <x-heroicon-s-pencil class="h-6 w-6" />
                        </x-tomato-admin-button>
                        <x-tomato-admin-button danger type="icon"
                            title="{{ trans('tomato-admin::global.crud.delete') }}" :href="route('admin.gift-cards.destroy', $item->id)"
                            confirm="{{ trans('tomato-admin::global.crud.delete-confirm') }}"
                            confirm-text="{{ trans('tomato-admin::global.crud.delete-confirm-text') }}"
                            confirm-button="{{ trans('tomato-admin::global.crud.delete-confirm-button') }}"
                            cancel-button="{{ trans('tomato-admin::global.crud.delete-confirm-cancel-button') }}"
                            method="delete">
                            <x-heroicon-s-trash class="h-6 w-6" />
                        </x-tomato-admin-button>
                    </div>
                </x-splade-cell>
            </x-splade-table>
        </div>
    </div>
</x-tomato-admin-layout>
