<x-tomato-admin-container label="{{__('Add Balance')}} # {{$model->name}}">
    <x-splade-data :default="['balance' => $model->balance]">
        <x-splade-form confirm class="flex flex-col gap-4" action="{{route('admin.wallets.balance.update', $model->id)}}" method="post" :default="$model">
            <div>
                {{__('Current User Balance:')}} <span class="text-xl font-bold">@{{ parseFloat(data.balance) }}</span>{{setting('local_currency')}}
            </div>
            <div>
                {{__('New Balance:')}} <span class="text-xl font-bold">@{{ parseFloat(form.new_balance ?form.new_balance: 0) }}</span>{{setting('local_currency')}}
            </div>
            <div>
                {{__('Balance After Charge:')}} <span class="text-xl font-bold">@{{ parseFloat(data.balance) + parseFloat(form.new_balance ?form.new_balance: 0) }}</span>{{setting('local_currency')}}
            </div>
            <hr>
            <x-splade-input label="{{__('Total Amount')}}" name="new_balance" type="number" placeholder="{{__('Total Amount')}}"  />
            <x-splade-textarea class="col-span-2" label="{{__('Reason')}}" name="reason"  placeholder="{{__('Reason')}}"/>

            <x-splade-submit class="col-span-2" label="{{__('Add New Balance')}}" :spinner="true" />
        </x-splade-form>
    </x-splade-data>
</x-tomato-admin-container>
