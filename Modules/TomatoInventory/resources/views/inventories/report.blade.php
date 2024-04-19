<x-tomato-admin-container label="{{__('Show Product Report')}}">
    <x-splade-form class="flex flex-col gap-4" method="POST" action="{{route('admin.inventories.report.data')}}" stay>
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
        <x-tomato-admin-submit spinner label="{{__('Get Report')}}" />

        <div v-if="form.$response && (form.$response.data.length > 0)">
            <table  class="border min-w-full divide-y divide-gray-200 dark:divide-gray-600 bg-white dark:bg-gray-700">
                <thead>
                <tr class="hover:bg-gray-100 dark:hover:bg-gray-600">
                    <th class="border p-2">{{__('Branch')}}</th>
                    <th class="border p-2">{{__('Product')}}</th>
                    <th class="border p-2">{{__('Options')}}</th>
                    <th class="border p-2">{{__('Qty')}}</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-600 bg-white dark:bg-gray-800 text-center">
                <tr v-for="(item, key) in form.$response.data" class="hover:bg-gray-100 dark:hover:bg-gray-600">
                    <td class="border p-2"><span v-text="item.branch.name"></span></td>
                    <td class="border p-2"><span v-text="item.product.name['{{app()->getLocale()}}']"></span>  [@{{ item.product?.sku }}]</td>
                    <td class="border p-2">
                        <div v-if="item.options && Object.keys(item.options)?.length" class="flex justify-center gap-2">
                            <div v-for="(option, index) in Object.keys(item.options)" class="flex justify-center gap-2">
                                <div>@{{ item.options[option] }} <span v-if="index !== Object.keys(item.options).length-1">-</span></div>
                            </div>
                        </div>
                        <div v-else>
                            {{__('Without Options')}}
                        </div>
                    </td>
                    <td class="border p-2 font-bold">@{{ item.qty }}</td>
                </tr>
                </tbody>
            </table>

            <a class="my-4 filament-button inline-flex items-center justify-center py-1 gap-1 font-medium rounded-lg border transition-colors focus:outline-none focus:ring-offset-2 focus:ring-2 focus:ring-inset dark:focus:ring-offset-0 min-h-[2.25rem] px-4 text-sm shadow-sm focus:ring-white filament-page-button-action bg-primary-600 hover:bg-primary-500 focus:bg-primary-700 focus:ring-offset-primary-700 text-white border-transparent" target="_blank" :href="'{{route('admin.inventories.print.products')}}?branch_id='+form.branch_id+'&product_id='+form.product_id?.id">{{__('Print Report')}}</a>
        </div>

        <div v-else-if="form.$response && form.$response.data.length === 0" class="flex flex-col gap-4 items-center justify-center">
            <div>
                {{__('There is no stock records for this product on this branch')}}
            </div>
        </div>
    </x-splade-form>

</x-tomato-admin-container>
