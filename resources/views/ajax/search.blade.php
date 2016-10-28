<!-- {{$debugpath}} -->
@if($results != '')
    <li class="ajax-search-item">
        @foreach ($results as $order)
            {{ $order->name }}
        @endforeach
    </li>
@else
    <li class="ajax-search-item">
       <a href="/zoeken" class="btn">Zoeken</a>
    </li>
@endif
