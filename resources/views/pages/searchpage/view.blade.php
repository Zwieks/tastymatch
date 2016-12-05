<!-- {{$debugpath}} -->

<div class="search-wrapper">
    @if($results != '')

        <section class="search-intro">
            <h2>{{ Lang::get('search.page-title') }}</h2>
            <p>{{ Lang::get('search.page-subtitle-part1') }}<strong> "{{ $search }}"</strong>. {{ Lang::get('search.page-subtitle-part2') }}</p>
        </section>

        {{--Render the most viewed event items--}}
        @foreach($results as $key => $result)
            @if(!empty($result) && !isset($result->keyword) && !strpos($key, 'keywords'))
                @include('pages.homepage.templates.overview', ['object' => json_encode($result), 'title' => $key ])
            @endif
        @endforeach
    @endif
</div>