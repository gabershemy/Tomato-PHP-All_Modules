<x-tomato-admin-layout>
    <x-slot:header>
        {{ __('Project') }}
    </x-slot:header>
    <x-slot:buttons>
        <x-tomato-admin-button :modal="true" :href="route('admin.projects.create')" type="link">
            {{trans('tomato-admin::global.crud.create-new')}} {{__('Project')}}
        </x-tomato-admin-button>
    </x-slot:buttons>

    <div class="pb-12">
        <div class="mx-auto">
            <x-splade-table :for="$table" striped>
                <x-splade-cell name>
                    <x-splade-link :href="route('admin.projects.show', $item->id)" class="flex justify-start gap-2">
                        @if($item->color && $item->icon)
                        <div class="w-8 h-8 rounded-lg flex flex-col justify-center items-center" style="background-color: {{$item->color}}">
                            <i class="{{$item->icon}} text-white text-lg"></i>
                        </div>
                        @endif
                        <div class="flex flex-col justify-center items-center">
                            <div class="flex justify-start gap-2">
                                <span class="text-gray-400">{{ $item->key }}</span>
                                <span class="font-bold">{{ $item->name }}</span>
                            </div>
                        </div>
                    </x-splade-link>
                </x-splade-cell>

                <x-splade-cell actions>
                    <div class="flex justify-start">
                        <x-tomato-admin-button success type="icon" title="{{__('Permissions')}}" modal :href="route('admin.projects.permissions', $item->id)">
                            <x-heroicon-s-user-circle class="h-6 w-6"/>
                        </x-tomato-admin-button>
                        <x-tomato-admin-button type="icon" title="{{__('Details')}}" :href="route('admin.projects.description', $item->id)">
                            <x-heroicon-s-information-circle class="h-6 w-6"/>
                        </x-tomato-admin-button>
                        <x-tomato-admin-button  warning type="icon" title="{{__('Rates')}}" modal :href="route('admin.projects.rates', $item->id)">
                            <x-heroicon-s-currency-dollar class="h-6 w-6"/>
                        </x-tomato-admin-button>
                        <x-tomato-admin-button type="icon" title="{{__('Status')}}" modal :href="route('admin.projects.status', $item->id)">
                            <x-heroicon-s-question-mark-circle class="h-6 w-6"/>
                        </x-tomato-admin-button>
                        <x-tomato-admin-button warning type="icon" title="{{trans('tomato-admin::global.crud.edit')}}" modal :href="route('admin.projects.edit', $item->id)">
                            <x-heroicon-s-pencil class="h-6 w-6"/>
                        </x-tomato-admin-button>
                        <x-tomato-admin-button danger type="icon" title="{{trans('tomato-admin::global.crud.delete')}}" :href="route('admin.projects.destroy', $item->id)"
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
