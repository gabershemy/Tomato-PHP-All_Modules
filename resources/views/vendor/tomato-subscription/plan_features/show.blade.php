<x-splade-modal class="font-main">
    <h1 class="text-2xl font-bold mb-4">{{trans('tomato-admin::global.crud.view')}} {{trans('tomato-subscription::global.features.single')}} #{{$model->id}}</h1>

    <div class="flex flex-col space-y-4">

          <div class="flex justify-between">
              <div>
                  <h3 class="text-lg font-bold">
                      {{trans('tomato-subscription::global.features.name')}}
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
                      {{trans('tomato-subscription::global.features.key')}}
                  </h3>
              </div>
              <div>
                  <h3 class="text-lg">
                      {{ $model->key}}
                  </h3>
              </div>
          </div>

          <div class="flex justify-between">
              <div>
                  <h3 class="text-lg font-bold">
                      {{trans('tomato-subscription::global.features.value')}}
                  </h3>
              </div>
              <div>
                  <h3 class="text-lg">
                      {{ $model->value}}
                  </h3>
              </div>
          </div>

          <div class="flex justify-between">
              <div>
                  <h3 class="text-lg font-bold">
                      {{trans('tomato-subscription::global.features.description')}}
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
                      {{trans('tomato-subscription::global.features.is_active')}}
                  </h3>
              </div>
              <div>
                  <h3 class="text-lg">
                      <div class="text-center">
                          @if($model->is_active)
                              <x-heroicon-s-check-circle class="text-green-600 h-8 w-8 ltr:mr-2 rtl:ml-2"/>
                          @else
                              <x-heroicon-s-x-circle class="text-red-600 h-8 w-8 ltr:mr-2 rtl:ml-2"/>
                          @endif
                      </div>
                  </h3>
              </div>
          </div>

    </div>
</x-splade-modal>
