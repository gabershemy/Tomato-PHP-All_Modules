<x-tomato-admin-layout>
    <x-slot:header>
        {{ __('Refund') }}
    </x-slot:header>
    <x-slot:buttons>
        <x-tomato-admin-button  :href="route('admin.refunds.create')" type="link">
            {{trans('tomato-admin::global.crud.create-new')}} {{__('Refund')}}
        </x-tomato-admin-button>
    </x-slot:buttons>

    <div class="pb-12">
        <div class="mx-auto">
            <x-splade-table :for="$table" striped>
                <x-splade-cell status>
                    <x-splade-form confirm method="POST" class="w-full" action="{{route('admin.refunds.status', $item->id)}}" :default="$item" submit-on-change>
                        <x-splade-select class="w-32" :disabled="$item->status !== 'pending'" name="status" placeholder="{{__('Status')}}" >
                            <option value="pending">{{__('Pending')}}</option>
                            <option value="factory">{{__('Factory')}}</option>
                            <option value="bad">{{__('Bad')}}</option>
                            <option value="inventory">{{__('Inventory')}}</option>
                        </x-splade-select>
                    </x-splade-form>
                </x-splade-cell>
                <x-splade-cell is_activated>
                    <x-tomato-admin-row table type="bool" :value="$item->is_activated" />
                </x-splade-cell>
                <x-splade-cell vat>
                    <x-tomato-admin-row table type="number" :value="$item->vat" />
                </x-splade-cell>
                <x-splade-cell discount>
                    <x-tomato-admin-row table type="number" :value="$item->discount" />
                </x-splade-cell>
                <x-splade-cell total>
                    <x-tomato-admin-row table type="number" :value="$item->total" />
                </x-splade-cell>

                <x-splade-cell actions>
                    <div class="flex justify-start">
                        @if(!$item->is_activated)
                            <x-tomato-admin-button confirm method="POST" type="icon" title="{{__('Approve All')}}" :href="route('admin.refunds.approve', $item->id)">
                                <x-heroicon-s-check-circle class="h-6 w-6"/>
                            </x-tomato-admin-button>
                        @endif
                        <x-tomato-admin-button success type="icon" title="{{trans('tomato-admin::global.crud.view')}}" :href="route('admin.refunds.show', $item->id)">
                            <x-heroicon-s-eye class="h-6 w-6"/>
                        </x-tomato-admin-button>
                        <x-tomato-admin-button warning type="icon" title="{{trans('tomato-admin::global.crud.edit')}}" :href="route('admin.refunds.edit', $item->id)">
                            <x-heroicon-s-pencil class="h-6 w-6"/>
                        </x-tomato-admin-button>
                        <x-tomato-admin-button danger type="icon" title="{{trans('tomato-admin::global.crud.delete')}}" :href="route('admin.refunds.destroy', $item->id)"
                           confirm="{{trans('tomato-admin::global.crud.delete-confirm')}}"
                           confirm-text="{{trans('tomato-admin::global.crud.delete-confirm-text')}}"
                           confirm-button="{{trans('tomato-admin::global.crud.delete-confirm-button')}}"
                           cancel-button="{{trans('tomato-admin::global.crud.delete-confirm-cancel-button')}}"
                           method="delete"
                        >
                            <x-heroicon-s-trash class="h-6 w-6"/>
                        </x-tomato-admin-button>
                    </div>
                </x-splade-cell>
            </x-splade-table>
        </div>
    </div>
</x-tomato-admin-layout>
