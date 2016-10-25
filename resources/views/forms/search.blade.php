<!-- {{$debugpath}} -->
<form class="page-searchbox" id="js-page-searchbox" method="get" action="{{url('/search')}}" itemprop="potentialAction" itemscope itemtype="http://schema.org/SearchAction">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta itemprop="target" content=""/>
    <input  class="form-control" id="search-bar" type="search" name="q" value="{{ old('q') }}" placeholder="{{ Lang::get('forms.searchplaceholder') }}" itemprop="query-input">
    <button id="js-search-trigger" type="submit" data-icon="y"></button>
</form>