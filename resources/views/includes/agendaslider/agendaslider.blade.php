<!-- {{$debugpath}} -->
<div id="js-agenda-scroller">
    <section class="page-timeline" id="timeline">
        <h2>
            {_ 'Bekijk de planning van het project'}
            <span class="slider-prev heading-btn" id="js-timeline-prev" data-icon="o"></span>
            <span class="slider-next heading-btn" id="js-timeline-next" data-icon="m"></span>
        </h2>

        <div class="timeline-scroller" id="js-timeline-scroller" data-current-year="{$smarty.now|date_format:'%Y'|escape}">
            {foreach $timeline_items as $timeline_item}
            {render object=$timeline_item}
            {/foreach}
            {* Add two more items for extra spacing *}
            <div class="timeline-item last-item"></div>
            <div class="timeline-item last-item"></div>
        </div>
    </section>
</div>
