<x-tomato-admin-layout>
    <x-slot:header>
        {{__('Ordering Settings')}}
    </x-slot:header>

    <x-slot:buttons>
        <x-tomato-admin-button :href="route('admin.orders.index')">
            <span>{{__('Back')}}</span>
        </x-tomato-admin-button>
    </x-slot:buttons>

    <div class="flex flex-col gap-4 mb-4">
        <div>
            <x-tomato-settings-card :title="__('Order Branches')" :description="__('Change Main Branch For Ordering Sources')">
                <x-splade-form method="post" action="{{route('admin.orders.settings.update')}}" class="mt-6 space-y-6" :default="$settings">
                    <div>
                        <x-splade-input
                            name="ordering_stating_code"
                            :label="__('Stating Order ID By')"
                        />
                        @if(config('tomato-settings.helpers'))
                            <div class="p-1">
                                <small class="text-red-500"><code>setting('ordering_stating_code')</code></small>
                            </div>
                        @endif
                    </div>
                    <div>
                        <x-splade-select
                            name="ordering_web_branch"
                            :label="__('Web Order Branch')"
                            :placeholder="__('Select Branch')"
                            remote-root="data"
                            remote-url="{{route('admin.branches.api')}}"
                            option-value="id"
                            option-label="name"
                            choices
                        />
                        @if(config('tomato-settings.helpers'))
                            <div class="p-1">
                                <small class="text-red-500"><code>setting('ordering_web_branch')</code></small>
                            </div>
                        @endif
                    </div>
                    <div>
                        <x-splade-select
                            name="ordering_mobile_branch"
                            :label="__('Mobile Order Branch')"
                            :placeholder="__('Select Branch')"
                            remote-root="data"
                            remote-url="{{route('admin.branches.api')}}"
                            option-value="id"
                            option-label="name"
                            choices
                        />
                        @if(config('tomato-settings.helpers'))
                            <div class="p-1">
                                <small class="text-red-500"><code>setting('ordering_mobile_branch')</code></small>
                            </div>
                        @endif
                    </div>
                    <div>
                        <x-splade-select
                            name="ordering_direct_branch"
                            :label="__('Direct Order Branch')"
                            :placeholder="__('Select Branch')"
                            remote-root="data"
                            remote-url="{{route('admin.branches.api')}}"
                            option-value="id"
                            option-label="name"
                            choices
                        />
                        @if(config('tomato-settings.helpers'))
                            <div class="p-1">
                                <small class="text-red-500"><code>setting('ordering_direct_branch')</code></small>
                            </div>
                        @endif
                    </div>
                    @if(class_exists(\TomatoPHP\TomatoInventory\TomatoInventoryServiceProvider::class))
                        <div>
                            <x-splade-select
                                name="ordering_active_inventory_web_branch"
                                :label="__('Inventory Web Branch')"
                                :placeholder="__('Select Branch')"
                                remote-root="data"
                                remote-url="{{route('admin.branches.api')}}"
                                option-value="id"
                                option-label="name"
                                choices
                            />
                            @if(config('tomato-settings.helpers'))
                                <div class="p-1">
                                    <small class="text-red-500"><code>setting('ordering_active_inventory_web_branch')</code></small>
                                </div>
                            @endif
                        </div>

                        <div>
                            <x-splade-select
                                name="ordering_active_inventory_direct_branch"
                                :label="__('Inventory Direct Branch')"
                                :placeholder="__('Select Branch')"
                                remote-root="data"
                                remote-url="{{route('admin.branches.api')}}"
                                option-value="id"
                                option-label="name"
                                choices
                            />
                            @if(config('tomato-settings.helpers'))
                                <div class="p-1">
                                    <small class="text-red-500"><code>setting('ordering_active_inventory_direct_branch')</code></small>
                                </div>
                            @endif
                        </div>

                    @endif


                    <div class="flex items-center gap-4">
                        <x-splade-submit :label="trans('tomato-admin::global.save')" />
                    </div>
                </x-splade-form>
            </x-tomato-settings-card>
        </div>
        <div>
            <x-tomato-settings-card :title="__('Order Shipping Settings')" :description="__('Change And Active Shipping Fees')">
                <x-splade-form method="post" action="{{route('admin.orders.settings.update')}}" class="mt-6 space-y-6" :default="$settings">
                    <div>
                        <x-splade-checkbox
                            name="ordering_active_shipping_fees"
                            :label="__('Active Shipping Fees')"
                        />
                        @if(config('tomato-settings.helpers'))
                            <div class="p-1">
                                <small class="text-red-500"><code>setting('ordering_active_shipping_fees')</code></small>
                            </div>
                        @endif
                    </div>
                    <div>
                        <x-splade-input
                            name="ordering_shipping_fees"
                            :label="__('Shipping Fees')"
                            type="number"
                        />
                        @if(config('tomato-settings.helpers'))
                            <div class="p-1">
                                <small class="text-red-500"><code>setting('ordering_shipping_fees')</code></small>
                            </div>
                        @endif
                    </div>
                    <div class="flex items-center gap-4">
                        <x-splade-submit :label="trans('tomato-admin::global.save')" />
                    </div>
                </x-splade-form>
            </x-tomato-settings-card>
        </div>
        <div>
            <x-tomato-settings-card :title="__('Order Recipe Settings')" :description="__('Change How Recipe looks')">
                <x-splade-form method="post" action="{{route('admin.orders.settings.update')}}" class="mt-6 space-y-6" :default="$settings">
                    @if(class_exists(\TomatoPHP\TomatoInventory\TomatoInventoryServiceProvider::class))
                    <div>
                        <x-splade-checkbox
                            name="ordering_active_inventory"
                            :label="__('Active Inventory')"
                        />
                        @if(config('tomato-settings.helpers'))
                            <div class="p-1">
                                <small class="text-red-500"><code>setting('ordering_active_inventory')</code></small>
                            </div>
                        @endif
                    </div>
                    @endif
                    <div>
                        <x-splade-checkbox
                            name="ordering_show_company_data"
                            :label="__('Show Company Data')"
                             />
                        @if(config('tomato-settings.helpers'))
                            <div class="p-1">
                                <small class="text-red-500"><code>setting('ordering_show_company_data')</code></small>
                            </div>
                        @endif
                    </div>
                    <div>
                        <x-splade-checkbox
                            name="ordering_show_branch_data"
                            :label="__('Show Branch Data')"
                             />
                        @if(config('tomato-settings.helpers'))
                            <div class="p-1">
                                <small class="text-red-500"><code>setting('ordering_show_branch_data')</code></small>
                            </div>
                        @endif
                    </div>
                    <div>
                        <x-splade-checkbox
                            name="ordering_show_company_logo"
                            :label="__('Show Company Logo')"
                             />
                        @if(config('tomato-settings.helpers'))
                            <div class="p-1">
                                <small class="text-red-500"><code>setting('ordering_show_company_logo')</code></small>
                            </div>
                        @endif
                    </div>
                    <div>
                        <x-splade-checkbox
                            name="ordering_show_tax_number"
                            :label="__('Show Tax Number')"
                             />
                        @if(config('tomato-settings.helpers'))
                            <div class="p-1">
                                <small class="text-red-500"><code>setting('ordering_show_tax_number')</code></small>
                            </div>
                        @endif
                    </div>
                    <div>
                        <x-splade-checkbox
                            name="ordering_show_registration_number"
                            :label="__('Show Registration Number')"
                             />
                        @if(config('tomato-settings.helpers'))
                            <div class="p-1">
                                <small class="text-red-500"><code>setting('ordering_show_registration_number')</code></small>
                            </div>
                        @endif
                    </div>
                    <div class="flex items-center gap-4">
                        <x-splade-submit :label="trans('tomato-admin::global.save')" />
                    </div>
                </x-splade-form>
            </x-tomato-settings-card>
        </div>
        <div>
            <x-tomato-settings-card :title="__('Order Status Settings')" :description="__('Change The label of status')">
                <x-splade-form method="post" action="{{route('admin.orders.settings.update')}}" class="mt-6 space-y-6" :default="$settings">
                    <div>
                        <x-splade-input
                            type="text"
                            name="ordering_pending_status"
                            :label="__('Pending Status')"
                        />
                        @if(config('tomato-settings.helpers'))
                            <div class="p-1">
                                <small class="text-red-500"><code>setting('ordering_pending_status')</code></small>
                            </div>
                        @endif
                    </div>
                    <div>
                        <x-splade-input
                            type="text"
                            name="ordering_prepared_status"
                            :label="__('Prepared Status')"
                        />
                        @if(config('tomato-settings.helpers'))
                            <div class="p-1">
                                <small class="text-red-500"><code>setting('ordering_prepared_status')</code></small>
                            </div>
                        @endif
                    </div>
                    <div>
                        <x-splade-input
                            type="text"
                            name="ordering_withdrew_status"
                            :label="__('Withdrew Status')"
                        />
                        @if(config('tomato-settings.helpers'))
                            <div class="p-1">
                                <small class="text-red-500"><code>setting('ordering_withdrew_status')</code></small>
                            </div>
                        @endif
                    </div>
                    <div>
                        <x-splade-input
                            type="text"
                            name="ordering_shipped_status"
                            :label="__('Shipped Status')"
                        />
                        @if(config('tomato-settings.helpers'))
                            <div class="p-1">
                                <small class="text-red-500"><code>setting('ordering_shipped_status')</code></small>
                            </div>
                        @endif
                    </div>
                    <div>
                        <x-splade-input
                            type="text"
                            name="ordering_delivered_status"
                            :label="__('Delivered Status')"
                        />
                        @if(config('tomato-settings.helpers'))
                            <div class="p-1">
                                <small class="text-red-500"><code>setting('ordering_delivered_status')</code></small>
                            </div>
                        @endif
                    </div>
                    <div>
                        <x-splade-input
                            type="text"
                            name="ordering_cancelled_status"
                            :label="__('Cancelled Status')"
                        />
                        @if(config('tomato-settings.helpers'))
                            <div class="p-1">
                                <small class="text-red-500"><code>setting('ordering_cancelled_status')</code></small>
                            </div>
                        @endif
                    </div>
                    <div>
                        <x-splade-input
                            type="text"
                            name="ordering_refunded_status"
                            :label="__('Refunded Status')"
                        />
                        @if(config('tomato-settings.helpers'))
                            <div class="p-1">
                                <small class="text-red-500"><code>setting('ordering_refunded_status')</code></small>
                            </div>
                        @endif
                    </div>
                    <div>
                        <x-splade-input
                            type="text"
                            name="ordering_done_status"
                            :label="__('Done Status')"
                        />
                        @if(config('tomato-settings.helpers'))
                            <div class="p-1">
                                <small class="text-red-500"><code>setting('ordering_done_status')</code></small>
                            </div>
                        @endif
                    </div>
                    <div>
                        <x-splade-input
                            type="text"
                            name="ordering_paid_status"
                            :label="__('Paid Status')"
                        />
                        @if(config('tomato-settings.helpers'))
                            <div class="p-1">
                                <small class="text-red-500"><code>setting('ordering_paid_status')</code></small>
                            </div>
                        @endif
                    </div>
                    <div class="flex items-center gap-4">
                        <x-splade-submit :label="trans('tomato-admin::global.save')" />
                    </div>
                </x-splade-form>
            </x-tomato-settings-card>
        </div>
    </div>
</x-tomato-admin-layout>
