<x-splade-table :for="$query" striped>
    <x-splade-cell is_closed>
        <x-tomato-admin-row table type="bool" :value="$item->is_closed" />
    </x-splade-cell>

    <x-splade-cell actions>
        <div class="flex justify-start">
            <x-tomato-admin-button success type="icon" title="{{trans('tomato-admin::global.crud.view')}}" modal :href="route('admin.inventory-logs.show', $item->id)">
                <x-heroicon-s-eye class="h-6 w-6"/>
            </x-tomato-admin-button>
            <x-tomato-admin-button warning type="icon" title="{{trans('tomato-admin::global.crud.edit')}}" modal :href="route('admin.inventory-logs.edit', $item->id)">
                <x-heroicon-s-pencil class="h-6 w-6"/>
            </x-tomato-admin-button>
            <x-tomato-admin-button danger type="icon" title="{{trans('tomato-admin::global.crud.delete')}}" :href="route('admin.inventory-logs.destroy', $item->id)"
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
