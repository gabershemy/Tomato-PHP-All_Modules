@php
    $types = \Modules\TomatoCategory\App\Models\Type::where('for', 'issues')->where('type', 'types')->get();
    $statues = \Modules\TomatoCategory\App\Models\Type::where('for', 'issues')->where('type', 'status')->get();
    if(request()->has('parent_id')){
        $parent = \Modules\TomatoPms\App\Models\Issue::find(request()->get('parent_id'));
    }
@endphp

<x-tomato-admin-container label="{{trans('tomato-admin::global.crud.create')}} {{__('Issue')}}">
    {{-- {{ dd(isset($types[0])) }} --}}
    <x-splade-form :default="[
        'parent_id'=> isset($parent)?$parent->id:null,
        'project_id'=> isset($parent)?$parent->project_id:null,
        'sprint_id'=> isset($parent)?$parent->sprint_id:null,
        'type'=> isset($types[0])?$types[0]->key:null,
        'status'=> isset($statues[0])?$statues[0]->key:null,
        'priority' => 'medium'
    ]" class="flex flex-col space-y-4" action="{{route('admin.issues.store')}}" method="post">
        <x-splade-input :label="__('Summary')" name="summary" type="text"  :placeholder="__('Summary')" />
        <x-tomato-admin-rich :label="__('Description')" name="description" :placeholder="__('Description')" autosize />

          @if(!isset($parent))
              <div class="grid grid-cols-2 gap-4">
                  <x-splade-select :label="__('Project')" :placeholder="__('Project')" name="project_id" remote-url="/admin/projects/api" remote-root="data" option-label="name" option-value="id" choices/>
                  <x-splade-select v-bind:disabled="!form.project_id" :label="__('Sprint')" :placeholder="__('Sprint')" name="sprint_id" remote-url="`/admin/sprints/api?project_id=${form.project_id}`" remote-root="data" option-label="name" option-value="id" choices/>
              </div>
         @endif
          <div class="grid grid-cols-2 gap-4">
              <x-splade-select choices="{allowHTML:true}" :label="__('Type')" name="type" type="text"  :placeholder="__('Type')" >
                @foreach($types as $type)
                      <option value="{{$type->key}}">
                          <div class="flex justify-start gap-2">
                              <div class="flex flex-col justify-center items-center w-6 h-6  rounded-lg text-white" style="background-color: {{$type->color}}">
                                  <i class="{{$type->icon}} text-sm"></i>
                              </div>
                              <div class="flex flex-col justify-center items-center font-bold">
                                  {{$type->name}}
                              </div>
                          </div>
                      </option>
                  @endforeach
              </x-splade-select>
              <x-splade-select choices="{allowHTML:true}" :label="__('Status')" name="status" type="text"  :placeholder="__('Status')">
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
          </div>
          <x-splade-select choices="{allowHTML:true}" :label="__('Priority')" name="priority" type="text"  :placeholder="__('Priority')">
              <option value="highest">
                  <div class="flex justify-start gap-2">
                      <div class="flex flex-col justify-center items-center text-danger-500">
                          <i class="bx bx-chevrons-up text-lg"></i>
                      </div>
                      <div class="flex flex-col justify-center items-center font-bold">
                          {{__('Highest')}}
                      </div>
                  </div>
              </option>
              <option value="high">
                  <div class="flex justify-start gap-2">
                      <div class="flex flex-col justify-center items-center text-danger-500">
                          <i class="bx bx-chevron-up text-lg"></i>
                      </div>
                      <div class="flex flex-col justify-center items-center font-bold">
                          {{__('High')}}
                      </div>
                  </div>
              </option>
              <option value="medium">
                  <div class="flex justify-start gap-2">
                      <div class="flex flex-col justify-center items-center text-warning-500">
                          <i class="bx bx-equalizer text-lg"></i>
                      </div>
                      <div class="flex flex-col justify-center items-center font-bold">
                          {{__('Medium')}}
                      </div>
                  </div>
              </option>
              <option value="low">
                  <div class="flex justify-start gap-2">
                      <div class="flex flex-col justify-center items-center text-primary-500">
                          <i class="bx bx-chevrons-down text-lg"></i>
                      </div>
                      <div class="flex flex-col justify-center items-center font-bold">
                          {{__('Low')}}
                      </div>
                  </div>
              </option>
              <option value="lowest">
                  <div class="flex justify-start gap-2">
                      <div class="flex flex-col justify-center items-center text-primary-500">
                          <i class="bx bx-chevron-down text-lg"></i>
                      </div>
                      <div class="flex flex-col justify-center items-center font-bold">
                          {{__('Lowest')}}
                      </div>
                  </div>
              </option>

          </x-splade-select>
          <x-splade-input :label="__('Points')" :placeholder="__('Points')" type='number' name="points" />
            <div class="flex justify-start gap-4">
                <div class="w-full">
                    <x-tomato-admin-icon :label="__('Icon')" name="icon" type="icon"  :placeholder="__('Icon')" />
                </div>
                <x-tomato-admin-color :label="__('Color')" :placeholder="__('Color')" type='number' name="color" />
            </div>

        <div class="flex justify-start gap-2 pt-3">
            <x-tomato-admin-submit  label="{{__('Save')}}" :spinner="true" />
            <x-tomato-admin-button secondary :href="route('admin.issues.index')" label="{{__('Cancel')}}"/>
        </div>
    </x-splade-form>
</x-tomato-admin-container>
