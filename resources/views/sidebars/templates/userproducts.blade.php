<!-- {{$debugpath}} -->
@if(Auth::check())
    <section class="page-userproducts">
        <h2 class="sidebar-title">{{ Lang::get('menus.userproducts-title') }}</h2>
        <ul class="userproducts-items">
            <li>
                <a class="userproducts-item" href="/" data-icon="G">Mr Beenham</a>
            </li>
        </ul>
    </section>
@endif