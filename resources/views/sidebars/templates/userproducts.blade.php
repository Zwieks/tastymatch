<!-- {{$debugpath}} -->

@if(Auth::check())
    @if( !empty($user->foodstands))
        <section class="page-userproducts">
            <h2 class="sidebar-title">{{ Lang::get('menus.userfoodstands-title') }}</h2>
            <ul class="userproducts-items">
                @foreach($user->foodstands as $foodstand)
                    <li>
                        <a class="userproducts-item" href="/" data-icon="G"> {{$foodstand->name}}</a>
                    </li>
                @endforeach  
            </ul>
        </section>
    @endif  

    @if( !empty($user->entertainers))
        <section class="page-userproducts">
            <h2 class="sidebar-title">{{ Lang::get('menus.userentertainers-title') }}</h2>
            <ul class="userproducts-items">
                @foreach($user->entertainers as $entertainer)
                    <li>
                        <a class="userproducts-item" href="/" data-icon="a"> {{$entertainer->name}}</a>
                    </li>
                @endforeach  
            </ul>
        </section>
    @endif  

    @if( !empty($user->events))
        <section class="page-userproducts">
            <h2 class="sidebar-title">{{ Lang::get('menus.userevents-title') }}</h2>
            <ul class="userproducts-items">
                @foreach($user->events as $event)
                    <li>
                        <a class="userproducts-item" href="/" data-icon="z"> {{$event->name}}</a>
                    </li>
                @endforeach  
            </ul>
        </section>
    @endif  
@endif