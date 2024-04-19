@extends('one-theme::layouts.master')

@section('content')
    <div class="flex flex-col items-center border-b bg-white py-4 sm:flex-row sm:px-10 lg:px-20 xl:px-32">
        <div class="text-2xl font-bold text-gray-800">{{__('Cart')}}</div>
    </div>

    <div class="sm:px-10 lg:px-20 xl:px-32">
        <x-splade-modal modal>
            <x-slot:title>
                {{__('Cart')}}
            </x-slot:title>

            @if(!$carts->count())
                <div class="h-90 flex flex-col justify-center items-center">
                    <div class=" flex flex-col justify-center items-center gap-4">
                        <i class="bx bx-cart bx-md"></i>
                        <span class="font-bold">{{__('Sorry Cart Is Empty!')}}</span>
                    </div>
                </div>
            @else
                <div class="flex-1 overflow-y-auto px-4 sm:px-6 ">
                    <div class="mt-8">
                        <div class="flow-root">
                            <ul role="list" class="-my-6 divide-y divide-gray-200">
                                @foreach($carts as $cart)
                                    <li class="flex py-6">
                                        <div class="h-24 w-24 flex-shrink-0 overflow-hidden rounded-md border border-gray-200">
                                            <img src="{{$cart->product?->getMedia('featured_image')->first()?->getUrl() ?? url('placeholder.webp')}}" alt="{{$cart->item}}" class="h-full w-full object-cover object-center">
                                        </div>

                                        <div class="ml-4 flex flex-1 flex-col">
                                            <div>
                                                <div class="flex justify-between text-base font-medium text-gray-900">
                                                    <h3>
                                                        <x-splade-link href="{{$cart->product ? url('shop/product/' . $cart->product?->slug) : '#'}}">{{$cart->item}}</x-splade-link>
                                                    </h3>
                                                    <p class="ml-4">{!! dollar($cart->total) !!}</p>
                                                </div>
                                                <p class="mt-1 text-sm text-gray-500">
                                                    {{__('price')}} : {!! dollar(($cart->price + $cart->vat) - $cart->discount) !!} <br>
                                                    @foreach($cart->options as $key=>$option)
                                                        {{$key}} : {{str($option)->upper()}} <br>
                                                    @endforeach
                                                </p>
                                            </div>
                                            <div class="flex flex-1 items-end justify-between text-sm">
                                                <x-splade-form preserve-scroll method="POST" action="{{route('cart.update', $cart->id)}}" class="flex justify-start gap-2" :default="$cart" submit-on-change>
                                                    <x-splade-input name="qty" type="hidden"/>
                                                    <button @click.prevent="form.qty++">+</button>
                                                    <p class="text-gray-500">{{__('Qty')}} {{$cart->qty}}</p>
                                                    <button @click.prevent="form.qty--">-</button>
                                                </x-splade-form>

                                                <div class="flex">
                                                    <x-splade-link method="DELETE" confirm :href="route('cart.destroy', $cart->id)" class="font-medium text-indigo-600 hover:text-indigo-500">{{__('Remove')}}</x-splade-link>

                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="border-t mt-4 border-gray-200 px-4 py-6 sm:px-6">
                    <div class="flex justify-between text-base font-medium text-gray-900">
                        <p>{{__('Subtotal')}}</p>
                        <p>{!! dollar($carts->sum('total')) !!}</p>
                    </div>
                    <p class="mt-0.5 text-sm text-gray-500">{{__('Shipping and taxes calculated at checkout.')}}</p>
                    <div class="mt-6">
                        <div class="my-4 w-full flex justify-center gap-4">
                            <x-tomato-admin-button href="{{route('checkout.index')}}" class="w-full">
                                {{__('Checkout')}}
                            </x-tomato-admin-button>
                            <x-tomato-admin-button confirm danger method="POST" href="{{route('cart.clear')}}" class="w-full">
                                {{__('Clear All Cart Items')}}
                            </x-tomato-admin-button>
                        </div>
                    </div>
                    <div class="mt-6 flex justify-center text-center text-sm text-gray-500">
                        <p>
                            {{__('or')}}
                            <button @click.prevent="modal.close()" type="button" class="font-medium text-indigo-600 hover:text-indigo-500">
                                {{__('Continue Shopping')}}
                                <span aria-hidden="true"> &rarr;</span>
                            </button>
                        </p>
                    </div>
                </div>
            @endif

        </x-splade-modal>
    </div>

@endsection
