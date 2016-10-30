<!-- {{$debugpath}} -->
<ul class='detail-summary'>
	<li>
		<input type='hidden' value='{{$results->handelsnaam}}' name='tradename' readonly='readonly'/>
		<input type='text' value='{{$results->handelsnaam}}' name='tradename-dummy' readonly='readonly'/>
	</li>
	<li>
		<input type='hidden' value='{{$results->straat}} {{$results->huisnummer}}'  name='streetnumber' readonly='readonly'/>
		<input type='text' value='{{$results->straat}} {{$results->huisnummer}}'  name='streetnumber-dummy' readonly='readonly'/>
	</li>
	<li>
		<input type='hidden' value='{{$results->postcode}}' name='zip' readonly='readonly'/>
		<input type='text' value='{{$results->postcode}}' name='zip-dummy' readonly='readonly'/>
	</li>
	<li>
		<input type='hidden' value='{{$results->plaats}}' name='city' readonly='readonly'/>
		<input type='text' value='{{$results->plaats}}' name='city-dummy' readonly='readonly'/>
	</li>
</ul>