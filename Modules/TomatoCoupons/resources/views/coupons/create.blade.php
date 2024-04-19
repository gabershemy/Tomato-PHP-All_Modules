<x-tomato-admin-container label="{{trans('tomato-admin::global.crud.create')}} {{__('Coupon')}}">
    <x-splade-form class="flex flex-col space-y-4" action="{{route('admin.coupons.store')}}" method="post" :default="['type' => 'discount_coupon','code' => explode('-', \Illuminate\Support\Str::uuid())[0], 'apply_to' => (object)[], 'is_activated'=>true, 'except'=>(object)[]]">

          <x-splade-input :label="__('Code')" name="code" type="text"  :placeholder="__('Code')" />
        <div class="flex justify-between gap-4">
            <x-splade-input class=" w-full" :label="__('Amount')" :placeholder="__('Amount')" type='number' name="amount" />
            <x-splade-select class=" w-full" choices :label="__('Type')" :placeholder="__('Type')" name="type" >
                <option value="discount_coupon">{{__('Amount')}}</option>
                <option value="percentage_coupon">{{__('Percentage')}}</option>
            </x-splade-select>
        </div>
        <x-splade-checkbox :label="__('Is limited')" name="is_limited" />
          <div v-if="form.is_limited" class="flex flex-col space-y-4">
              @php
                $categories = \Modules\TomatoCategory\App\Models\Category::where('for', 'product-categories')->get();
                $products = \Modules\TomatoProducts\App\Models\Product::where('is_activated', true)->get();
              @endphp

              <x-splade-select label="{{__('Apply On Selected Category')}}" choices multiple name="apply_to[categories]" >
                  @foreach($categories as $category)
                      <option value="{{$category->id}}">{{$category->name}}</option>
                  @endforeach
              </x-splade-select>
              <x-splade-select label="{{__('Apply On Selected Products')}}" choices multiple name="apply_to[products]">
                  @foreach($products as $product)
                      <option value="{{$product->id}}">{{$product->name}}</option>
                  @endforeach
              </x-splade-select>

              <x-splade-select label="{{__('Apply For All Categories Except')}}" choices multiple name="except[categories]" >
                  @foreach($categories as $category)
                      <option value="{{$category->id}}">{{$category->name}}</option>
                  @endforeach
              </x-splade-select>
              <x-splade-select label="{{__('Apply For All Products Except')}}" choices multiple name="except[products]">
                  @foreach($products as $product)
                      <option value="{{$product->id}}">{{$product->name}}</option>
                  @endforeach
              </x-splade-select>



              <x-splade-input date time :label="__('End At')" :placeholder="__('End At')"  name="end_at" />
              <x-splade-input :label="__('Use limit')" :placeholder="__('Use limit')" type='number' name="use_limit" />
              <x-splade-input :label="__('Use limit by user')" :placeholder="__('Use limit by user')" type='number' name="use_limit_by_user" />
              <x-splade-input :label="__('Order total limit')" :placeholder="__('Order total limit')" type='number' name="order_total_limit" />
          </div>

          <x-splade-checkbox :label="__('Is activated')" name="is_activated" />
          <x-splade-checkbox :label="__('Is marketing')" name="is_marketing" />
            <div v-if="form.is_marketing" class="flex flex-col space-y-4">
                <x-splade-input :label="__('Marketer name')" name="marketer_name" type="text"  :placeholder="__('Marketer name')" />
                <x-splade-input :label="__('Marketer type')" name="marketer_type" type="text"  :placeholder="__('Marketer type')" />
                <x-splade-input :label="__('Marketer amount')" :placeholder="__('Marketer amount')" type='number' name="marketer_amount" />
                <x-splade-input :label="__('Marketer amount max')" :placeholder="__('Marketer amount max')" type='number' name="marketer_amount_max" />
                <x-splade-checkbox :label="__('Marketer show amount max')" name="marketer_show_amount_max" />
                <x-splade-checkbox :label="__('Marketer hide total sales')" name="marketer_hide_total_sales" />
            </div>



        <div class="flex justify-start gap-2 pt-3">
            <x-tomato-admin-submit  label="{{__('Save')}}" :spinner="true" />
            <x-tomato-admin-button secondary :href="route('admin.coupons.index')" label="{{__('Cancel')}}"/>
        </div>
    </x-splade-form>
</x-tomato-admin-container>
