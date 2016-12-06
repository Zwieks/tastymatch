<form method="get" id="js-search-filter" class="form-filter webbeheer-formulier" itemprop="potentialAction" itemscope itemtype="http://schema.org/SearchAction">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta itemprop="target" content=""/>
    <fieldset>
        <ul class="velden">
            <li class="form-label">
                <span>{{ Lang::get('googlemaps.filter-show') }}:</span>
            </li>

            <li class="form-input-checkbox">
                <input class="checkbox checkboxfilter" type="checkbox" value="events" name="filter_type" id="filter-0" checked>
                <label for="filter-0">{{ Lang::get('products.product-events') }}</label>
            </li>

            <li class="form-input-checkbox">
                <input class="checkbox checkboxfilter" type="checkbox" value="foodstands" name="filter_type" id="filter-1" checked>
                <label for="filter-1">{{ Lang::get('products.product-foodstands') }}</label>
            </li>

            <li class="form-input-checkbox">
                <input class="checkbox checkboxfilter" type="checkbox" value="entertainers" name="filter_type" id="filter-2" checked>
                <label for="filter-2">{{ Lang::get('products.product-entertainers') }}</label>
            </li>
        </ul>
    </fieldset>
</form>