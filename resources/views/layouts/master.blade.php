<!DOCTYPE html>
    <html lang='{{$locale}}' itemscope itemtype= @if ($type === 'homepage'){{"http://schema.org/WebSite"}} @else {{"http://schema.org/WebPage"}} @endif>
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">

        @include('pages.basicpage.head-meta')
        @include('pages.basicpage.head-socials')

        <link rel="stylesheet" href="{{ URL::asset('css/app.css') }}" />

        <title>@yield('title')</title>
    </head>

    <body @if (Request::path() === '/') itemscope itemtype="http://schema.org/WebSite"@endif class="component-@if(Request::path() === '/s')homepage @else{{ $type }} @endif preload">
       <!--  heading for document outline  -->
        <h2 class="hide-from-layout">@yield('title')</h2>

        <!-- Responsive navigation trigger -->
        <input type="checkbox" id="js-nav-trigger" class="nav-trigger">

        @include('includes.header')

        <div class="page-website-wrapper">
            @include('pages.basicpage.wrapper')
            @include('includes.footer')
        </div>   

        <div class="page-mobile-nav-container">
            <!-- The 'for' of the labels correspondents with the 'id' of the input below the body-tag -->
            <!-- Responsive navigation is handles with Less in the inav.less files -->
            <label class="nav-toggle" id="js-nav-toggle" for="js-nav-trigger"><span class="wrapper"><span></span></span><strong>{_ 'Menu'}</strong></label>
            <div class="nav-wrapper" id="js-nav-wrapper"></div>
            <div class="nav-closer" id="js-nav-closer"></div>
        </div>

        <!-- JAVASCRIPT -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<!--         {render style='add-to-bottom'}
        {render style='google-analytics'} -->
        @include('pages.basicpage.scripts')
        @yield('page-scripts')
    </body>
</html>

