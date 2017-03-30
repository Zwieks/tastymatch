<!-- {{$debugpath}} -->
<div class="google-maps-overlay-agenda" id="js-google-maps-overlay-agenda">
	<div class="header-wrapper">
		<h3 class='overlay-agenda-title'>{{ Lang::get('daterangepicker.overlay-title') }}:</h3>
		<button class="btn-icon-only" data-toggle='modal' data-target='#modal-daterange' data-icon="H"></button>
	</div>
	<div class="agendaitems-overview" id="js-agenda-overview"><ul class='agendaitems-wrapper'></ul></div>
	@if(isset($page_type) && ($page_type == 'update' || $page_type == 'new'))
		<div class="btn-wrapper" data-toggle="modal" data-target="#modal-form">
			<button class="add-agenda-item" data-icon="I">{{ Lang::get('buttons.add-agenda-item') }}</button>
		</div>
	@endif	
</div>