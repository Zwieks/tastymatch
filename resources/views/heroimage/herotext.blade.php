<!-- {{$debugpath}} -->
<article class="site-info-wrapper">
    @hasSection('heroimagetitle')
        <h2 class="site-info-title"> @yield('heroimagetitle')</h2>
    @else
        <h2 class="site-info-title">{{ Lang::get('hero.page-register-title') }} <span>{{ Lang::get('basicpage.name') }}</span></h2>
    @endif

    @hasSection('heroimagetitle')
        <p class="site-info-text">@yield('heroimagetext')</p>
    @else
        <p class="site-info-text">{{ Lang::get('hero.page-register-text') }}</p>
    @endif
</article>