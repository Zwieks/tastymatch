<!-- {{$debugpath}} -->
<section class="page-agendaslider" id="agendaslider">
    <h2>
        {{ Lang::get('slider.agenda-slider-title') }}
        <span class="slider-prev heading-btn" id="js-timeline-prev" data-icon="T"></span>
        <span class="slider-next heading-btn" id="js-timeline-next" data-icon="S"></span>
    </h2>

    <div id="js-agenda-scroller">
        @foreach($user->agenda as $item )

            <article class="timeline-item">
                <div class="timeline-item-wrapper">
                    <header>
                        <h3>{{ $item->info->name }}</h3>
                        <p class="date">{{ Carbon\Carbon::parse($item->info->time_start)->format('d M Y') }} @if($item->info->time_start != $item->info->time_end &&  $item->info->time_end != null) - {{ Carbon\Carbon::parse($item->info->time_end)->format('d M Y') }}@endif</p>
                    </header>

                   <p>{{ $item->info->description }}</p>
                </div>
            </article>
        @endforeach

        <div class="timeline-item last-item"></div>
        <div class="timeline-item last-item"></div>
    </div>
</section>
