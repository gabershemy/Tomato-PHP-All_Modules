<x-tomato-admin-layout>
    <x-slot:header>
        File Browser
    </x-slot:header>
    <x-slot:buttons>
        <div class="flex justify-start gap-2">
            <x-tomato-admin-button
                method="POST"
                :data="[
                'filePath'=> $current_path
              ]"
                href="{{route('admin.browser.upload')}}"
            >
                {{__('Upload File')}}
            </x-tomato-admin-button>
            <x-tomato-logout />
        </div>
    </x-slot:buttons>

    <x-splade-data default="{

    }">
        <div class="flex justify-start space-x-2">
            <x-tomato-admin-button
                title="{{__('Home')}}"
                type="icon"
                href="{{route('admin.browser.index')}}"
            >
                <x-heroicon-s-home class="w-6 h-6" />
            </x-tomato-admin-button>
            @if(isset($history) && $history['back_path'] !== base_path())
                <x-tomato-admin-button
                    warning
                    type="icon"
                    href="{{route('admin.browser.index')}}"
                    method="POST"
                    :data="[
                        'folder_path'=> $history['back_path'],
                        'folder_name'=> $history['back_name'],
                        'type'=>'back',
                    ]">
                    <x-heroicon-s-arrow-left class="w-6 h-6" />
                </x-tomato-admin-button>
            @endif
            @if(isset($path) && isset($ex) && $ex)
                <x-tomato-admin-button
                    title="{{__('Delete File')}}"
                    danger
                    type="icon"
                    confirm href="{{route('admin.browser.destroy')}}" method="DELETE" :data="[
                        'path'=>$path,
                    ]"

                >
                    <x-heroicon-s-trash class="w-6 h-6" />
                </x-tomato-admin-button>
            @endif
        </div>
        @if(isset($file) && $file)
            @if(
                isset($ex ) &&
                (
                    $ex === 'png' ||
                    $ex === 'jpg' ||
                    $ex === 'jpeg' ||
                    $ex === 'svg' ||
                    $ex === 'webp'
                )
            )
                <div class="mx-auto py-4">
                    <img src="data:image/png;base64,{{$file}}" />
                </div>
            @else
            <div class="font-sans my-4">
                <x-splade-form action="{{route('admin.browser.index')}}" method="POST" :default="[
                    'content'=> $file,
                    'path'=> $path,
                    'type'=>'save',
                ]">
                    <x-splade-input name="path" type="hidden" />
                    <x-splade-input name="type" type="hidden" />
                    <x-tomato-admin-code name="content" ex="txt" />
                    <br />

                    <x-tomato-admin-button type="button" label="{{__('Save')}}"/>
                </x-splade-form>
            </div>
            @endif
        @elseif(count($folders) || count($files))
            <div class="grid gap-1 md:grid-cols-3 sm:grid-cols-2 my-6">
                @foreach($folders as $folder)
                    <x-splade-form method="POST" action="{{route('admin.browser.index')}}" :default="[
                        'folder_path'=> $folder['path'],
                        'folder_name'=>  $folder['name'],
                        'type'=>  'folder',
                    ]">
                        <button
                            type="submit"
                            class="bg-white flex flex-col items-center justify-center w-full p-4 font-medium text-center border rounded"
                        >
                            <i
                                class="item-center text-primary-500 bx bxs-folder bx-lg"
                            ></i>
                            {{ substr($folder['name'], 0,20) }}
                        </button>
                    </x-splade-form>
                @endforeach
                @foreach($files as $file)
                    <x-splade-form preserve-scroll method="POST" action="{{route('admin.browser.index')}}" :default="[
                        'file_path'=> $file['path'],
                        'file_name'=>  $file['name'],
                        'type'=>  'file',
                    ]">
                        <button
                            type="submit"
                            class="bg-white flex flex-col items-center justify-center w-full p-4 font-medium text-center border rounded"
                        >
                            @if(
                                isset($file['ex'] ) &&
                                (
                                    $file['ex'] === 'png' ||
                                    $file['ex'] === 'jpg' ||
                                    $file['ex'] === 'jpeg' ||
                                    $file['ex'] === 'svg' ||
                                    $file['ex'] === 'webp'
                                )
                            )
                                <i class="item-center text-primary-500 bx bxs-image bx-lg"></i>
                            @else
                                <i
                                    class="
                            item-center
                            bx
                            bx-lg
                                @if(isset($file['ex'] ) && $file['ex'] === 'md')
                                bxs-file-md
                                @elseif(isset($file['ex'] ) && $file['ex'] === 'js')
                                bxs-file-js
                                @elseif(isset($file['ex'] ) && $file['ex'] === 'json')
                                bxs-file-json
                                @else
                                bxs-file
                                @endif
                            "
                                ></i>
                            @endif
                            {{ substr($file['name'], 0, 20) }}
                        </button>
                    </x-splade-form>
                @endforeach
            </div>
        @else
            <div class="px-4 py-4 text-center">
                <i
                    class="mx-auto my-2 bx bx-search bx-lg item-center text-primary-500"
                ></i>
                <h1 class="text-3xl font-bold text-center">
                    Sorry No Folders or Files!
                </h1>
            </div>
        @endif

    </x-splade-data>
</x-tomato-admin-layout>
