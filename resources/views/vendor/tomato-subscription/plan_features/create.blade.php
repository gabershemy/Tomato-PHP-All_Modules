@php use Illuminate\Support\Facades\Route; @endphp
@php
    $routes = Route::getRoutes()
@endphp

<x-tomato-admin-container label="{{trans('tomato-admin::global.crud.create')}} {{trans('tomato-subscription::global.features.single')}}">

    <x-splade-form class="flex flex-col space-y-4" action="{{route('admin.plan-features.store')}}" method="post">

        <x-tomato-translation name="name" type="text" label="{{trans('tomato-subscription::global.features.name')}}" placeholder="{{trans('tomato-subscription::global.features.name')}}" />
        <x-tomato-translation textarea name="description" type="text" label="{{trans('tomato-subscription::global.features.description')}}" placeholder="{{trans('tomato-subscription::global.features.description')}}"/>

        <x-splade-select  name="key" label="{{trans('tomato-subscription::global.features.key')}}" placeholder="{{trans('tomato-subscription::global.features.key')}}" choices>
              @foreach($routes as $route)
                  @if(isset($route->action['as'])))
                    <option value="{{$route->action['as']}}">{{$route->uri}}</option>
                  @endif
              @endforeach
          </x-splade-select>


        <x-splade-select  name="api_key" label="{{trans('tomato-subscription::global.features.api_key')}}"
                          placeholder="{{trans('tomato-subscription::global.features.api_key')}}" choices>
            @foreach($routes as $route)
                @if (strpos($route->uri, 'api/') !== false)
                    <option value="{{ str_replace('/', '-', $route->uri) }}">{{ $route->uri }}</option>
                @endif
            @endforeach
        </x-splade-select>

          <x-splade-input name="value" type="number"   label="{{trans('tomato-subscription::global.features.value')}}" placeholder="{{trans('tomato-subscription::global.features.value')}}" />

          <x-splade-checkbox name="is_active" label="{{trans('tomato-subscription::global.features.is_active')}}" />

        <div class="flex justify-start gap-2 pt-3">
            <x-tomato-admin-submit  label="{{__('Save')}}" :spinner="true" />
            <x-tomato-admin-button secondary :href="route('admin.plan-features.index')" label="{{__('Cancel')}}"/>
        </div>

    </x-splade-form>
</x-tomato-admin-container>
