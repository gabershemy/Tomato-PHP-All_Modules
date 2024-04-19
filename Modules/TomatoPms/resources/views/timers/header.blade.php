@php
 $activeTimer = \Modules\TomatoPms\App\Models\Timer::where('employee_id', auth('web')->user()->id)->where('is_done', '!=', 1)->first();
@endphp

@if($activeTimer)
<x-splade-link modal :href="route('admin.timers.edit', $activeTimer->id)" class="flex flex-col justify-center items-center mx-4">
    <span class="font-mono text-md">
      <span style="--value:5;" id="d"></span>:
      <span style="--value:10;" id="h"></span>:
      <span style="--value:24;" id="m"></span>:
      <span style="--value:53;" id="s"></span>
    </span>
</x-splade-link>

<x-splade-script>
    var countDownDate = new Date('{{ $activeTimer->start_at->toDateTimeString() }}');

    // Update the count down every 1 second
    var x = setInterval(function() {

    // Get todays date and time
    var now = new Date().getTime();

    // Find the distance between now an the count down date
    var distance = now - countDownDate.getTime();

    // Time calculations for days, hours, minutes and seconds
    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);

    // Output the result in an element with id="demo"
    document.getElementById("d").innerHTML = days + "d ";
    document.getElementById("h").innerHTML = hours + "h ";
    document.getElementById("m").innerHTML = minutes + "m " ;
    document.getElementById("s").innerHTML = seconds + "s ";
    }, 1000);
</x-splade-script>
@endif
