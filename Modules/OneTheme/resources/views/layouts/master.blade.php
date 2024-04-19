@include('one-theme::layouts.includes.header')
<div>
    @yield('content')

    <x-splade-script>
        if(localStorage.getItem("splade") && typeof document !== undefined){
        let spladeStorage = JSON.parse(localStorage.getItem("splade"));
        let dark = spladeStorage?.admin?.dark;
        document.body.classList[dark ? "add" : "remove"]("dark-scrollbars");
        document.documentElement.classList[dark ? "add" : "remove"]("dark");
        let htmlEl = document.querySelector("html");

        if ("{{app()->getLocale()}}" === "ar") {
        htmlEl.setAttribute("dir", "rtl");
        } else {
        htmlEl.setAttribute("dir", "ltr");
        }
        }
    </x-splade-script>
</div>
@include('one-theme::layouts.includes.footer')

