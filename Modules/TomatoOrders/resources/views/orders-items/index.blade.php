<x-tomato-admin-layout>
    <x-slot:header>
        {{ __('Orders Item') }}
    </x-slot:header>
    <x-slot:buttons>
        <x-tomato-admin-button :modal="true" :href="route('admin.orders-items.create')" type="link">
            {{ trans('tomato-admin::global.crud.create-new') }} {{ __('Orders Item') }}
        </x-tomato-admin-button>
    </x-slot:buttons>

    <div class="pb-12">
        <div class="mx-auto">
            <x-splade-table :for="$table" striped>
                <x-splade-cell price>
                    <x-tomato-admin-row table type="number" :value="$item->price" />
                </x-splade-cell>
                <x-splade-cell discount>
                    <x-tomato-admin-row table type="number" :value="$item->discount" />
                </x-splade-cell>
                <x-splade-cell tax>
                    <x-tomato-admin-row table type="number" :value="$item->tax" />
                </x-splade-cell>
                <x-splade-cell total>
                    <x-tomato-admin-row table type="number" :value="$item->total" />
                </x-splade-cell>
                <x-splade-cell returned>
                    <x-tomato-admin-row table type="number" :value="$item->returned" />
                </x-splade-cell>
                <x-splade-cell qty>
                    <x-tomato-admin-row table type="number" :value="$item->qty" />
                </x-splade-cell>
                <x-splade-cell returned_qty>
                    <x-tomato-admin-row table type="number" :value="$item->returned_qty" />
                </x-splade-cell>
                <x-splade-cell is_free>
                    <x-tomato-admin-row table type="bool" :value="$item->is_free" />
                </x-splade-cell>
                <x-splade-cell is_returned>
                    <x-tomato-admin-row table type="bool" :value="$item->is_returned" />
                </x-splade-cell>

                <x-splade-cell actions>
                    <div class="flex justify-start">
                        <x-tomato-admin-button success type="icon"
                            title="{{ trans('tomato-admin::global.crud.view') }}" modal :href="route('admin.orders-items.show', $item->id)">
                            <x-heroicon-s-eye class="h-6 w-6" />
                        </x-tomato-admin-button>
                        <x-tomato-admin-button warning type="icon"
                            title="{{ trans('tomato-admin::global.crud.edit') }}" modal :href="route('admin.orders-items.edit', $item->id)">
                            <x-heroicon-s-pencil class="h-6 w-6" />
                        </x-tomato-admin-button>
                        <x-tomato-admin-button danger type="icon"
                            title="{{ trans('tomato-admin::global.crud.delete') }}" :href="route('admin.orders-items.destroy', $item->id)"
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
