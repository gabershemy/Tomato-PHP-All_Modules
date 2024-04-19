<x-tomato-admin-container label="{{__('Print Product Barcodes')}}">
    <x-splade-form class="flex flex-col gap-4" method="POST" action="{{route('admin.inventories.barcodes.print')}}" :default="['options' => (object)[]]">
        <x-splade-select
            choices
            name="branch_id"
            label="{{__('Branch')}}"
            placeholder="{{__('Select Branch')}}"
            remote-url="{{route('admin.branches.api')}}"
            remote-root="data"
            option-label="name"
            option-value="id"
        />
        <div>
            <label for="" class="block text-sm font-medium leading-6 text-gray-950 dark:text-white">
                {{__('Product')}}
            </label>
            <x-tomato-search
                name="product_id"
                label="{{__('Product')}}"
                placeholder="{{__('Select Product')}}"
                remote-root="data"
                remote-url="{{route('admin.orders.product')}}"
                option-label="name.{{app()->getLocale()}}"
                option-value="object"
            />
        </div>
        <div class="col-span-3" v-if="form.product_id.has_options && form.product_id.product_metas" v-for="(option, optionIndex) in form.product_id.product_metas[0].value ?? []">
            <div>
                <label for="">
                    @{{ optionIndex.charAt(0).toUpperCase() + optionIndex.slice(1) }}
                </label>
                <x-splade-select v-model="form.options[optionIndex]">
                    <option v-for="(value, valueIndex) in option" :value="value">
                        @{{ value.charAt(0).toUpperCase() + value.slice(1) }}
                    </option>
                </x-splade-select>
            </div>
        </div>
        <x-splade-input type="number" name="qty" label="{{__('Quantity')}}" placeholder="{{__('Quantity')}}" />
        <x-tomato-admin-submit spinner label="{{__('Generate Barcodes')}}" />
    </x-splade-form>
</x-tomato-admin-container>
