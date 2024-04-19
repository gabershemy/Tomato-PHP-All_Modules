<x-tomato-admin-layout>
    <x-slot:header>
        {{ __('Coupon') }}
    </x-slot:header>
    <x-slot:buttons>
        <x-tomato-admin-button :modal="true" :href="route('admin.coupons.create')" type="link">
            {{trans('tomato-admin::global.crud.create-new')}} {{__('Coupon')}}
        </x-tomato-admin-button>
    </x-slot:buttons>

    <div class="pb-12">
        <div class="mx-auto">
            <x-splade-table :for="$table" striped>
                <x-splade-cell amount>
    <x-tomato-admin-row table type="number" :value="$item->amount" />
</x-splade-cell>
<x-splade-cell is_limited>
    <x-tomato-admin-row table type="bool" :value="$item->is_limited" />
</x-splade-cell>
<x-splade-cell use_limit>
    <x-tomato-admin-row table type="number" :value="$item->use_limit" />
</x-splade-cell>
<x-splade-cell use_limit_by_user>
    <x-tomato-admin-row table type="number" :value="$item->use_limit_by_user" />
</x-splade-cell>
<x-splade-cell order_total_limit>
    <x-tomato-admin-row table type="number" :value="$item->order_total_limit" />
</x-splade-cell>
<x-splade-cell is_activated>
    <x-tomato-admin-row table type="bool" :value="$item->is_activated" />
</x-splade-cell>
<x-splade-cell is_marketing>
    <x-tomato-admin-row table type="bool" :value="$item->is_marketing" />
</x-splade-cell>
<x-splade-cell marketer_amount>
    <x-tomato-admin-row table type="number" :value="$item->marketer_amount" />
</x-splade-cell>
<x-splade-cell marketer_amount_max>
    <x-tomato-admin-row table type="number" :value="$item->marketer_amount_max" />
</x-splade-cell>
<x-splade-cell marketer_show_amount_max>
    <x-tomato-admin-row table type="bool" :value="$item->marketer_show_amount_max" />
</x-splade-cell>
<x-splade-cell marketer_hide_total_sales>
    <x-tomato-admin-row table type="bool" :value="$item->marketer_hide_total_sales" />
</x-splade-cell>
<x-splade-cell is_used>
    <x-tomato-admin-row table type="number" :value="$item->is_used" />
</x-splade-cell>

                <x-splade-cell actions>
                    <div class="flex justify-start">
                        <x-tomato-admin-button success type="icon" title="{{trans('tomato-admin::global.crud.view')}}" modal :href="route('admin.coupons.show', $item->id)">
                            <x-heroicon-s-eye class="h-6 w-6"/>
                        </x-tomato-admin-button>
                        <x-tomato-admin-button warning type="icon" title="{{trans('tomato-admin::global.crud.edit')}}" modal :href="route('admin.coupons.edit', $item->id)">
                            <x-heroicon-s-pencil class="h-6 w-6"/>
                        </x-tomato-admin-button>
                        <x-tomato-admin-button danger type="icon" title="{{trans('tomato-admin::global.crud.delete')}}" :href="route('admin.coupons.destroy', $item->id)"
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
