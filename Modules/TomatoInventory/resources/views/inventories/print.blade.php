<!doctype html>
<html lang="en" dir="{{app()->getLocale() === 'ar' ? 'rtl' : 'ltr'}}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <title>{{__('Print Inventory Report')}}</title>

    <style>
        body, html {
            margin: 0 !important;
            padding: 0 !important;
        }
        table {
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #000000;
            padding: 5px;
        }
    </style>
</head>

<body onload="window.print()">
<div  style="margin-left: auto; margin-right:auto; display:block">
    <div>
        <img style="width: 100px" src="{{setting('site_logo')}}"></div><br>
    <br>
    <h3 style="border: 1px solid #000000; text-align: center; padding: 5px;">{{__('Print Inventory Report')}}</h3>
    <br>
    <p style="margin-top: -15px;">{{__('Printed At')}}: {{\Carbon\Carbon::now()->format('d/m/Y g:i A')}}</p>
    <p style="margin-top: -15px;">{{__('Printed By')}}: {{ auth('web')->user()->name }}
    </p>

    <table border="0" style="width: 100%">
        <thead class="border min-w-full divide-y divide-gray-200 dark:divide-gray-600 bg-white dark:bg-gray-700">
            <tr class="hover:bg-gray-100 dark:hover:bg-gray-600">
            <th class="border p-2 font-bold">{{ __('ID') }}</th>
            <th class="border p-2 font-bold" >{{ __('User') }}</th>
            <th class="border p-2 font-bold">{{ __('Branch') }}</th>
            <th class="border p-2 font-bold">{{ __('Order') }}</th>
            <th class="border p-2 font-bold">{{ __('Type') }}</th>
            <th class="border p-2 font-bold">{{ __('Items') }}</th>
        </tr>
        </thead>
        <tbody>
            @foreach($inventory as $item)
            <tr>
                <td class="border p-2 font-bold">{{$item->id}}</td>
                <td class="border p-2 font-bold">@if($item->user_id){{$item?->user->name}}@endif</td>
                <td class="border p-2 font-bold">{{$item->branch?->name}}</td>
                <td class="border p-2 font-bold">{{$item->order?->id}}</td>
                <td class="border p-2 font-bold">{{$item->type}}</td>
                <td class="border p-2 font-bold">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>{{__('SKU')}}</th>
                            <th>{{__('Options')}}</th>
                            <th>{{__('QNT')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($item->inventoryItems()->get()->map(function ($item){
                            if($item->item_type){
                                $item->item = $item->item_type::where('id',$item->item_id)->with('productMetas', function ($q){
                                    $q->where('key', 'options');
                                })->first();
                            }
                            return $item;
                        }) as $key=>$value)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                @if(is_object($value->item))
                                    <td>{{ $value->item?->name }} - {{ $value->item?->sku }}</td>
                                @else
                                    <td>{{ $value->item }}</td>
                                @endif
                                <td>
                                @if($value->options)
                                    @foreach($value->options as $op)
                                        <span class="badge badge-success m-1 p-2">{{ $op }}</span>
                                    @endforeach
                                @endif
                                </td>
                                <td>{{ $value->qty }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
</body>
</html>
