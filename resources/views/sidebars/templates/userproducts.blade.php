<!-- {{$debugpath}} -->
@if(Auth::check())
    @if( !empty($user->foodstands) || !empty($user->entertainers) || !empty($user->events))
        @if( !empty($user->foodstands))
            <section class="page-userproducts">
                <h2 class="sidebar-title">{{ Lang::get('menus.userfoodstands-title') }}</h2>
                <ul class="userproducts-items">
                    @foreach($user->foodstands as $foodstand)
                        <li>
                            <a class="userproducts-item" href="/foodstand/{{ $foodstand->slug }}">
                                <figure class="image-wrapper image-2-3">
                                    <img class="image" src='/img/uploads/{{ $foodstand->images->first()['file'] }}'/>
                                </figure>  
                                <h3>{{ $foodstand->name }}</h3>  
                           </a>
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
                            <a class="userproducts-item" href="/entertainer/{{ $entertainer->slug }}">
                                <figure class="image-wrapper image-2-3">
                                    <img class="image" src='/img/uploads/{{ $entertainer->images->first()['file'] }}'/>
                                </figure>
                                <h3>{{ $entertainer->name }}</h3> 
                            </a>
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
                            <a class="userproducts-item" href="/event/{{ $event->slug }}">
                                <figure class="image-wrapper image-2-3">
                                    <img class="image" src='/img/uploads/{{ $event->images->first()['file'] }}'/>
                                </figure>
                                <h3>{{ $event->name }}</h3>  
                            </a>
                        </li>
                    @endforeach  
                </ul>
            </section>
        @endif  
    @else
        <section class="page-userproducts">
            <h2 class="sidebar-title">Geen producten gevonden.</h2>
            <p class="sidebar-text">Je hebt nog geen product aangemaakt.</p>
        </section>    
    @endif  
@endif