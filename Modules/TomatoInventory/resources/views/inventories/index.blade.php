<x-tomato-admin-layout>
    <x-slot:header>
        @isset($history)
            {{ __('Inventory') }}
        @else
            {{ __('Pending Inventory') }}
        @endisset
    </x-slot:header>
    <x-slot:buttons>
        <x-tomato-admin-button class="w-full" :href="route('admin.inventories.create')" type="link">
            {{__('Add Items')}}
        </x-tomato-admin-button>
        <x-tomato-admin-button warning :modal="true" :href="route('admin.inventories.import')" type="link">
            <x-tomato-admin-tooltip :text="__('Import Inventory')">
                <i class="bx bx-import"></i>
            </x-tomato-admin-tooltip>
        </x-tomato-admin-button>
    </x-slot:buttons>
    <x-slot:icon>
        @isset($history)
            bx bx-building-house
        @else
            bx bx-pause-circle
        @endisset
    </x-slot:icon>

    <div class="pb-12">
        <div class="mx-auto">
            <x-splade-table :for="$table" striped>
                <x-slot:actions>
                    @can('admin.inventories.print')
                    <a href="{{route('admin.inventories.print') . '?history='}}{{isset($history) ? '1' : '0'}}" target="_blank" class="text-left w-full px-4 py-2 text-sm font-normal text-gray-700 dark:text-white dark:hover:bg-gray-600 hover:bg-gray-50 hover:text-gray-900">
                        <div class="flex justify-start gap-2">
                            <div class="flex flex-col justify-center items-center">
                                <i class="bx bx-printer"></i>
                            </div>
                            <div>  {{__('Print Inventory Report')}} </div>
                        </div>
                    </a>
                    @endcan
                    <x-tomato-admin-table-action modal :href="route('admin.inventories.report')" secondary icon="bx bx-chart">
                        {{__('Product Inventory Report')}}
                    </x-tomato-admin-table-action>
                    <x-tomato-admin-table-action modal :href="route('admin.inventories.barcodes')" secondary icon="bx bx-barcode">
                        {{__('Print Product Barcodes')}}
                    </x-tomato-admin-table-action>
                </x-slot:actions>
                <x-splade-cell items>
                    @include('tomato-inventory::inventories.items')
                </x-splade-cell>
                <x-splade-cell status>
                    <x-splade-form confirm method="POST" class="w-full" action="{{route('admin.inventories.status', $item->id)}}" :default="$item" submit-on-change>
                        <x-splade-select class="w-64" :disabled="$item->status === 'canceled' || $item->status === 'done'" name="status" placeholder="{{__('Status')}}" >
                            <option value="pending">{{__('Pending')}}</option>
                            <option value="not-available">{{__('Not Available')}}</option>
                            <option value="part-available">{{__('Part Available')}}</option>
                            <option value="canceled">{{__('Canceled')}}</option>
                            <option value="done">{{__('Done')}}</option>
                        </x-splade-select>
                    </x-splade-form>
                </x-splade-cell>
                <x-splade-cell created_at>
                    <x-tomato-admin-row table type="datetime" value="{{$item->created_at}}" />
                </x-splade-cell>
                <x-splade-cell is_activated>
                    <x-tomato-admin-row table type="bool" :value="$item->is_activated" />
                </x-splade-cell>
                <x-splade-cell order.uuid>
                    @if($item->order_id)
                    <div class="grid gap-y-2">
                        <a href="{{ route('admin.orders.print', $item->order?->id) }}" target="_blank" class="flex fi-in-text">
                            <div class="min-w-0 flex-1">
                                <div class="whitespace-nowrap inline-flex items-center gap-2 justify-center ml-auto rtl:ml-0 rtl:mr-auto min-h-4 px-2 py-0.5 text-xs font-medium tracking-tight rounded-xl whitespace-normal text-primary-700 bg-primary-500/10 dark:text-primary-500">
                                    <div class="flex justify-center gap-2">
                                        <x-heroicon-s-printer class="h-4 w-4"/>
                                        <div>
                                            {{$item->order?->uuid}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    @else
                        -
                    @endif
                </x-splade-cell>
                <x-splade-cell total>
                    <x-tomato-admin-row table  :value="dollar($item->total)" />
                </x-splade-cell>


                <x-splade-cell actions>
                    @include('tomato-inventory::inventories.actions')
                </x-splade-cell>
            </x-splade-table>
        </div>
    </div>
</x-tomato-admin-layout>
