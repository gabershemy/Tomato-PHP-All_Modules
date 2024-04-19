<table class="border min-w-full divide-y divide-gray-200 dark:divide-gray-600 bg-white dark:bg-gray-700">
    <tbody class="divide-y divide-gray-200 dark:divide-gray-600 bg-white dark:bg-gray-800">
    @foreach($item->inventoryItems as $invItem)
        <tr class="hover:bg-gray-100 dark:hover:bg-gray-600">
            <td class="border p-2">
                <div>{{$invItem->item}}</div>
                <div class="text-gray-400 flex justify-start gap-2">
                    @foreach($invItem->options ?? [] as $option)
                        <div>
                            {{ str($option)->upper() }}
                        </div>
                    @endforeach
                </div>
            </td>
            <td class="border p-2 font-bold">{{$invItem->qty}}</td>
            @if($item->status !== 'canceled')
                <td class="border p-2">
                    @if(!$invItem->is_activated)
                        @can('admin.inventories.approve.item')
                            <x-tomato-admin-tooltip text="{{__('Approve Item')}}">
                                <x-splade-link confirm href="{{route('admin.inventories.approve.item', $invItem->id)}}" method="POST">
                                    <i class="bx bx-check-circle text-primary-500"></i>
                                </x-splade-link>
                            </x-tomato-admin-tooltip>
                        @else
                            <x-tomato-admin-tooltip text="{{__('Item Approved')}}">
                                <i class="bx bx-x text-danger-500"></i>
                            </x-tomato-admin-tooltip>
                        @endcan
                    @else
                        <x-tomato-admin-tooltip text="{{__('Item Approved')}}">
                            <i class="bx bx-check text-success-500"></i>
                        </x-tomato-admin-tooltip>
                    @endif
                </td>
            @endif
        </tr>
    @endforeach
    </tbody>
</table>
