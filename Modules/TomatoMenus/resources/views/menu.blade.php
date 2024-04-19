@php $counter = 0; @endphp
@foreach($menus as $menu)
    @if(isset($menu->children) && count($menu->children) > 0)
        <button @click.prevent="
        data.asideMenuGroup['{{str_replace(" ", "_", $menu->name)}}'] =
        !data.asideMenuGroup['{{str_replace(" ", "_", $menu->name)}}']"
                v-show="!data.makeMenuMin"
                class="flex items-center justify-between w-full px-6">
            <div class="flex items-center gap-4 text-gray-600 dark:text-gray-300">
                <p class="flex-1 text-xs font-bold tracking-wider uppercase">
                    {{ $menu->name }}
                </p>
            </div>

            <svg v-if="data.asideMenuGroup" v-show="data.asideMenuGroup['{{str_replace(" ", "_", $menu->name)}}']"
                 class="w-3 h-3 text-gray-600 transition-all dark:text-gray-300" xmlns="http://www.w3.org/2000/svg"
                 fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path>
            </svg>
            <svg v-if="data.asideMenuGroup" v-show="!data.asideMenuGroup['{{str_replace(" ", "_", $menu->name)}}']"
                 class="w-3 h-3 text-gray-600 transition-all rotate-180 dark:text-gray-300"
                 xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                 aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path>
            </svg>
        </button>
        <div>
            <ul class="mx-3 mt-2 space-y-1 text-sm"
                v-if="data.asideMenuGroup"
                v-show="data.asideMenuGroup['{{str_replace(" ", "_", $menu->name)}}'] || data.makeMenuMin ">
                @foreach($menu->children as $item)
                    <li class="filament-sidebar-item "  title="{{$item->name}}">
                        <Link
                            href="{{$item->url}}"
                            class="
                                @if($item->url === url()->current())
                                    bg-primary-500 text-white
                                @else
                                    hover:bg-gray-500/5 focus:bg-gray-500/5 dark:text-gray-300 dark:hover:bg-gray-700
                                @endif
                              flex items-center justify-center w-full gap-3 px-3 py-2 font-medium transition rounded-lg">

                            <i class="w-5 h-5 shrink-0 {{ $item->icon }}" style="font-size: 20px"></i>

                            <div class="flex flex-1" v-show="!data.makeMenuMin" style="">
                                <span>
                                    {{ $item->name }}
                                </span>
                                @if($item->badge)
                                    <span
                                        class="inline-flex items-center justify-center ml-auto rtl:ml-0 rtl:mr-auto min-h-4 px-2 py-0.5 text-xs font-medium tracking-tight rounded-xl whitespace-normal text-primary-700 bg-primary-500/10 dark:text-primary-500">
                                        {{ $item->badge }}
                                    </span>
                                @endif
                            </div>
                        </Link>
                    </li>
                @endforeach

            </ul>
        </div>
    @else
        <div>
            <ul class="mx-3 mt-2 space-y-1 text-sm">
                <li class="filament-sidebar-item ">
                    <Link
                        href="{{ $menu->url }}"
                        class="
                @if(url()->current() === $menu->url)
                    bg-primary-500 text-white
                @else
                    hover:bg-gray-500/5 focus:bg-gray-500/5 dark:text-gray-300 dark:hover:bg-gray-700
                @endif
                flex items-center justify-center gap-3 px-3 py-2 font-medium transition rounded-lg">

                    @if($menu->icon)
                        <i class="w-5 h-5 shrink-0 {{ $menu->icon }}" style="font-size: 20px"></i>
                    @endif

                    <div class="flex flex-1" v-show="!data.makeMenuMin">
                        <span>
                            {{ $menu->name }}
                        </span>
                    </div>
                    </Link>
                </li>
            </ul>
        </div>
        <div class="my-6 ml-6 border-t rtl:ml-auto rtl:mr-6 dark:border-gray-700"></div>
    @endif
    @if($counter !== count($menus)-1)
        <div class="my-6 ml-6 border-t rtl:ml-auto rtl:mr-6 dark:border-gray-700"></div>
    @endif
    @php $counter++; @endphp
@endforeach
