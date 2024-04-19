<x-splade-form submit-on-change method="GET" action="{{url()->current()}}" :default="['filterBy' => request()->get('filterBy') ?: 'week']">
    <x-splade-select choices class="w-full" name="filterBy" label="{{__('Filter Widgets By')}}" placeholder="{{__('Select Type')}}">
        <option value="today">{{__('Today')}}</option>
        <option value="week">{{__('Week')}}</option>
        <option value="month">{{__('Month')}}</option>
        <option value="year">{{__('Year')}}</option>
    </x-splade-select>
</x-splade-form>
