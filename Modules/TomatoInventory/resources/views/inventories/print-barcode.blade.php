<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{__('Print Inventory Barcodes')}}</title>
</head>
<body onload="window.print()">
@foreach($items as $item)
    <div style="margin-left: 0 auto; margin-right: 0 auto; display: block; text-align: center">
        <div>
            <img src="data:image/png;base64,{!! \Milon\Barcode\DNS1D::getBarcodePNG($item->uuid, 'C128', 0.9) !!}" />
        </div>
        <div style="margin-top: -20px;">
            @php
                $options = "";
                 foreach ($item->options as $key=>$option) {
                     $options.= $option.'-';
                 }
                 $price = \Modules\TomatoEcommerce\App\Services\Cart\ProductsServices::getProductPrice($item->item_id, $item->options??[]);
                 $product = \Modules\TomatoProducts\App\Models\Product::find($item->item_id);
                 $barcode = $product->sku . '-'.$options.$price->collect();
            @endphp
            <h4>{{$barcode}}</h4>
        </div>
    </div>
@endforeach
</body>

</html>
