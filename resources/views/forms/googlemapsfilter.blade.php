<form class="google-maps-filter webbeheer-formulier">
	<fieldset>
		<ul class="velden">
			<li class="form-label">
				<span>{{ Lang::get('googlemaps.filter-show') }}:</span>
			</li>	

	        <li class="form-input-checkbox">
	            <input class="checkbox" type="checkbox" value="1" name="filter" id="filter-1" checked>
	            <label for="filter-1">{{ Lang::get('products.product-events') }}</label>
	        </li>

	        <li class="form-input-checkbox">
	            <input class="checkbox" type="checkbox" value="1" name="filter" id="filter-1" checked>
	            <label for="filter-1">{{ Lang::get('products.product-foodstands') }}</label>
	        </li>

	       	<li class="form-input-checkbox">
	            <input class="checkbox" type="checkbox" value="1" name="filter" id="filter-1" checked>
	            <label for="filter-1">{{ Lang::get('products.product-entertainers') }}</label>
	        </li>
		</ul>	
	</fieldset>
</form>