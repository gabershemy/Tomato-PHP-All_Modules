@php
    $type = \Modules\TomatoCategory\App\Models\Type::where('for', 'issues')->where('type', 'types')->where('key', $model->type)->first();
    $parent = \Modules\TomatoPms\App\Models\Issue::find($model->parent_id);
@endphp
<x-tomato-admin-layout>
    <div class="flex justify-between">
        <div class="flex justify-start gap-2">
            @if($parent)
                @php $parentType = \Modules\TomatoCategory\App\Models\Type::where('for', 'issues')->where('type', 'types')->where('key', $parent->type)->first(); @endphp
                <x-splade-link :href="route('admin.issues.show', $parent->id)" class="flex justify-start gap-1">
                    <div class="flex flex-col justify-center items-center">
                        <div class="p-1 text-white rounded-sm flex flex-col justify-center items-center"  style="background-color: {{$parentType->color}}">
                            <i class="{{ $parentType->icon }} text-sm text-center"></i>
                        </div>
                    </div>
                    <div class="flex flex-col justify-center items-center text-sm text-gray-600">
                        {{ $parent->project?->key .'-'. $parent->id }}
                    </div>
                    <div class="text-sm text-gray-600 flex flex-col justify-center">
                        <div>
                            -
                        </div>
                    </div>
                </x-splade-link>
            @endif

            <x-tomato-admin-copy :text="route('admin.issues.show', $model->id)">
                <div class="flex justify-start gap-1">
                    <div class="flex flex-col justify-center items-center">
                        <div class="p-1 text-white rounded-sm flex flex-col justify-center items-center"  style="background-color: {{@$type->color}}">
                            <i class="{{ @$type->icon }} text-sm text-center"></i>
                        </div>
                    </div>
                    <div class="flex flex-col justify-center items-center text-sm text-gray-600">
                        {{ $model->project?->key .'-'. $model->id }}
                    </div>
                </div>
            </x-tomato-admin-copy>
        </div>
        <div>
            <x-tomato-admin-button warning :href="route('admin.issues.edit', $model->id)" modal>
                {{ __('Edit') }}
            </x-tomato-admin-button>
        </div>
    </div>
    <div class="grid grid-cols-12 gap-4 my-4 ">
       <div class="col-span-8 overflow-y-scroll h-max-screen bg-white rounded-lg border border-gray-200 shadow-sm p-4">
           <div>
               <div class="flex justify-start gap-2 mb-4">
                   <div class="p-2 w-8 h-8 text-white flex flex-col rounded-lg  justify-center items-center" style="background-color: {{$model->getType?->color}}">
                       <i class="{{ $model->getType?->icon }}"></i>
                   </div>
                   <div>
                       <h1 class="text-2xl font-bold tracking-tight  filament-header-heading">
                           {{ $model->summary }}
                       </h1>
                   </div>
               </div>
               <hr />
               <div class="mt-4">
                   <h1 class="text-md font-bold my-2">{{__('Description')}}</h1>
                   {!! $model->description !!}
               </div>
           </div>
       </div>
       <div class="col-span-4 overflow-y-scroll h-max-screen bg-white rounded-lg border border-gray-200 shadow-sm p-4">
           @php $statues = \Modules\TomatoCategory\App\Models\Type::where('for', 'issues')->where('type', 'status')->get(); @endphp
            <div class="flex flex-col gap-4">
                @if(!$model->is_closed)
                <x-splade-form submit-on-change method="POST" :action="route('admin.issues.update', $model->id)" :default="$model">
                    <p class="text-sm font-bold">{{__('Status')}}</p>
                    <x-splade-select choices="{allowHTML:true}" name="status" type="text"  :placeholder="__('Status')">
                        @foreach($statues as $status)
                            <option value="{{$status->key}}">
                                <div class="flex justify-start gap-2">
                                    <div class="flex flex-col justify-center items-center w-6 h-6  rounded-lg text-white" style="background-color: {{$status->color}}">
                                        <i class="{{$status->icon}} text-sm"></i>
                                    </div>
                                    <div class="flex flex-col justify-center items-center font-bold">
                                        {{$status->name}}
                                    </div>
                                </div>
                            </option>
                        @endforeach
                    </x-splade-select>
                </x-splade-form>
                @else
                    <div>
                        <p class="text-sm font-bold">{{__('Status')}}</p>
                        <div class="flex justify-start gap-2 my-1">
                            <div class="flex flex-col justify-center items-center">
                                <x-tomato-admin-tooltip :text="__('Closed')">
                                    <div class="flex flex-col justify-center items-center text-white p-1 rounded-md bg-danger-500">
                                        <i class="bx bxs-x-circle"></i>
                                    </div>
                                </x-tomato-admin-tooltip>
                            </div>
                            <div class="flex flex-col justify-center items-center">
                                <div>
                                    {{__('Closed')}}
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                    <div>
                    <p class="text-sm font-bold">{{__('Reporter')}}</p>
                    <div class="flex justify-start gap-2 my-1">
                        <div class="flex flex-col justify-center items-center">
                            <img src="{{$model->reporter?->profile_photo_url}}" class="w-8 h-8 rounded-full" alt="">
                        </div>
                        <div class="flex flex-col justify-center items-center">
                            {{$model->reporter?->name}}
                        </div>
                    </div>
                </div>
                @if($model->parent)
                <div>
                    <p class="text-sm font-bold">{{__('Parent')}}</p>
                    <div class="flex justify-start gap-2 my-1">
                        <div class="flex flex-col justify-center items-center">
                            <x-tomato-admin-tooltip :text="$model->parent?->getType?->name">
                                <div class="flex flex-col justify-center items-center text-white p-1 rounded-md" style="background-color: {{$model->parent?->getType?->color}}">
                                    <i class="{{$model->parent?->getType?->icon}}"></i>
                                </div>
                            </x-tomato-admin-tooltip>
                        </div>
                        <div class="flex flex-col justify-center items-center">
                            <x-splade-link :href="route('admin.issues.show', $model->parent?->id)" class="text-primary-500 underline rounded-md p-1">
                                <span class="text-gray-400">{{$model->project?->key}}-{{$model->parent?->id}}</span> {{$model->parent?->summary}}
                            </x-splade-link>
                        </div>
                    </div>
                </div>
                @endif
                @if($model->sprint)
                <div>
                    <p class="text-sm font-bold">{{__('Sprint')}}</p>
                    <div class="flex justify-start gap-2 my-1">
                        <div class="flex flex-col justify-center items-center">
                            <x-tomato-admin-tooltip :text="__('Sprint')">
                                <div class="flex flex-col justify-center items-center text-white p-1 rounded-md" style="background-color: {{$model->sprint?->color}}">
                                    <i class="{{$model->sprint?->icon}}"></i>
                                </div>
                            </x-tomato-admin-tooltip>
                        </div>
                        <div class="flex flex-col justify-center items-center">
                            <x-splade-link class="text-primary-500 underline rounded-md p-1">
                                <span class="text-gray-400">{{$model->project?->key}}-S-{{$model->sprint?->id}}</span> {{$model->sprint?->name}}
                            </x-splade-link>
                        </div>
                    </div>
                </div>
                @endif
                <div>
                    <p class="text-sm font-bold">{{__('Priority')}}</p>
                    <div class="flex justify-start gap-2 my-1">
                        <div class="flex flex-col justify-center items-center">
                            <x-tomato-admin-tooltip :text="__('Priority')">
                                <div class="
                                @if($model->priority == 'highest')
                                        bg-danger-500
                                @elseif($model->priority == 'high')
                                        bg-danger-500
                                @elseif($model->priority == 'medium')
                                    bg-warning-500
                                @elseif($model->priority == 'low')
                                    bg-primary-500
                                @elseif($model->priority == 'lowest')
                                    bg-primary-500
                                @endif

                                flex flex-col justify-center items-center text-white p-1 rounded-md ">
                                    @if($model->priority == 'highest')
                                        <i class="bx bx-chevrons-up"></i>
                                    @elseif($model->priority == 'high')
                                        <i class="bx bx-chevron-up"></i>
                                    @elseif($model->priority == 'medium')
                                        <i class="bx bx-equalizer"></i>
                                    @elseif($model->priority == 'low')
                                        <i class="bx bx-chevron-down"></i>
                                    @elseif($model->priority == 'lowest')
                                        <i class="bx bx-chevrons-down"></i>
                                    @endif
                                </div>
                            </x-tomato-admin-tooltip>
                        </div>
                        <div class="flex flex-col justify-center items-center">
                            <div>
                                @if($model->priority == 'highest')
                                    {{__('Highest')}}
                                @elseif($model->priority == 'high')
                                    {{__('High')}}
                                @elseif($model->priority == 'medium')
                                    {{__('Medium')}}
                                @elseif($model->priority == 'low')
                                    {{__('Low')}}
                                @elseif($model->priority == 'lowest')
                                    {{__('Lowest')}}
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <p class="text-sm font-bold">{{__('Story Points')}}</p>
                    <div class="flex justify-start gap-2 my-1">
                        <div class="flex flex-col justify-center items-center">
                            <x-tomato-admin-tooltip :text="__('Story Points')">
                                <div class="flex flex-col justify-center items-center text-white p-1 rounded-md bg-success-500">
                                    <i class="bx bxs-check-circle"></i>
                                </div>
                            </x-tomato-admin-tooltip>
                        </div>
                        <div class="flex flex-col justify-center items-center">
                            {{$model->points}}
                        </div>
                    </div>
                </div>
                <div>
                    <p class="text-sm font-bold">{{__('Created At')}}</p>
                    <div class="flex justify-start gap-2 my-1">
                        <div class="flex flex-col justify-center items-center">
                            <x-tomato-admin-tooltip :text="__('Created At')">
                                <div class="flex flex-col justify-center items-center text-white p-1 rounded-md bg-primary-500">
                                    <i class="bx bxs-time"></i>
                                </div>
                            </x-tomato-admin-tooltip>
                        </div>
                        <div class="flex flex-col justify-center items-center">
                            {{$model->created_at->diffForHumans()}}
                        </div>
                    </div>
                </div>
                <div class="flex justify-start gap-4">
                    @if(!$model->is_closed)
                        <div>
                            <x-tomato-admin-button :data="['is_closed'=> true, 'closed_by'=>auth('web')->user()->id]" method="POST" :href="route('admin.issues.update', $model->id)" danger confirm>
                                {{__('Close')}}
                            </x-tomato-admin-button>
                        </div>
                    @else
                        <div>
                            <x-tomato-admin-button :data="['is_closed'=> false, 'closed_by'=>null]" method="POST" :href="route('admin.issues.update', $model->id)" success confirm>
                                {{__('Reopen')}}
                            </x-tomato-admin-button>
                        </div>
                    @endif
                    @if(class_exists(\Modules\TomatoPms\App\Models\Timer::class))
                    <div>
                        <x-tomato-admin-button method="POST" :href="route('admin.issues.timer', $model->id)" success confirm>
                            {{__('Start Timer')}}
                        </x-tomato-admin-button>
                    </div>
                    @endif
                </div>
            </div>
       </div>
   </div>
    @if($model->childrens()->count() > 0)
    <div class="overflow-y-scroll h-max-screen bg-white rounded-lg border border-gray-200 shadow-sm p-4 my-4">
        <x-splade-table :for="(new \Modules\TomatoPms\App\Tables\IssueTable($model->childrens()))">
            <x-splade-cell summary>
                <x-splade-link :href="route('admin.issues.show', $item->id)" class="flex justify-start gap-2">
                    <div class="flex flex-col justify-center items-center ">
                        <x-tomato-admin-tooltip :text="$item->getType?->name">
                            <div class="w-6 h-6 flex flex-col justify-center items-center  rounded-lg text-white" style="background-color: {{$item->getType?->color}}">
                                <i class="{{$item->getType?->icon}} text-sm"></i>
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
            </x-splade-cell>
            <x-splade-cell status>
                <div class="flex justify-start gap-2">
                    <div class="flex flex-col justify-center items-center w-6 h-6  rounded-lg text-white" style="background-color: {{$item->getStatus?->color}}">
                        <i class="{{$item->getStatus?->icon}} text-sm"></i>
                    </div>
                    <div class="flex flex-col justify-center items-center font-bold">
                        {{$item->getStatus?->name}}
                    </div>
                </div>
            </x-splade-cell>
            <x-splade-cell actions>
                <div class="flex justify-start">
                    <x-tomato-admin-button success type="icon" title="{{trans('tomato-admin::global.crud.view')}}" :href="route('admin.issues.show', $item->id)">
                        <x-heroicon-s-eye class="h-6 w-6"/>
                    </x-tomato-admin-button>
                </div>
            </x-splade-cell>
        </x-splade-table>
    </div>
    @endif
    <div class="overflow-y-scroll h-max-screen bg-white rounded-lg border border-gray-200 shadow-sm p-4">
        <x-splade-data :default="['tab'=>request()->has('tab')?request()->get('tab'):'all']">
            <h1 class="text-sm font-bold">{{__('Activity')}}</h1>
            <div class="flex justify-start gap-4 my-4">
                <h1>{{__('Show')}}</h1>
                <div>
                    <button class="bg-gray-200 px-2 px-1" @click.prevent="data.tab = 'all'" :class="{'text-primary-600': data.tab === 'all', 'text-gray-900': data.tab !== 'all',}">
                        {{__('All')}}
                    </button>
                </div>
                <div>
                    <button class="bg-gray-200 px-2 px-1" @click.prevent="data.tab = 'comments'" :class="{'text-primary-600': data.tab === 'comments', 'text-gray-900': data.tab !== 'comments',}">
                        {{__('Comments')}}
                    </button>
                </div>
                <div>
                    <button class="bg-gray-200 px-2 px-1" @click.prevent="data.tab = 'log'" :class="{'text-primary-600': data.tab === 'log', 'text-gray-900': data.tab !== 'log',}">
                        {{__('Log')}}
                    </button>
                </div>
            </div>

            <div class="flex flex-col gap-4 my-4" v-if="data.tab === 'all'">
                @php $logs = $model->logs()->orderBy('id', 'desc')->paginate(5); @endphp
                @foreach($logs as $log)
                    <div class="flex justify-start gap-4">
                        <div class="flex flex-col justify-center items-center">
                            <img src="{{$log->user?->profile_photo_url}}" class="w-8 h-8 rounded-full" alt="">
                        </div>
                        <div class="flex flex-col justify-center items-center">
                            <div class="flex flex-col justify-start">
                                <div>
                                    <span class="font-bold">{{ $log->user?->name }}</span>
                                </div>
                                <div>
                                    {!! $log->description !!} <span class="font-bold">{{__('Status')}}</span> {{$log->status}}
                                </div>
                                <div>
                                    <span class="font-bold">{{__('At')}}</span> {{$log->created_at->diffForHumans()}}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                {!! $logs->links('tomato-admin::components.pagination') !!}
            </div>
            <div class="flex flex-col gap-4 my-4" v-if="data.tab === 'log'">
                @php $logs = $model->logs()->where('action', '!=','comment')->orderBy('id', 'desc')->paginate(5); @endphp
                @foreach($logs as $log)
                    <div class="flex justify-start gap-4">
                        <div class="flex flex-col justify-center items-center">
                            <img src="{{$log->user?->profile_photo_url}}" class="w-8 h-8 rounded-full" alt="">
                        </div>
                        <div class="flex flex-col justify-center items-center">
                            <div class="flex flex-col justify-start">
                                <div>
                                    <span class="font-bold">{{ $log->user?->name }}</span>
                                </div>
                                <div>
                                    {!! $log->description !!} <span class="font-bold">{{__('Status')}}</span> {{$log->status}}
                                </div>
                                <div>
                                    <span class="font-bold">{{__('At')}}</span> {{$log->created_at->diffForHumans()}}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                {!! $logs->links('tomato-admin::components.pagination'); !!}
            </div>
            <div v-if="data.tab === 'comments'">
                @if(!$model->is_closed)
                <x-splade-form method="POST" :action="route('admin.issues.comment', $model->id)" class="flex flex-col gap-4">
                    <x-tomato-admin-rich name="comment" :placeholder="__('Add a comment')" />
                    <x-tomato-admin-submit  spinner :label="__('Comment')" />
                </x-splade-form>
                @endif
                @php $comments = $model->issuesMetas()->where('key','comments')->orderBy('id', 'desc')->paginate(5); @endphp
                <div class="flex flex-col gap-4 my-4">
                    @foreach($comments as $comment)
                        <div class="flex justify-start gap-4">
                            <div class="flex flex-col justify-center items-center">
                                <img src="{{$comment->user?->profile_photo_url}}" class="w-8 h-8 rounded-full" alt="">
                            </div>
                            <div class="flex flex-col justify-center items-center">
                               <div class="flex flex-col justify-start">
                                   <div>
                                       <span class="font-bold">{{ $comment->user?->name }}</span>
                                   </div>
                                   <div>
                                       {!! $comment->value !!}
                                   </div>
                                   <div>
                                       <span class="font-bold">{{__('At')}}</span> {{$comment->created_at->diffForHumans()}}
                                   </div>
                               </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                {!! $comments->links('tomato-admin::components.pagination'); !!}
            </div>
        </x-splade-data>
    </div>
</x-tomato-admin-layout>
