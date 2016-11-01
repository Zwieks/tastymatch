<!-- {{$debugpath}} -->
@if(Auth::check())
    <section class="page-userproducts">
        <h2 class="sidebar-title">{{ Lang::get('menus.userproducts-title') }}</h2>
        <ul class="userproducts-items">
            @foreach($user->foodstands as $foodstand)
                <li>
                    <a class="userproducts-item" href="/" data-icon="G"> {{$foodstand->name}}</a>
                </li>
            @endforeach
        </ul>
    </section>
@endif