<x-tomato-admin-container label="{{trans('tomato-admin::global.crud.create')}} {{ trans('tomato-backup::global.title') }}">
    <x-splade-form class="flex flex-col space-y-4" action="{{route('admin.backup.store')}}" method="post">

        <x-splade-radios name="type" :label="trans('tomato-backup::global.type')"  :options="[
            'db' => trans('tomato-backup::global.db'),
            'files' => trans('tomato-backup::global.files'),
            'database_files' => trans('tomato-backup::global.database_files'),
        ]"/>

        <div class="flex justify-start gap-2 pt-3">
            <x-tomato-admin-submit  label="{{__('Save')}}" :spinner="true" />
            <x-tomato-admin-button secondary :href="route('admin.backup.index')" label="{{__('Cancel')}}"/>
        </div>
    </x-splade-form>
</x-tomato-admin-container>
