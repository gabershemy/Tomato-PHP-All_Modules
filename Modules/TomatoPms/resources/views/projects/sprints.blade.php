<x-splade-table :for="$query" v-if="data.tab==='sprints'" striped>
    <x-splade-cell project.name>
        <x-splade-link :href="route('admin.projects.show', $item->project?->id)" class="flex justify-start gap-2">
            @if($item->project?->color && $item->project?->icon)
                <div class="w-8 h-8 rounded-lg flex flex-col justify-center items-center" style="background-color: {{$item->project?->color}}">
                    <i class="{{$item->project?->icon}} text-white text-lg"></i>
                </div>
            @endif
            <div class="flex flex-col justify-center items-center font-bold">
                [{{ $item->project?->key }}] {{ $item->project?->name }}
            </div>
        </x-splade-link>
    </x-splade-cell>
    <x-splade-cell name>
        <x-splade-link :href="route('admin.issues.index').'?sprint_id='. $item->id" class="flex justify-start gap-2">
            @if($item->color && $item->icon)
                <div class="w-8 h-8 rounded-lg flex flex-col justify-center items-center" style="background-color: {{$item->color}}">
                    <i class="{{$item->icon}} text-white text-lg"></i>
                </div>
            @endif
            <div class="flex flex-col justify-center items-center font-bold">
                [{{ $item->project?->key .'-S-'. $item->id }}] {{ $item->name }}
            </div>
        </x-splade-link>
    </x-splade-cell>

    <x-splade-cell actions>
        <div class="flex justify-start">
            <x-tomato-admin-button success type="icon" title="{{trans('tomato-admin::global.crud.view')}}" modal :href="route('admin.sprints.show', $item->id)">
                <x-heroicon-s-eye class="h-6 w-6"/>
            </x-tomato-admin-button>
            <x-tomato-admin-button warning type="icon" title="{{trans('tomato-admin::global.crud.edit')}}" modal :href="route('admin.sprints.edit', $item->id)">
                <x-heroicon-s-pencil class="h-6 w-6"/>
            </x-tomato-admin-button>
            <x-tomato-admin-button danger type="icon" title="{{trans('tomato-admin::global.crud.delete')}}" :href="route('admin.sprints.destroy', $item->id)"
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
