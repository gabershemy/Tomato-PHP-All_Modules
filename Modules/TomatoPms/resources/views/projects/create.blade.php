<x-tomato-admin-container label="{{trans('tomato-admin::global.crud.create')}} {{__('Project')}}">
    <x-splade-form class="flex flex-col space-y-4" action="{{route('admin.projects.store')}}" method="post">

          <x-splade-input :label="__('Name')" name="name" type="text"  :placeholder="__('Name')" />
          <x-splade-input :label="__('Key')" name="key" type="text"  :placeholder="__('Key')" />

          <div class="flex justify-start gap-4">
              <div class="w-full">
                  <x-tomato-admin-icon :label="__('Icon')" name="icon" type="icon"  :placeholder="__('Icon')" />
              </div>
              <x-tomato-admin-color :label="__('Color')" :placeholder="__('Color')" type='number' name="color" />
          </div>

        <div class="flex justify-start gap-2 pt-3">
            <x-tomato-admin-submit  label="{{__('Save')}}" :spinner="true" />
            <x-tomato-admin-button secondary :href="route('admin.projects.index')" label="{{__('Cancel')}}"/>
        </div>
    </x-splade-form>
</x-tomato-admin-container>
