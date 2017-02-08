<!-- {{$debugpath}} -->
{{--Modal HEADER--}}
<div class="modal-header">
	<h2 class="modal-title" id="favoritesModalLabel">{{ Lang::get('agenda.modal-agenda-create-title') }}</h2>
	<button type="button" class="modal-close" data-dismiss="modal" aria-label="Close" data-icon="k">
		<span aria-hidden="true"></span>
	</button>
</div>

{{--Modal BODY--}}
<div class="modal-body">
	@include('forms.modalcreateagendaitem')
</div>

{{--Modal FOOTER--}}
<div class="modal-footer">
	<button type="button" class="btn btn-primary js-add-agenda-item">{{ Lang::get('buttons.create') }}</button>
	<button type="button" class="btn btn-default" data-dismiss="modal">{{ Lang::get('buttons.cancel') }}</button>
</div>