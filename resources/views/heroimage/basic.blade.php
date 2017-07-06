<!-- {{$debugpath}} -->
<div class="page-hero">

    @php($image_res = [320, 480, 640, 768, 896, 1024, 1280, 1366, 1680, 1920])
    <picture class="image page-hero-image">
        @if(!isset($path))
            @php($path = URL::asset('img/backgrounds/mainbg.png'))
            @php($alt = 'test')
        @endif

        @foreach($image_res as $res)
            <source media="(max-width: {{$res}}px)" srcset="{{ $path }}">
        @endforeach

        <img src="{{ $path }}" alt="{{ $alt }}">
    </picture>

    <div class="hero-content-wrapper">
        @hasSection('heroalinea')
            @yield('heroalinea')
        @endif

        @hasSection('herosearch')
            @yield('herosearch')
        @endif

        @hasSection('herobuttons')
            @yield('herobuttons')
        @endif
    </div>
</div>