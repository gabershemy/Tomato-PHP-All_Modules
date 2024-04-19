<x-tomato-admin-container label="{{trans('tomato-admin::global.crud.view')}} {{__('Orders')}} #{{$model->uuid}} | [{{$model->branch?->name}}]">
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
                    <div class="text-lg font-bold mt-2">
                        {{$model->account?->name}}
                    </div>
                    <div class="text-sm">
                        {{$model->account?->email}}
                    </div>
                    <div class="text-sm">
                        {{$model->account?->phone}}
                    </div>
                    <div class="text-sm">
                        {{$model->address}}
                    </div>
                    <div class="text-sm">
                        {{$model->country?->name}} , {{$model->city?->name}}, {{$model->area?->name}}
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
                    {{$model->uuid}}
                </div>
            </div>
            <div class="flex justify-between gap-4">
                <div class="flex flex-col justify-center items-center">
                    {{__('Issue date')}}
                </div>
                <div>
                    {{$model->created_at->toDateString()}}
                </div>
            </div>
            <div class="flex justify-between gap-4">
                <div class="flex flex-col justify-center items-center">
                    {{__('Due date')}}
                </div>
                <div>
                    {{$model->created_at->toDateString()}}
                </div>
            </div>
            <div class="flex justify-between gap-4">
                <div class="flex flex-col justify-center items-center">
                    {{__('Status')}}
                </div>
                <div>
                    {{str($model->status)->upper()}}
                </div>
            </div>
            <div class="flex justify-between gap-4">
                <div class="flex flex-col justify-center items-center">
                    {{__('Source')}}
                </div>
                <div class="font-bold text-primary-500">
                    {{str($model->source)->upper()}}
                </div>
            </div>
        </div>
    </div>
    <div>
        <div class="grid grid-cols-12 gap-4 border-b py-4 my-4 font-bold">
            <div class="col-span-4 ">
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
            @foreach($model->ordersItems as $item)
                <div class="grid grid-cols-12 gap-4 border-b py-4">
                    <div class="col-span-4 flex  flex-col justify-start">
                        <div>
                            {{ $item->product?->name }}
                        </div>
                        <div class="text-gray-400">
                            @foreach($item->options as $label=>$options)
                                <span>{{  str($label)->ucfirst() }}</span> : {{$options}} <br>
                            @endforeach
                        </div>
                    </div>
                    <div>
                        {!! dollar($item->price) !!}
                    </div>
                    <div>
                        {!! dollar($item->discount) !!}
                    </div>
                    <div class="col-span-2">
                        {!! dollar($item->tax) !!}
                    </div>
                    <div>
                        {{$item->qty}}
                    </div>
                    <div>
                        {!! dollar($item->total) !!}
                    </div>
                </div>
            @endforeach

        </div>
        <div class="flex flex-col gap-4 mt-4">
            <div class="flex justify-between gap-4 py-4 border-b">
                <div class="font-bold">
                    {{__('Sub Total')}}
                </div>
                <div>
                    {!! dollar(($model->total + $model->discount) - ($model->vat + $model->shipping)) !!}
                </div>
            </div>
            <div class="flex justify-between gap-4 py-4 border-b text-success-500">
                <div class="font-bold">
                    {{__('Tax')}}
                </div>
                <div>
                    {!! dollar($model->vat ) !!}
                </div>
            </div>
            <div class="flex justify-between gap-4 py-4 border-b text-success-500">
                <div class="font-bold">
                    {{__('Shipping')}}
                </div>
                <div>
                    {!! dollar($model->shipping ) !!}
                </div>
            </div>
            <div class="flex justify-between gap-4 py-4 border-b text-danger-500">
                <div class="font-bold">
                    {{__('Discount')}}
                </div>
                <div>
                    {!! dollar($model->discount ) !!}
                </div>
            </div>
            <div class="flex justify-between gap-4 py-4 border-b text-primary-500">
                <div class="font-bold">
                    {{__('Total')}}
                </div>
                <div>
                    {!! dollar($model->total + $model->shipping) !!}
                </div>
            </div>
            @if($model->notes)
            <div class="flex flex-col gap-4 py-4 text-gray-800">
                <div class="font-bold">
                    {{__('Notes')}}
                </div>
                <div>
                    {{ $model->notes }}
                </div>
            </div>
             @endif
        </div>
    </div>
    <div class="flex justify-start gap-2 pt-3">
        <a href="{{route('admin.orders.print', $model->id)}}" target="_blank" class="filament-button inline-flex items-center justify-center py-1 gap-1 font-medium rounded-lg border focus:outline-none focus:ring-offset-2 focus:ring-2 focus:ring-inset dark:focus:ring-offset-0 min-h-[2.25rem] px-4 text-sm shadow-sm focus:ring-white filament-page-button-action bg-primary-600 hover:bg-primary-500 focus:bg-primary-700 focus:ring-offset-primary-700 text-white border-transparent cursor-pointer transition-colors ease-in-out duration-20">
            {{__('Print')}}
        </a>
        <x-tomato-admin-button warning label="{{__('Edit')}}" :href="route('admin.orders.edit', $model->id)"/>
        <x-tomato-admin-button danger :href="route('admin.orders.destroy', $model->id)"
                               confirm="{{trans('tomato-admin::global.crud.delete-confirm')}}"
                               confirm-text="{{trans('tomato-admin::global.crud.delete-confirm-text')}}"
                               confirm-button="{{trans('tomato-admin::global.crud.delete-confirm-button')}}"
                               cancel-button="{{trans('tomato-admin::global.crud.delete-confirm-cancel-button')}}"
                               method="delete"  label="{{__('Delete')}}" />
        <x-tomato-admin-button secondary :href="route('admin.orders.index')" label="{{__('Cancel')}}"/>
    </div>

    <x-tomato-admin-relations-group :relations="['orderLogs' => __('Order History')]">
        <x-tomato-admin-relations
            :model="$model"
            name="orderLogs"
            :table="\Modules\TomatoOrders\App\Tables\OrderLogTable::class"
            view="tomato-orders::order-logs.index"
        />
    </x-tomato-admin-relations-group>
</x-tomato-admin-container>
