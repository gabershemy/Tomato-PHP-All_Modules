<x-tomato-admin-layout>
    <x-slot:header>
        {{trans('tomato-backup::global.title')}}
    </x-slot:header>
    <x-slot:buttons>
        <x-tomato-admin-button modal :href="route('admin.backup.create')">
            {{trans('tomato-admin::global.crud.create-new')}} {{trans('tomato-backup::global.title')}}
        </x-tomato-admin-button>
        <x-tomato-logout />
    </x-slot:buttons>


    <div class="pb-12" v-cloak>
        <div class="mx-auto">
            <x-splade-table :for="$table" striped>
                <x-splade-cell actions>
                    <div class="flex justify-start">
                        <a href="/admin/backup/{{ $item->id }}" title="{{trans('tomato-backup::global.download')}}"  class="px-2 text-primary-500" target="_blank">
                            <x-tomato-admin-tooltip :text="__('Donwload Backup')">
                                <x-heroicon-s-document-arrow-down class="h-6 w-6"/>
                            </x-tomato-admin-tooltip>
                        </a>
                        <x-tomato-admin-button
                            type="icon"
                            :href="route('admin.backup.destroy', $item->id)"
                            confirm="{{trans('tomato-admin::global.crud.delete-confirm')}}"
                            confirm-text="{{trans('tomato-admin::global.crud.delete-confirm-text')}}"
                            confirm-button="{{trans('tomato-admin::global.crud.delete-confirm-button')}}"
                            cancel-button="{{trans('tomato-admin::global.crud.delete-confirm-cancel-button')}}"
                            class="px-2 text-red-500"
                            method="delete"
                        >
                            <x-tomato-admin-tooltip :text="__('Delete Backup')">
                                <x-heroicon-s-trash class="h-6 w-6"/>
                            </x-tomato-admin-tooltip>
                        </x-tomato-admin-button>
                    </div>
                </x-splade-cell>
            </x-splade-table>
        </div>
    </div>
</x-tomato-admin-layout>
