<x-tomato-admin-container class="font-main" label="{{trans('tomato-admin::global.crud.view')}} {{__('Plan')}}
#{{$model->id}}">
    <h1 class="text-2xl font-bold mb-4">{{trans('tomato-admin::global.crud.view')}} {{trans('tomato-subscription::global.plans.single')}} #{{$model->id}}</h1>

    <div class="flex flex-col space-y-4">

          <div class="flex justify-between">
              <div>
                  <h3 class="text-lg font-bold">
                      {{trans('tomato-subscription::global.plans.name')}}
                  </h3>
              </div>
              <div>
                  <h3 class="text-lg">
                      {{ $model->name}}
                  </h3>
              </div>
          </div>


          <div class="flex justify-between">
              <div>
                  <h3 class="text-lg font-bold">
                      {{trans('tomato-subscription::global.plans.description')}}
                  </h3>
              </div>
              <div>
                  <h3 class="text-lg">
                      {{ $model->description}}
                  </h3>
              </div>
          </div>

          <div class="flex justify-between">
              <div>
                  <h3 class="text-lg font-bold">
                      {{trans('tomato-subscription::global.plans.order')}}
                  </h3>
              </div>
              <div>
                  <h3 class="text-lg">
                      {{ $model->order}}
                  </h3>
              </div>
          </div>



          <div class="flex justify-between">
              <div>
                  <h3 class="text-lg font-bold">
                      {{trans('tomato-subscription::global.plans.invoice_interval')}}
                  </h3>
              </div>
              <div>
                  <h3 class="text-lg">
                      {{ $model->invoice_interval}}
                  </h3>
              </div>
          </div>

        <div class="flex justify-between">
            <div>
                <h3 class="text-lg font-bold">
                    {{trans('tomato-subscription::global.plans.invoice_period')}}
                </h3>
            </div>
            <div>
                <h3 class="text-lg">
                    {{ $model->invoice_period}}
                </h3>
            </div>
        </div>

        <div class="flex justify-between">
            <div>
                <h3 class="text-lg font-bold">
                    {{trans('tomato-subscription::global.plans.color')}}
                </h3>
            </div>
            <div>
                <h3 class="text-lg">
                    <x-heroicon-s-check-circle  class="h-8 w-8 ltr:mr-2 rtl:ml-2"
                                                style="color: {{ $model->color }}"/>
                </h3>
            </div>
        </div>

          <div class="flex justify-between">
              <div>
                  <h3 class="text-lg font-bold">
                      {{trans('tomato-subscription::global.plans.is_recurring')}}
                  </h3>
              </div>
              <div>
                  <h3 class="text-lg">
                      @if($model->is_recurring)
                          <x-heroicon-s-check-circle class="text-green-600 h-8 w-8 ltr:mr-2 rtl:ml-2"/>
                      @else
                          <x-heroicon-s-x-circle class="text-red-600 h-8 w-8 ltr:mr-2 rtl:ml-2"/>
                      @endif
                  </h3>
              </div>
          </div>

          <div class="flex justify-between">
              <div>
                  <h3 class="text-lg font-bold">
                      {{trans('tomato-subscription::global.plans.is_active')}}
                  </h3>
              </div>
              <div>
                  <h3 class="text-lg">
                      @if($model->is_active)
                          <x-heroicon-s-check-circle class="text-green-600 h-8 w-8 ltr:mr-2 rtl:ml-2"/>
                      @else
                          <x-heroicon-s-x-circle class="text-red-600 h-8 w-8 ltr:mr-2 rtl:ml-2"/>
                      @endif
                  </h3>
              </div>
          </div>

          <div class="flex justify-between">
              <div>
                  <h3 class="text-lg font-bold">
                      {{trans('tomato-subscription::global.plans.is_free')}}
                  </h3>
              </div>
              <div>
                  <h3 class="text-lg">
                      @if($model->is_free)
                          <x-heroicon-s-check-circle class="text-green-600 h-8 w-8 ltr:mr-2 rtl:ml-2"/>
                      @else
                          <x-heroicon-s-x-circle class="text-red-600 h-8 w-8 ltr:mr-2 rtl:ml-2"/>
                      @endif
                  </h3>
              </div>
          </div>

          <div class="flex justify-between">
              <div>
                  <h3 class="text-lg font-bold">
                      {{trans('tomato-subscription::global.plans.is_default')}}
                  </h3>
              </div>
              <div>
                  <h3 class="text-lg">
                      @if($model->is_default)
                          <x-heroicon-s-check-circle class="text-green-600 h-8 w-8 ltr:mr-2 rtl:ml-2"/>
                      @else
                          <x-heroicon-s-x-circle class="text-red-600 h-8 w-8 ltr:mr-2 rtl:ml-2"/>
                      @endif
                  </h3>
              </div>
          </div>

    </div>
    </x-tomato-admin-container>
