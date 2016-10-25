<!-- {{$debugpath}} -->
@if($results != '')
    <li class="ajax-search-item">
        {{$results}}
    </li>
@else
    <li class="ajax-search-item">
       <a href="/zoeken" class="btn">Zoeken</a>
    </li>
@endif
