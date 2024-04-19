<x-tomato-admin-container label="{{__('Update Project Rates')}} #{{$model->id}}">
    <x-splade-form class="flex flex-col space-y-4" action="{{route('admin.projects.update', $model->id)}}" method="post" :default="$model">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <x-splade-select :label="__('Currency')" name="currency" type="text"  :placeholder="__('Currency')" :remote-url="route('admin.currencies.api')" remote-root="data" option-label="name" option-value="iso" />
            <x-splade-input :label="__('Total')" :placeholder="__('Total')" type='number' name="total" />
            <x-splade-input :label="__('Rate')" :placeholder="__('Rate')" type='number' name="rate" />
            <x-splade-select  choices :label="__('Rate per')" name="rate_per" type="text"  :placeholder="__('Rate per')">
                <option value="hour">{{__('Hour')}}</option>
                <option value="day">{{__('Day')}}</option>
                <option value="week">{{__('Week')}}</option>
                <option value="month">{{__('Month')}}</option>
                <option value="year">{{__('Year')}}</option>
            </x-splade-select>
        </div>

        <div class="flex justify-start gap-2 pt-3">
            <x-tomato-admin-submit  label="{{__('Save')}}" :spinner="true" />
            <x-tomato-admin-button secondary :href="route('admin.projects.index')" label="{{__('Cancel')}}"/>
        </div>
    </x-splade-form>
</x-tomato-admin-container>
