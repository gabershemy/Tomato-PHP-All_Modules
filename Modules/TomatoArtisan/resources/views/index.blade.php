<x-tomato-admin-layout>
    <x-slot:header>
        Artisan Terminal
    </x-slot:header>
    <x-slot:buttons>
        <x-tomato-logout />
    </x-slot:buttons>

    <TomatoArtisan :commands="@js($commands)" route="{{url('/')}}" />
</x-tomato-admin-layout>
