<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="rtl">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{__('Print')}}</title>
    <style>
        body {
            margin: 0 auto;
            padding: 0 auto;
        }
        table {
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid black;
            padding: 5px;
        }
    </style>
</head>
<body onload="window.print()">

@if($model->type === 'in')
    <h3 style="text-align: center; border: 1px solid #000000; padding: 10px;">{{__('Inventory Movement In')}}: {{$model->id}} </h3>
@else
    <h3 style="text-align: center; border: 1px solid #000000; padding: 10px;">{{__('Inventory Movement Out')}}: {{$model->id}} </h3>
@endif

@if($model->branch_id)
    <h3 style="text-align: center; border: 1px solid #000000; padding: 10px;">{{__('Branch')}}: {{$model->branch?->name}} </h3>
@endif
<h3 style="text-align: center; border: 1px solid #000000; padding: 10px;">{{__('Date')}}: {{$model->created_at->toDateString()}} </h3>
<table style="width:100%; text-align: center">
    <thead>
    <tr>
        <th>{{ __('ID') }}</th>
        <th>{{ __('Item') }}</th>
        <th>{{ __('Price') }}</th>
        <th>{{ __('Discount') }}</th>
        <th>{{ __('Vat') }}</th>
        <th>{{ __('Qty') }}</th>
        <th>{{ __('Total') }}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($model->inventoryItems as $key=>$item)
        <tr>
            <td>{{$key+1}}</td>
            <td>{{ $item->item }}</td>
            <td>{!! dollar($item->price) !!}</td>
            <td>{!! dollar($item->discount) !!}</td>
            <td>{!! dollar($item->tax) !!}</td>
            <td>{{$item->qty}}</td>
            <td>{!! dollar($item->total) !!}</td>
        </tr>
    @endforeach
    <tr>
        <td colspan="6">{{__('Total')}}</td>
        <td ><b>{!! dollar($model->total) !!}</b></td>
    </tr>
    </tbody>
</table>
<div style="text-align: center">
    <h3>{{__('Notes')}}</h3>
    <h3>{{__('User')}}: {{$model->user?->name}}</h3>
    <h3>{{__('User Signature')}}: ...................................</h3>
</div>
</body>
