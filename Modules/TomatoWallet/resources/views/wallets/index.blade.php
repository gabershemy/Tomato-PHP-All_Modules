<x-tomato-admin-layout>
    <x-slot:header>
        {{ __('Wallet') }}
    </x-slot:header>
    <div class="pb-12">
        <div class="mx-auto">
            <x-splade-table :for="$table" striped>
                <x-splade-cell balance>
                    <x-tomato-admin-row table  value="{!! dollar($item->balance) !!}" />
                </x-splade-cell>
                <x-splade-cell actions>
                    <div class="flex justify-start">
                        <x-tomato-admin-button modal type="icon" :href="$item->holder?->id ? route('admin.wallets.balance', $item->holder?->id) : '#'" title="{{__('Charge Balance')}}">
                            <x-heroicon-s-currency-dollar class="h-6 w-6"/>
                        </x-tomato-admin-button>
                        <x-tomato-admin-button success type="icon" title="{{trans('tomato-admin::global.crud.view')}}" modal :href="route('admin.wallets.show', $item->id)">
                            <x-heroicon-s-eye class="h-6 w-6"/>
                        </x-tomato-admin-button>
                    </div>
                </x-splade-cell>
            </x-splade-table>
        </div>
    </div>
</x-tomato-admin-layout>
