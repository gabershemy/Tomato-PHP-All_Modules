<x-tomato-admin-container label="{{trans('tomato-admin::global.crud.edit')}} {{__('Orders Item')}} #{{$model->id}}">
    <x-splade-form class="flex flex-col space-y-4" action="{{route('admin.orders-items.update', $model->id)}}" method="post" :default="$model">
        
          <x-splade-select :label="__('Order')" :placeholder="__('Order')" name="order_id" remote-url="/admin/orders/api" remote-root="model.data" option-label=name option-value="id" choices/>
          <x-splade-select :label="__('Account')" :placeholder="__('Account')" name="account_id" remote-url="/admin/accounts/api" remote-root="model.data" option-label=name option-value="id" choices/>
          <x-splade-select :label="__('Product')" :placeholder="__('Product')" name="product_id" remote-url="/admin/products/api" remote-root="model.data" option-label=name option-value="id" choices/>
          
          
          <x-splade-input :label="__('Item')" name="item" type="text"  :placeholder="__('Item')" />
          <x-splade-input :label="__('Price')" :placeholder="__('Price')" type='number' name="price" />
          <x-splade-input :label="__('Discount')" :placeholder="__('Discount')" type='number' name="discount" />
          <x-splade-input :label="__('Tax')" :placeholder="__('Tax')" type='number' name="tax" />
          <x-splade-input :label="__('Total')" :placeholder="__('Total')" type='number' name="total" />
          <x-splade-input :label="__('Returned')" :placeholder="__('Returned')" type='number' name="returned" />
          <x-splade-input :label="__('Qty')" :placeholder="__('Qty')" type='number' name="qty" />
          <x-splade-input :label="__('Returned qty')" :placeholder="__('Returned qty')" type='number' name="returned_qty" />
          <x-splade-checkbox :label="__('Is free')" name="is_free" />
          <x-splade-checkbox :label="__('Is returned')" name="is_returned" />
          

        <div class="flex justify-start gap-2 pt-3">
            <x-tomato-admin-submit  label="{{__('Save')}}" :spinner="true" />
            <x-tomato-admin-button danger :href="route('admin.orders-items.destroy', $model->id)"
                                   confirm="{{trans('tomato-admin::global.crud.delete-confirm')}}"
                                   confirm-text="{{trans('tomato-admin::global.crud.delete-confirm-text')}}"
                                   confirm-button="{{trans('tomato-admin::global.crud.delete-confirm-button')}}"
                                   cancel-button="{{trans('tomato-admin::global.crud.delete-confirm-cancel-button')}}"
                                   method="delete"  label="{{__('Delete')}}" />
            <x-tomato-admin-button secondary :href="route('admin.orders-items.index')" label="{{__('Cancel')}}"/>
        </div>
    </x-splade-form>
</x-tomato-admin-container>
