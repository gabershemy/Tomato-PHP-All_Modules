<x-splade-form preserve-scroll method="POST" action="{{route('admin.pos.cart.index')}}" :default="[
    'product_id' => $product->id
]">
    <button
        class="play select-none cursor-pointer transition-shadow overflow-hidden rounded-2xl bg-white dark:bg-gray-800 dark:border-gray-700 border-gray-200 border dark:text-gray-200 shadow hover:shadow-lg"
        type="submit"
        @click.prevent="@js($product->has_options) ? $splade.modal('{{route('admin.pos.cart.options')}}?product_id={{$product->id}}') : form.submit()"
    >
        <img src="{{ $product->getMedia('featured_image')->first()?->getUrl() ?? url('placeholder.webp') }}" alt="{{$product->name}}">
        <div class="flex flex-col gap-2 text-sm py-4 border-t border-gray-200 dark:border-gray-700">
            <p class="flex-grow truncate font-bold text-lg">
                {{$product->name}}
            </p>
            <p class="nowrap font-semibold" >
                {!! dollar(($product->price+$product->vat)-$product->discount) !!}
            </p>
        </div>
    </button>
</x-splade-form>
<audio id="audio" style="{display: none}" src="{{url('sound/beep-29.mp3')}}" preload="auto"></audio>

<!-- end of right sidebar -->
<x-splade-script>
    document.querySelectorAll(".play").forEach((button) =>  button.addEventListener("click", () => document.getElementById("audio").play(), false));
</x-splade-script>
