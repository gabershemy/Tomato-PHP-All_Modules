<x-tomato-admin-container label="{{__('Import Inventory')}}">
    <x-splade-form class="flex flex-col space-y-4" action="{{route('admin.inventories.import.store')}}" method="post" :default="['type' => 'in','uuid' => 'INVENTORY-'.\Illuminate\Support\Str::random(6).'-'.date('YmdHis')]">
        <a class="text-primary-500 underline" href="https://docs.google.com/spreadsheets/d/1vzVHt-vTwD4mUm-LYXCIFIdFIzNX6LrzuON-Un3H7Ns/edit?usp=sharing" target="_blank">
            {{__('Please Check This XLSX file before create new one')}}
        </a>
        <x-splade-file filepond name="file" label="{{__('Please add your XLSX file')}}" />

        <x-splade-input disabled name="uuid" placeholder="{{__('UUID')}}" label="{{__('UUID')}}" />
        <x-splade-select :label="__('To Branch')" :placeholder="__('To Branch')" name="branch_id" remote-url="/admin/branches/api" remote-root="data" option-label="name" option-value="id" choices/>
        <x-splade-select choices :label="__('Type')" name="type" type="text"  :placeholder="__('Type')">
            <option value="in">{{__('In')}}</option>
            <option value="out">{{__('Out')}}</option>
        </x-splade-select>

        <div class="flex justify-start gap-2 pt-3">
            <x-tomato-admin-submit label="{{__('Save')}}" :spinner="true" />
            <x-tomato-admin-button type="button" secondary @click.prevent="modal.close" label="{{__('Cancel')}}"/>
        </div>
    </x-splade-form>
</x-tomato-admin-container>
