<x-tomato-admin-container label="{{trans('tomato-admin::global.crud.edit')}} {{__('Order')}} #{{$model->uuid}} | [{{str($model->status)->upper()}}]">
    <x-splade-form class="flex flex-col space-y-4" action="{{route('admin.orders.update', $model->id)}}" method="post" :default="$model">

        @php $company = \Modules\TomatoBranches\App\Models\Branch::find(setting('ordering_direct_branch'))?->company @endphp
        <div class="flex justify-between xl:gap-60 lg:gap-48 md:gap-16 sm:gap-8 sm:flex-row flex-col gap-4">
            <div class="w-full">
                <div class="my-4">
                    @if(setting('site_logo'))
                        <img src="{{setting('site_logo')}}" alt="{{setting('site_name')}}" class="h-12">
                    @else
                        <h2 class="text-xl md:text-3xl">{{setting('site_name')}}</h2>
                    @endif
                </div>
                <div class="flex flex-col">
                    <div>
                        {{__('From:')}}
                    </div>
                    <div class="text-lg font-bold mt-2">
                        {{$company->name}}
                    </div>
                    <div class="text-sm">
                        {{$company->ceo}}
                    </div>
                    <div class="text-sm">
                        {{$company->address}}
                    </div>
                    <div class="text-sm">
                        {{$company->zip}} {{$company->city}}
                    </div>
                    <div class="text-sm">
                        {{$company->country?->name}}
                    </div>
                </div>
                <div class="mt-4">
                    <div>
                        {{__('To:')}}
                    </div>
                    <div class="mt-4">
                        <div class="flex justifiy-start gap-4">
                            <div class="w-full">
                                <x-tomato-search
                                    :remote-url="route('admin.orders.user')"
                                    remote-root="data"
                                    name="account_id"
                                    placeholder="{{__('Select Account')}}"
                                    label="{{__('Account')}}"
                                />
                            </div>
                            <div>
                                <x-tomato-admin-button modal :href="route('admin.orders.account')" title="{{__('Create Account')}}">
                                    <i class="bx bx-plus"></i>
                                </x-tomato-admin-button>
                            </div>
                        </div>
                        <div v-if="form.errors.account_id"
                             class="text-danger-500 mt-2 text-xs font-chakra flex gap-2 mb-[6px]">
                            <p v-text="form.errors.account_id"> </p>
                        </div>
                        <div v-if="form.account_id">
                            <div class="text-lg font-bold mt-2">
                                @{{form.account_id.name}}
                            </div>
                            <div class="text-sm">
                                @{{form.account_id.phone}}
                            </div>
                            <div v-if="form.account_id.locations.length > 0">                                <div class="text-sm">
                                    @{{form.account_id.locations[0].home_number}} @{{form.account_id.locations[0].street}} | {{__('Floor')}} : @{{form.account_id.locations[0].floor_number}} | {{__('Flat')}} : @{{form.account_id.locations[0].flat_number}}
                                </div>
                                <div class="text-sm">
                                    @{{form.account_id.locations[0].city.name}}, @{{form.account_id.locations[0].area.name}} @{{form.account_id.locations[0].zip ? ' | ' +form.account_id.locations[0].zip : null }}
                                </div>
                                <div class="text-sm">
                                    @{{form.account_id.locations[0].country.name}}
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="flex flex-col gap-4 w-full">
                <div class="flex justify-between gap-4">
                    <div class="flex flex-col justify-center items-center">
                        {{__('Invoice')}}
                    </div>
                    <div>
                        <x-splade-input disabled name="uuid" placeholder="{{__('Due date')}}" />
                    </div>
                </div>
                <div class="flex justify-between gap-4">
                    <div class="flex flex-col justify-center items-center">
                        {{__('Issue date')}}
                    </div>
                    <div>
                        <x-splade-input disabled date time name="issue_date" placeholder="{{__('Due date')}}" />
                    </div>
                </div>
                <div class="flex justify-between gap-4">
                    <div class="flex flex-col justify-center items-center">
                        {{__('Due date')}}
                    </div>
                    <div>
                        <x-splade-input date time name="due_date" placeholder="{{__('Due date')}}" />
                    </div>
                </div>
            </div>
        </div>
        <div>
            <x-tomato-items :options="['item'=>'', 'price'=>0, 'discount'=>0, 'tax'=>0, 'qty'=>1,'total'=>0, 'options' =>(object)[]]" name="items">
                <div class="grid grid-cols-12 gap-4 border-b py-4 my-4">
                    <div class="col-span-4">
                        {{__('Item')}}
                    </div>
                    <div>
                        {{__('Price')}}
                    </div>
                    <div>
                        {{__('Discount')}}
                    </div>
                    <div class="col-span-2">
                        {{__('Tax')}}
                    </div>
                    <div>
                        {{__('QTY')}}
                    </div>
                    <div>
                        {{__('Total')}}
                    </div>
                </div>
                <div class="flex flex-col gap-4">
                    <div class="grid grid-cols-12 gap-4" v-for="(item, key) in items.main">
                        <div class="col-span-4 flex justify-between gap-4">
                            <x-tomato-search
                                @change="
                                            items.main[key].price = items.main[key].item?.price;
                                            items.main[key].discount = items.main[key].item?.discount;
                                            items.main[key].tax = items.main[key].item?.vat;
                                            items.updateTotal(key)
                                        "
                                :remote-url="route('admin.orders.product')"
                                option-label="name?.{{app()->getLocale()}}"
                                remote-root="data"
                                v-model="items.main[key].item"
                                placeholder="{{__('Select Item')}}"
                                label="{{__('Product')}}"
                            />
                        </div>
                        <x-splade-input
                            type="number"
                            placeholder="{{ __('Price') }}"
                            v-model="items.main[key].price"
                            @input="items.updateTotal(key)"
                        />
                        <x-splade-input
                            type="number"
                            placeholder="{{ __('Discount') }}"
                            v-model="items.main[key].discount"
                            @input="items.updateTotal(key)"
                        />
                        <div class="col-span-2">
                            <x-splade-input
                                type="number"
                                placeholder="{{ __('Tax') }}"
                                v-model="items.main[key].tax"
                                @input="items.updateTotal(key, data.discount_type)"
                            />
                        </div>

                        <x-splade-input
                            type="number"
                            placeholder="{{ __('QTY') }}"
                            v-model="items.main[key].qty"
                            @input="items.updateTotal(key)"
                        />
                        <x-splade-input

                            type="text"
                            placeholder="{{ __('Total') }}"
                            v-model="items.main[key].total"
                            @input="items.updateTotal(key)"
                        />
                        <button @click.prevent="items.addItem" class="filament-button inline-flex items-center justify-center py-1 gap-1 font-medium rounded-lg border transition-colors focus:outline-none focus:ring-offset-2 focus:ring-2 focus:ring-inset dark:focus:ring-offset-0 min-h-[2.25rem] px-4 text-sm shadow-sm focus:ring-white filament-page-button-action bg-primary-600 hover:bg-primary-500 focus:bg-primary-700 focus:ring-offset-primary-700 text-white border-transparent">
                            <i class="bx bx-plus"></i>
                        </button>
                        <button @click.prevent="items.removeItem(item)" class="filament-button inline-flex items-center justify-center py-1 gap-1 font-medium rounded-lg border transition-colors focus:outline-none focus:ring-offset-2 focus:ring-2 focus:ring-inset dark:focus:ring-offset-0 min-h-[2.25rem] px-4 text-sm shadow-sm focus:ring-white filament-page-button-action bg-danger-600 hover:bg-danger-500 focus:bg-danger-700 focus:ring-offset-danger-700 text-white border-transparent">
                            <i class="bx bx-trash"></i>
                        </button>
                        <div v-if="items.main[key].item.has_options" v-for="(option, optionIndex) in items.main[key].item.product_metas[0].value">
                            <div class-="col-span-4">
                                <label for="">
                                    @{{ optionIndex.charAt(0).toUpperCase() + optionIndex.slice(1) }}
                                </label>
                                <x-splade-select choices v-model="items.main[key].options[optionIndex]">
                                    <option v-for="(value, valueIndex) in option" :value="value">
                                        @{{ value.charAt(0).toUpperCase() + value.slice(1) }}
                                    </option>
                                </x-splade-select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col gap-4 mt-4">
                    <div class="flex justify-between gap-4 py-4 border-b">
                        <div>
                            {{__('Tax')}}
                        </div>
                        <div>
                            @{{ items.tax }}
                        </div>
                    </div>
                    <div class="flex justify-between gap-4 py-4 border-b">
                        <div>
                            {{__('Sub Total')}}
                        </div>
                        <div>
                            @{{ items.price }}
                        </div>
                    </div>
                    <div class="flex justify-between gap-4 py-4 border-b">
                        <div>
                            {{__('Discount')}}
                        </div>
                        <div>
                            @{{ items.discount }}
                        </div>
                    </div>
                    <div class="flex justify-between gap-4 py-4 border-b">
                        <div>
                            {{__('Total')}}
                        </div>
                        <div>
                            @{{ items.total }}
                        </div>
                    </div>
                </div>
            </x-tomato-items>
        </div>

        <div>
            <x-splade-textarea name="notes" :label="__('Notes')" placeholder="{{__('Notes')}}" />
        </div>


        <div class="flex justify-start gap-2 pt-3">
            <x-tomato-admin-submit  label="{{__('Save')}}" :spinner="true" />
            <x-tomato-admin-button danger :href="route('admin.orders.destroy', $model->id)"
                                   confirm="{{trans('tomato-admin::global.crud.delete-confirm')}}"
                                   confirm-text="{{trans('tomato-admin::global.crud.delete-confirm-text')}}"
                                   confirm-button="{{trans('tomato-admin::global.crud.delete-confirm-button')}}"
                                   cancel-button="{{trans('tomato-admin::global.crud.delete-confirm-cancel-button')}}"
                                   method="delete"  label="{{__('Delete')}}" />
            <x-tomato-admin-button secondary :href="route('admin.orders.index')" label="{{__('Cancel')}}"/>
        </div>
    </x-splade-form>
</x-tomato-admin-container>
