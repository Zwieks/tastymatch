<!-- {{$debugpath}} -->
<!DOCTYPE html>
    <html lang='{{$locale}}' itemscope itemtype= @if($type === 'homepage') "http://schema.org/WebSite" @else "http://schema.org/WebPage" @endif>
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">

        @include('pages.basicpage.head-meta')
        @include('pages.basicpage.head-socials')

        <link rel="stylesheet" href="{{ URL::asset('css/app.css') }}" >
        <link rel="stylesheet" href="{{ URL::asset('css/fontstyle.css') }}" >
        <link rel="stylesheet" href="{{ URL::asset('css/CustomScrollbar.css') }}" />
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700,300,600' rel='stylesheet' type='text/css'>
        
        <title>@yield('title')</title>
    </head>

    <body @if (Request::path() === '/') itemscope itemtype="http://schema.org/WebSite"@endif class="component-@yield('type')@hasSection('heroimage') has-bgimage @endif @if(Auth::check())logedin @endif preload">
       <!--  heading for document outline  -->
        <h2 class="hide-from-layout">@yield('title')</h2>

        <!-- Responsive navigation trigger -->
        <input type="checkbox" id="js-nav-trigger" class="nav-trigger">

        @include('includes.header')

        <div class="page-website-wrapper">
            @include('pages.basicpage.wrapper')
            @include('includes.footer')
        </div>

        @hasSection('sticky-content')
            @yield('sticky-content')
        @endif

        <div class="page-mobile-nav-container">
            <label class="nav-toggle" id="js-nav-toggle" for="js-nav-trigger"><span class="wrapper"><span></span></span><strong>{_ 'Menu'}</strong></label>
            <div class="nav-wrapper" id="js-nav-wrapper"></div>
            <div class="nav-closer" id="js-nav-closer"></div>
        </div>

        <!-- JAVASCRIPT -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
        {{--render style='add-to-bottom'--}}
       {{--render style='google-analytics'--}}
        @include('pages.basicpage.scripts')
        @yield('page-scripts')

        @hasSection('modal')
            @yield('modal')
        @endif    
    </body>
</html>