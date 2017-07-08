<!-- {{$debugpath}} -->
{{--Modal HEADER--}}
<div class="modal-header">
	<span class="print-btn js-pageprint" data-icon="8" title="{{ Lang::get('modal.modal-direction-title-hover') }}"></span>
	<h2 class="modal-title">{{ Lang::get('modal.modal-direction-title') }}</h2>
	<button type="button" class="modal-close" data-dismiss="modal" aria-label="Close" data-icon="k">
		<span aria-hidden="true"></span>
	</button>
</div>

{{--Modal BODY--}}
<div id="route-description" class="modal-body">
	<img class="logo-print" src="{{ asset('img/logo.png') }}" alt="Logo {{ $globals->title }}">
	<ul id="route-description-wrapper"></ul>
</div>