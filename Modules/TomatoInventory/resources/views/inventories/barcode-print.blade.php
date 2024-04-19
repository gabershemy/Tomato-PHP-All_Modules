<body onload="window.print()">
    @for($i=0; $i<$qty; $i++)
        <div class="flex flex-col items-center justify-center gap-2 my-6">
            <div>
                <img src="data:image/png;base64,{!! \Milon\Barcode\DNS1D::getBarcodePNG($barcode, 'C128') !!}" />
            </div>
            <div>
                <h1>{{$text}}</h1>
            </div>
        </div>
    @endfor
</body>
