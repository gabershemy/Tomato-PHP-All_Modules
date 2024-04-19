
<x-tomato-admin-container container label="{{ __('Create Plan') }}">
    <x-slot name="header">
        {{trans('tomato-admin::global.crud.create')}} {{trans('tomato-subscription::global.plans.single')}}
    </x-slot>
    <x-splade-form
        :unguarded="['name', 'description']"
        :default="[
            'invoice_interval' => 'month',
            'invoice_period' => 1,
            'order' => \Modules\Plan\Entities\Plan::count() + 1,
        ]" class="my-4 flex flex-col space-y-4" action="{{route('admin.plans.store')}}" method="post" :default="['features'=>[]]">

        <x-tomato-translation name="name" type="text" label="{{trans('tomato-subscription::global.plans.name')}}" placeholder="{{trans('tomato-subscription::global.plans.name')}}" />
        <x-tomato-translation textarea name="description" type="text" label="{{trans('tomato-subscription::global.plans.description')}}" placeholder="{{trans('tomato-subscription::global.plans.description')}}"/>
        <x-splade-select name="invoice_interval" label="{{trans('tomato-subscription::global.plans.invoice_interval')}}"  placeholder="{{trans('tomato-subscription::global.plans.invoice_interval')}}" choices>
            <option value="day">{{trans('tomato-subscription::global.plans.invoice_intervals.day')}}</option>
            <option value="week">{{trans('tomato-subscription::global.plans.invoice_intervals.week')}}</option>
            <option value="month">{{trans('tomato-subscription::global.plans.invoice_intervals.month')}}</option>
            <option value="year">{{trans('tomato-subscription::global.plans.invoice_intervals.year')}}</option>
        </x-splade-select>
        <div class="flex justify-between space-x-2">
            <x-splade-input class="w-full" name="invoice_period" type="number"  label="{{trans('tomato-subscription::global.plans.invoice_period')}}"  placeholder="{{trans('tomato-subscription::global.plans.invoice_period')}}" />
            <x-splade-input class="w-full" name="price" type="number"  label="{{trans('tomato-subscription::global.plans.price')}}"  placeholder="{{trans('tomato-subscription::global.plans.price')}}" />
        </div>
        <x-splade-input type="text" name="order" label="{{trans('tomato-subscription::global.plans.order')}}"  placeholder="{{trans('tomato-subscription::global.plans.order')}}" />

        <x-tomato-admin-color name="color" label="{{trans('tomato-subscription::global.plans.color')}}" />

        <div class="grid grid-cols-2 gap-2">
            <x-splade-checkbox name="is_recurring" label="{{trans('tomato-subscription::global.plans.is_recurring')}}"/>
            <x-splade-checkbox name="is_active" label="{{trans('tomato-subscription::global.plans.is_active')}}"/>
            <x-splade-checkbox name="is_free" label="{{trans('tomato-subscription::global.plans.is_free')}}"/>
            <x-splade-checkbox name="is_default" label="{{trans('tomato-subscription::global.plans.is_default')}}" />
        </div>
        <x-tomato-admin-repeater :options="['feature', 'value']" type="repeater" id="features" name="features" label="{{trans('tomato-subscription::global.plans.features')}}">
            <div class="flex flex-col justify-center space-y-4">
                <x-splade-select option-label="name.{{app()->getLocale()}}" option-value="id" remote-root="model.data" remote-url="{{route('admin.plan-features.api')}}" v-model="repeater.main[key].feature"  label="{{trans('tomato-subscription::global.plans.feature')}}" placeholder="{{trans('tomato-subscription::global.plans.feature')}}"  />
                <x-splade-input v-model="repeater.main[key].value" name="value" type="text"  label="{{trans('tomato-subscription::global.plans.value')}}" placeholder="{{trans('tomato-subscription::global.plans.value')}}" />
            </div>
        </x-tomato-admin-repeater>

        <x-splade-submit label="{{trans('tomato-admin::global.crud.create-new')}} {{trans('tomato-subscription::global.plans.single')}}" :spinner="true" />
    </x-splade-form>
</x-tomato-admin-container>
