@extends('one-theme::layouts.master')

@section('content')
    <div class="flex flex-col items-center border-b bg-white py-4 sm:flex-row sm:px-10 lg:px-20 xl:px-32">
        <div class="text-2xl font-bold text-gray-800">{{__('Wishlist')}}</div>
    </div>

    <div class="sm:px-10 lg:px-20 xl:px-32 my-4">
        <x-splade-modal>
            <x-slot:title>
                {{__('Wishlist')}}
            </x-slot:title>

            @if($products->count())
                <div class="grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3 xl:gap-x-8">
                    @foreach($products as $product)
                        @include('one-theme::shop.partials.product-card', ['product' => $product->product])
                    @endforeach
                </div>

                <div class="my-4">
                    {!! $products->links('tomato-sections::sections.pagination') !!}
                </div>
            @else
                <div>
                    {{__('You have no products in your wishlist.')}}
                </div>
            @endif
        </x-splade-modal>
    </div>

@endsection
