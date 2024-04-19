<x-splade-table :for="$query" v-if="data.tab === 'orders'" striped>
    <x-splade-cell account.name>
        <x-tomato-admin-row table type="badge" href="{{route('admin.accounts.show', $item->account?->id)}}" :value="$item->account?->name" />
    </x-splade-cell>
    <x-splade-cell created_at>
        <x-tomato-admin-row table type="text" :value="$item->created_at->diffForHumans()" />
    </x-splade-cell>
    <x-splade-cell phone>
        <x-tomato-admin-row table type="tel" :value="$item->phone" />
    </x-splade-cell>
    <x-splade-cell total>
        {!! dollar($item->total) !!}
    </x-splade-cell>
    <x-splade-cell status>
        <x-splade-form class="w-64" method="POST" action="{{route('admin.orders.status', $item->id)}}" :default="$item" submit-on-change>
            <x-splade-select :disabled="
                            $item->status === setting('ordering_cancelled_status') ||
                            $item->status === setting('ordering_paid_status')"

                             name="status" placeholder="{{__('Status')}}" >
                @if($item->status === setting('ordering_pending_status'))
                    <option value="{{setting('ordering_pending_status')}}">{{str(setting('ordering_pending_status'))->ucfirst()}}</option>
                @endif
                @if($item->status === setting('ordering_prepared_status'))
                    <option value="{{setting('ordering_prepared_status')}}">{{str(setting('ordering_prepared_status'))->ucfirst()}}</option>
                @endif
                @if($item->status === setting('ordering_withdrew_status'))
                    <option value="{{setting('ordering_withdrew_status')}}">{{str(setting('ordering_withdrew_status'))->ucfirst()}}</option>
                @endif
                @if($item->status === setting('ordering_shipped_status'))
                    <option value="{{setting('ordering_shipped_status')}}">{{str(setting('ordering_shipped_status'))->ucfirst()}}</option>
                @endif
                <option value="{{setting('ordering_delivered_status')}}">{{str(setting('ordering_delivered_status'))->ucfirst()}}</option>
                <option value="{{setting('ordering_cancelled_status')}}">{{str(setting('ordering_cancelled_status'))->ucfirst()}}</option>
                <option value="{{setting('ordering_refunded_status')}}">{{str(setting('ordering_refunded_status'))->ucfirst()}}</option>
                <option value="{{setting('ordering_paid_status')}}">{{str(setting('ordering_paid_status'))->ucfirst()}}</option>
            </x-splade-select>
        </x-splade-form>
    </x-splade-cell>
    <x-splade-cell actions>
        <div class="flex justify-start gap-2">
            @if(!$item->is_approved && $item->status !== setting('ordering_cancelled_status'))
                <x-tomato-admin-tooltip text="{{__('Approve')}}">
                    <x-tomato-admin-button confirm  success type="icon" method="POST" :href="route('admin.orders.approve', $item->id)">
                        <x-heroicon-s-check-circle class="h-6 w-6"/>
                    </x-tomato-admin-button>
                </x-tomato-admin-tooltip>
            @endif
            @if($item->status === setting('ordering_withdrew_status'))
                <x-tomato-admin-tooltip text="{{__('Shipping')}}">
                    <x-tomato-admin-button type="icon" :href="route('admin.orders.shipping', $item->id)" modal>
                        <x-heroicon-s-truck class="h-6 w-6"/>
                    </x-tomato-admin-button>
                </x-tomato-admin-tooltip>
            @endif
            @if($item->status !== setting('ordering_cancelled_status'))
                <x-tomato-admin-tooltip text="{{__('Print')}}">
                    <a href="{{route('admin.orders.print', $item->id)}}" target="_blank" class="px-2 text-primary-500">
                        <x-heroicon-s-printer class="h-6 w-6"/>
                    </a>
                </x-tomato-admin-tooltip>
                <x-tomato-admin-tooltip text="{{trans('tomato-admin::global.crud.view')}}">
                    <x-tomato-admin-button success type="icon" :href="route('admin.orders.show', $item->id)">
                        <x-heroicon-s-eye class="h-6 w-6"/>
                    </x-tomato-admin-button>
                </x-tomato-admin-tooltip>
                <x-tomato-admin-tooltip text="{{trans('tomato-admin::global.crud.edit')}}">
                    <x-tomato-admin-button warning type="icon"  :href="route('admin.orders.edit', $item->id)">
                        <x-heroicon-s-pencil class="h-6 w-6"/>
                    </x-tomato-admin-button>
                </x-tomato-admin-tooltip>
            @endif
            <x-tomato-admin-tooltip text="{{trans('tomato-admin::global.crud.delete')}}">
                <x-tomato-admin-button danger type="icon" :href="route('admin.orders.destroy', $item->id)"
                                       confirm="{{trans('tomato-admin::global.crud.delete-confirm')}}"
                                       confirm-text="{{trans('tomato-admin::global.crud.delete-confirm-text')}}"
                                       confirm-button="{{trans('tomato-admin::global.crud.delete-confirm-button')}}"
                                       cancel-button="{{trans('tomato-admin::global.crud.delete-confirm-cancel-button')}}"
                                       method="delete"
                >
                    <x-heroicon-s-trash class="h-6 w-6"/>
                </x-tomato-admin-button>
            </x-tomato-admin-tooltip>


        </div>
    </x-splade-cell>
</x-splade-table>
