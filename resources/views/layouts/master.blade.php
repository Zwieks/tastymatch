<!DOCTYPE html>
    <html lang='{{$locale}}' itemscope itemtype= @if ($type === 'homepage'){{"http://schema.org/WebSite"}} @else {{"http://schema.org/WebPage"}} @endif>
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">

            @include('pages.basicpage.page-meta')
<!--             {render style='head-socials'}
            {render style='head-link'} -->
    </head>

    <body>
        <header>
            @include('includes.header')
        </header>

        <main>
            <div class="inner">
                Hello, {{$type}}
               The current UNIX timestamp is {{{ time() }}}.
                @yield('content')
            </div>    
        </main>

        <footer>
            @include('includes.footer')
        </footer>
    </body>
</html>

