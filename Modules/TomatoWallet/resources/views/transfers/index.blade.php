<x-tomato-admin-layout>
    <x-slot:header>
        {{ __('Transfer') }}
    </x-slot:header>
{{--    <x-slot:buttons>--}}
{{--        <x-tomato-admin-button :modal="true" :href="route('admin.transfers.create')" type="link">--}}
{{--            {{trans('tomato-admin::global.crud.create-new')}} {{__('Transfer')}}--}}
{{--        </x-tomato-admin-button>--}}
{{--    </x-slot:buttons>--}}

    <div class="pb-12">
        <div class="mx-auto">
            <x-splade-table :for="$table" striped>

                <x-splade-cell actions>
                    <div class="flex justify-start">
                        <x-tomato-admin-button success type="icon" title="{{trans('tomato-admin::global.crud.view')}}" modal :href="route('admin.transfers.show', $item->id)">
                            <x-heroicon-s-eye class="h-6 w-6"/>
                        </x-tomato-admin-button>
                    </div>
                </x-splade-cell>
            </x-splade-table>
        </div>
    </div>
</x-tomato-admin-layout>
