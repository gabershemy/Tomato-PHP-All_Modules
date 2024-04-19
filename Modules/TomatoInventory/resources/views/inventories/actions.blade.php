<div class="flex justify-start">
    @if(!$item->is_activated)
        @can('admin.inventories.approve')
            <x-tomato-admin-button confirm method="POST" type="icon" title="{{__('Approve All')}}" :href="route('admin.inventories.approve', $item->id)">
                <x-heroicon-s-check-circle class="h-6 w-6"/>
            </x-tomato-admin-button>
        @endcan
    @endif
    @can('admin.inventories.print.show')
        <a href="{{route('admin.inventories.print.barcode', $item->id)}}" target="_blank" title="{{__('Barcode')}}" class="px-2 text-primary-500">
            <x-heroicon-s-qr-code class="h-6 w-6"/>
        </a>

        <a href="{{route('admin.inventories.print.show', $item->id)}}" target="_blank" title="{{__('Print')}}" class="px-2 text-success-500">
            <x-heroicon-s-printer class="h-6 w-6"/>
        </a>
    @endcan
    <x-tomato-admin-button success type="icon" title="{{trans('tomato-admin::global.crud.view')}}" :href="route('admin.inventories.show', $item->id)">
        <x-heroicon-s-eye class="h-6 w-6"/>
    </x-tomato-admin-button>
    @if($item->status !== 'canceled' && $item->status !== 'done')
        <x-tomato-admin-button warning type="icon" title="{{trans('tomato-admin::global.crud.edit')}}" :href="route('admin.inventories.edit', $item->id)">
            <x-heroicon-s-pencil class="h-6 w-6"/>
        </x-tomato-admin-button>
        <x-tomato-admin-button danger type="icon" title="{{trans('tomato-admin::global.crud.delete')}}" :href="route('admin.inventories.destroy', $item->id)"
                               confirm="{{trans('tomato-admin::global.crud.delete-confirm')}}"
                               confirm-text="{{trans('tomato-admin::global.crud.delete-confirm-text')}}"
                               confirm-button="{{trans('tomato-admin::global.crud.delete-confirm-button')}}"
                               cancel-button="{{trans('tomato-admin::global.crud.delete-confirm-cancel-button')}}"
                               method="delete"
        >
            <x-heroicon-s-trash class="h-6 w-6"/>
        </x-tomato-admin-button>
    @endif
</div>
