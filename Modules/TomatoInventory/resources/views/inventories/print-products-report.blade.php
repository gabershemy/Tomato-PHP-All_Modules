<!doctype html>
<html lang="en" dir="{{app()->getLocale() === 'ar' ? 'rtl' : 'ltr'}}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <title>{{__('Print Inventory Products Report For Branch')}} @if(request()->get('branch_id')): {{$report[0]->branch?->name}} @endif</title>

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
    <h3 style="border: 1px solid #000000; text-align: center; padding: 5px;">{{__('Print Inventory Products Report For Branch')}}@if(request()->get('branch_id')): {{$report[0]->branch?->name}} @endif</h3>
    <br>
    <p style="margin-top: -15px;">{{__('Printed At')}}: {{\Carbon\Carbon::now()->format('d/m/Y g:i A')}}</p>
    <p style="margin-top: -15px;">{{__('Printed By')}}: {{ auth('web')->user()->name }}
    </p>
    <table border="0" style="width: 100%">
        <thead>
            <tr>
                <th>{{ __('ID') }}</th>
                <th>{{ __('Branch') }}</th>
                <th>{{ __('Product') }}</th>
                <th>{{ __('Options') }}</th>
                <th>{{ __('Qty') }}</th>
            </tr>
        </thead>
        <tbody>
        @foreach($report as $item)
            <tr>
                <td>{{$item->id}}</td>
                <td>{{$item->branch?->name}}</td>
                <td>{{$item->product?->name}} [SKU: {{$item->product?->sku}}]</td>
                <td>
                    @if(count($item->options))
                        @php $counter =0; @endphp
                        @foreach($item->options as $key=>$option)
                            @if($option)
                                <span>{{ $option }}</span>
                                @if((count($item->options)-1) !== $counter)
                                    <span>-</span>
                                @endif
                            @endif
                            @php $counter++; @endphp
                        @endforeach
                    @else
                        {{__('No Options')}}
                    @endif

                </td>
                <td><b>{{$item->qty}}</b></td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
</body>

</html>
