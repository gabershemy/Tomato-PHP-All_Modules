<div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-3">
    @foreach($table->resource as $itemKey => $item)
        @php $itemPrimaryKey = $table->findPrimaryKey($item) @endphp
           <x-splade-form method="POST" preserve-scroll  action="{{route('admin.products.update', $item->id)}}" :default="array_merge($item->toArray(), ['stock' => $item->meta('stock')])">
                <div class="rounded-lg bg-white dark:bg-gray-900 dark:text-gray-200 dark:border-gray-700 border border-gray-200 shadow-sm">
                    <div class="flex justify-between gap-4  p-4 ">
                        <div class="flex justify-start gap-2">
                            @if($hasBulkActions = $table->hasBulkActions())
                                @php $itemPrimaryKey = $table->findPrimaryKey($item) @endphp
                                <div class="flex flex-col items-center justify-center">
                                    <input
                                        @change="(e) => table.setSelectedItem(@js($itemPrimaryKey), e.target.checked)"
                                        :checked="table.itemIsSelected(@js($itemPrimaryKey))"
                                        :disabled="table.allItemsFromAllPagesAreSelected"
                                        class="rounded dark:bg-gray-500 border-gray-300 dark:border-gray-600 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 disabled:opacity-50"
                                        name="table-row-bulk-action"
                                        type="checkbox"
                                        value="{{ $itemPrimaryKey }}"
                                    />
                                </div>
                                <div class="flex flex-col items-center justify-center">
                                    <div>
                                        @if($item->type === 'product')
                                            {{ __('Product') }}
                                        @else
                                            {{ __('Digital') }}
                                        @endif
                                    </div>
                                </div>

                            @endif
                        </div>
                        @if(auth('web')->user()->can('admin.products.update'))
                            <div class="flex justifiy-end gap-2">
                                <div>
                                    <x-tomato-admin-tooltip text="{{$item->is_trend ? __('Product Trending') : __('Product Not Trend')}}">
                                        <button @click.prevent="form.is_trend = !@js($item->is_trend); form.submit()">
                                            @if($item->is_trend)
                                                <div class="bg-danger-500 hover:bg-danger-400 text-white rounded-full flex flex-col items-center justify-center p-2">
                                                    <i class="bx bx-pin"></i>
                                                </div>
                                            @else
                                                <div class="bg-gray-200 hover:bg-gray-300 dark:bg-gray-600 dark:text-gray-400 text-gray-300 rounded-full flex flex-col items-center justify-center p-2">
                                                    <i class="bx bx-pin"></i>
                                                </div>
                                            @endif
                                        </button>
                                    </x-tomato-admin-tooltip>
                                </div>
                                <div>
                                    <x-tomato-admin-dropdown icon="bx bx-cog" class="bg-primary-600 hover:bg-primary-500 text-white rounded-full flex flex-col items-center justify-center p-2">
                                        <x-tomato-admin-dropdown-item
                                            type="link"
                                            :href="route('admin.products.toggle', $item->id) . '?action=is_activated'"
                                            :label="$item->is_activated ? __('Hide Product') : __('Show Product')"
                                            :success="!$item->is_activated"
                                            :danger="$item->is_activated"
                                            :icon="$item->is_activated ? 'bx bx-hide' : 'bx bx-show'"
                                        />
                                        <x-tomato-admin-dropdown-item
                                            black
                                            modal
                                            type="link"
                                            :href="route('admin.products.edit', $item->id)"
                                            :label="__('Edit Product')"
                                            icon="bx bx-edit"
                                        />
                                        <x-tomato-admin-dropdown-item
                                            :label="__('Copy Product Link')"
                                            type="copy"
                                            black
                                            text="{{url('shop/product/' . $item->slug)}}"
                                            icon="bx bx-link"
                                        />
                                        <x-tomato-admin-dropdown-item
                                            confirm
                                            black
                                            type="link"
                                            :href="route('admin.products.clone', $item->id)"
                                            :label="__('Clone Product')"
                                            icon="bx bx-copy"
                                        />
                                        <x-tomato-admin-dropdown-item
                                            black
                                            modal
                                            type="link"
                                            :href="route('admin.products.actions.seo', $item->id)"
                                            :label="__('Product SEO')"
                                            icon="bx bx-search"
                                        />
                                        <x-tomato-admin-dropdown-item
                                            black
                                            modal
                                            type="link"
                                            :href="route('admin.products.actions.shipping', $item->id)"
                                            :label="__('Product Shipping')"
                                            icon="bx bxs-truck"
                                        />
                                        <x-tomato-admin-dropdown-item
                                            black
                                            modal
                                            type="link"
                                            :href="route('admin.products.actions.prices', $item->id)"
                                            :label="__('Product Prices')"
                                            icon="bx bx-money"
                                        />
                                        <x-tomato-admin-dropdown-item
                                            black
                                            type="link"
                                            :href="route('admin.products.show', $item->id)"
                                            :label="__('Product Reviews')"
                                            icon="bx bx-star"
                                        />
                                        @if(class_exists(\Modules\TomatoInventory\App\Facades\TomatoInventory::class))
                                            <li class="whitespace-nowrap py-2 flex items-center justify-between hover:bg-gray-100 dark:hover:bg-gray-900 px-4">
                                                <a target="_blank" href="{{route('admin.inventories.print.products')}}?product_id={{$item->id}}"
                                                   class="relative flex justify-center gap-2 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 text-gray-600 dark:text-gray-200 hover:text-black text-gray-600 dark:text-gray-200 hover:text-primary-500">
                                                    <div class="flex flex-col items-center justify-center">
                                                        <i class="bx bxs-chart text-sm"></i>
                                                    </div>
                                                    <div class="text-sm"> {{__('Print Product Inventory Report')}} </div>
                                                </a>
                                            </li>
                                        @endif
                                        @if(class_exists(\Modules\TomatoOrders\App\Facades\TomatoOrdering::class))
                                            <li class="whitespace-nowrap py-2 flex items-center justify-between hover:bg-gray-100 dark:hover:bg-gray-900 px-4">
                                                <a target="_blank" href="{{route('admin.products.print.orders')}}?product_id={{$item->id}}"
                                                   class="relative flex justify-center gap-2 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 text-gray-600 dark:text-gray-200 hover:text-black text-gray-600 dark:text-gray-200 hover:text-primary-500">
                                                    <div class="flex flex-col items-center justify-center">
                                                        <i class="bx bxs-rocket text-sm"></i>
                                                    </div>
                                                    <div class="text-sm"> {{__('Print Product Orders Report')}} </div>
                                                </a>
                                            </li>
                                        @endif
                                        <x-tomato-admin-dropdown-item
                                            :href="route('admin.products.destroy', $item->id)"
                                            confirm="{{trans('tomato-admin::global.crud.delete-confirm')}}"
                                            confirm-text="{{trans('tomato-admin::global.crud.delete-confirm-text')}}"
                                            confirm-button="{{trans('tomato-admin::global.crud.delete-confirm-button')}}"
                                            cancel-button="{{trans('tomato-admin::global.crud.delete-confirm-cancel-button')}}"
                                            method="delete"
                                            type="link"
                                            danger
                                            :label="__('Delete Product')"
                                            icon="bx bx-trash"
                                        />
                                    </x-tomato-admin-dropdown>


                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="grid grid-cols-8 gap-4 px-4">
                        <div class="col-span-2">
                            <div class="bg-cover bg-center w-full h-full rounded-md" style="background-image: url('{{$item->getMedia('featured_image')->first()?->getUrl() ?: url('placeholder.webp')}}')" >
                                <x-tomato-admin-tooltip text="{{__('Update Product Media')}}" >
                                    @if(auth('web')->user()->can('admin.products.actions.media'))
                                        <x-splade-link modal :href="route('admin.products.actions.media', $item->id)" class="relative top-2 left-2 w-6 h-6 text-white text-center flex flex-col items-center justify-center rounded-full bg-success-600">
                                            <i class="bx bx-plus"></i>
                                        </x-splade-link>
                                    @endif
                                </x-tomato-admin-tooltip>
                            </div>

                        </div>
                        <div class="col-span-6 flex flex-col gap-2">
                            <x-tomato-admin-tooltip text="{{__('Product Name')}}">
                                <x-splade-input
                                    :disabled="!auth('web')->user()->can('admin.products.update')"
                                    name="name.{{app()->getLocale()}}"
                                    type="text"
                                    :placeholder="__('Name')"
                                >
                                    <x-slot:prepend>

                                        @if($item->type === 'digital')
                                            <i class="bx bx-game text-gray-400"></i>
                                        @else
                                            <i class="bx bx-package text-gray-400"></i>
                                        @endif
                                    </x-slot:prepend>
                                </x-splade-input>
                            </x-tomato-admin-tooltip>
                            <x-tomato-admin-tooltip text="{{__('Price')}}">

                            <x-splade-input
                                :disabled="!auth('web')->user()->can('admin.products.update')"
                                name="price"
                                type="number"
                                :placeholder="__('Price')"
                            >
                                <x-slot:prepend>
                                        <i class="bx bx-money text-gray-400"></i>
                                </x-slot:prepend>

                                <x-slot:append>
                                    <small>{{setting('local_currency')}}</small>
                                </x-slot:append>
                            </x-splade-input>
                            </x-tomato-admin-tooltip>

                        </div>
                    </div>
                    <div class="flex flex-col gap-4 px-4 my-4">
                        <div class="grid grid-cols-8 gap-4">
                            <x-tomato-admin-tooltip :class="!auth('web')->user()->can('admin.products.update') ? 'col-span-8' : 'col-span-4'"  text="{{__('Product In Stock QTY')}}">
                            <x-splade-input
                                name="stock"
                                :disabled="$item->has_unlimited_stock || !auth('web')->user()->can('admin.products.update')"
                                :placeholder="__('QTY on Stock')"
                            >
                                <x-slot:prepend>
                                    <i class="bx bx-box text-gray-400"></i>
                                </x-slot:prepend>
                            </x-splade-input>
                            </x-tomato-admin-tooltip>
                            @if(auth('web')->user()->can('admin.products.actions.alerts'))
                                <x-tomato-admin-tooltip text="{{__('Update Product Alerts')}}">
                                    <x-splade-link modal :href="route('admin.products.actions.alerts', $item->id)" class="flex flex-col items-center justify-center rounded-lg  border border-gray-300 dark:border-gray-700 shadow-sm dark:text-white py-2 px-4 h-full w-full text-center   text-sm">
                                            <i class="bx bx-bell-plus"></i>
                                    </x-splade-link>
                                </x-tomato-admin-tooltip>
                                <x-tomato-admin-tooltip text="{{__('Product Has Unlimited Stock')}}">
                                    <button @click.prevent="form.has_unlimited_stock = !@js($item->has_unlimited_stock); form.submit()" :class="{'bg-primary-600 text-white border-primary-500' : @js($item->has_unlimited_stock), 'border-gray-300':!@js($item->has_unlimited_stock)}" class="flex flex-col items-center justify-center rounded-lg  border  dark:border-gray-700 shadow-sm dark:text-white py-2 px-4 h-full w-full text-center   text-sm">
                                        <i class="bx bx-infinite"></i>
                                    </button>
                                </x-tomato-admin-tooltip>
                            @endif
                            @if(auth('web')->user()->can('admin.products.actions.options'))
                                <div class="col-span-2">
                                    <x-splade-link  modal :href="route('admin.products.actions.options', $item->id)" class="flex flex-col items-center justify-center rounded-lg  border border-gray-300 dark:border-gray-700 shadow-sm dark:text-white py-2 px-4 h-full w-full text-center   text-sm">
                                        {{__('Options')}}
                                    </x-splade-link>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="flex flex-col gap-4 px-4 my-4">
                        <x-tomato-admin-tooltip :class="!auth('web')->user()->can('admin.products.update') ? 'col-span-8' : 'col-span-5'" text="{{__('Product Main Category')}}">
                            <x-splade-select
                                :disabled="!auth('web')->user()->can('admin.products.update')"
                                name="category_id"
                                :options="\Modules\TomatoCategory\App\Models\Category::where('for', 'product-categories')->get()"
                                option-label="name"
                                option-value="id"
                                choices
                                :placeholder="__('Categories')"
                            />
                        </x-tomato-admin-tooltip>
                    </div>
                    @if(auth('web')->user()->can('admin.products.update'))
                        <button class="py-3 px-4 border-t border-gray-200 dark:border-gray-700 font-bold w-full text-center bg-primary-500 dark:bg-gray-700 text-white text-sm rounded-b-lg" type="submit">
                            {{__('Save')}}
                        </button>
                    @endif
                </div>
           </x-splade-form>
    @endforeach
</div>
@if($table->resource->isEmpty())
    <div class="bg-white rounded-lg mt-4">
        <div class="whitespace-nowrap">
            @if(isset($emptyState) && !!$emptyState)
                {{ $emptyState }}
            @else
                <div class="py-12">
                    <div class="flex flex-col justify-center items-center my-2 text-danger-500">
                        <x-heroicon-s-x-circle class="w-16 h-16" />
                    </div>
                    <p class="text-gray-700 dark:text-gray-200 px-6  font-medium text-sm text-center">
                        {{ __('There are no items to show.') }}
                    </p>
                </div>
            @endif
        </div>
    </div>
@endif
