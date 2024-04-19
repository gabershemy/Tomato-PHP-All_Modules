@if(request()->has('parent_id'))

@endif

@php
    if(request()->has('parent_id')){
        $parent = \Modules\TomatoPms\App\Models\Issue::find(request()->get('parent_id'));
        $type = \Modules\TomatoCategory\App\Models\Type::where('for', 'issues')->where('type', 'types')->where('key', $parent->type)->first();
    }
@endphp

<x-tomato-admin-layout>
    <x-slot:header>
        @if(request()->has('parent_id'))
            {{ $parent->summary }}
        @else
            {{ __('Issues') }}
        @endif
    </x-slot:header>
    <x-slot:icon>
        @if(request()->has('parent_id'))
            {{$type->icon}}
        @else
            bx bxs-category
        @endif
    </x-slot:icon>
    <x-slot:buttons>
        @if(request()->has('parent_id'))
            <x-tomato-admin-button warning :href="route('admin.issues.index')" type="link">
                {{__('Back')}}
            </x-tomato-admin-button>
            <x-tomato-admin-button :modal="true" :href="route('admin.issues.create').'?parent_id='.request()->get('parent_id')" type="link">
                {{trans('tomato-admin::global.crud.create-new')}} {{__('Issue')}}
            </x-tomato-admin-button>
       @else
            <x-tomato-admin-button :modal="true" :href="route('admin.issues.create')" type="link">
                {{trans('tomato-admin::global.crud.create-new')}} {{__('Issue')}}
            </x-tomato-admin-button>
        @endif

        <x-tomato-admin-dropdown>
            <x-slot:button>
                <div class="filament-button inline-flex items-center justify-center py-1 gap-1 font-medium rounded-lg border transition-colors focus:outline-none focus:ring-offset-2 focus:ring-2 focus:ring-inset dark:focus:ring-offset-0 min-h-[2.25rem] px-4 text-sm shadow-sm focus:ring-white filament-page-button-action bg-primary-600 hover:bg-primary-500 focus:bg-primary-700 focus:ring-offset-primary-700 text-white border-transparent">
                    <i class="bx bx-cog"></i>
                </div>
            </x-slot:button>

            <x-tomato-admin-dropdown-item type="link" :href="route('admin.types.issues.types.index')" :label="__('Types')" icon="bx bxs-circle" />
            <x-tomato-admin-dropdown-item type="link" :href="route('admin.types.issues.status.index')" :label="__('Status')" icon="bx bxs-circle" />
        </x-tomato-admin-dropdown>
    </x-slot:buttons>

    <div class="pb-12">
        <div class="mx-auto">
            <x-splade-table :for="$table" striped>
                <x-splade-cell summary>
                    @php $type = \Modules\TomatoCategory\App\Models\Type::where('for', 'issues')->where('type', 'types')->where('key', $item->type)->first(); @endphp
                    @if($type)
                        <x-splade-link :href="route('admin.issues.index').'?parent_id='.$item->id" class="flex justify-start gap-2">
                            <div class="flex flex-col justify-center items-center ">
                                <x-tomato-admin-tooltip :text="$type->name">
                                    <div class="w-6 h-6 flex flex-col justify-center items-center  rounded-lg text-white" style="background-color: {{$type->color}}">
                                        <i class="{{$type->icon}} text-sm"></i>
                                    </div>
                                </x-tomato-admin-tooltip>
                            </div>
                            <div class="flex flex-col justify-center items-center">
                                <div class="flex flex-col justify-center items-center">
                                    <div class="flex flex-col justify-start">
                                        <span class="font-bold">{{$item->summary}}</span>
                                        <div>
                                            <span class="text-gray-400 text-xs">{{ $item->project?->key .'-'. $item->id }}</span>
                                            <span> - </span>
                                            <span class="text-gray-400 text-xs">{{ $item->project?->name }}</span>
                                            <span> - </span>
                                            <span class="text-gray-400 text-xs">{{ $item->created_at->diffForHumans() }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </x-splade-link>
                    @endif
                </x-splade-cell>
                <x-splade-cell status>
                    @php $status = \Modules\TomatoCategory\App\Models\Type::where('for', 'issues')->where('type', 'status')->where('key', $item->status)->first(); @endphp
                    @if($status)
                        <x-splade-link :href="route('admin.issues.index').'?filter[status]='.$status->key" class="flex justify-start gap-2">
                            <div class="flex flex-col justify-center items-center w-6 h-6  rounded-lg text-white" style="background-color: {{$status->color}}">
                                <i class="{{$status->icon}} text-sm"></i>
                            </div>
                            <div class="flex flex-col justify-center items-center font-bold">
                                {{$status->name}}
                            </div>
                        </x-splade-link>
                    @endif
                </x-splade-cell>

                <x-splade-cell actions>
                    <div class="flex justify-start">
                        <x-tomato-admin-button success type="icon" title="{{trans('tomato-admin::global.crud.view')}}" :href="route('admin.issues.show', $item->id)">
                            <x-heroicon-s-eye class="h-6 w-6"/>
                        </x-tomato-admin-button>
                        <x-tomato-admin-button warning type="icon" title="{{trans('tomato-admin::global.crud.edit')}}" modal :href="route('admin.issues.edit', $item->id)">
                            <x-heroicon-s-pencil class="h-6 w-6"/>
                        </x-tomato-admin-button>
                        <x-tomato-admin-button danger type="icon" title="{{trans('tomato-admin::global.crud.delete')}}" :href="route('admin.issues.destroy', $item->id)"
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
