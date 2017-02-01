<!-- {{$debugpath}} -->
    {!! Form::open(['method' => 'post', 'class' => 'form-filter webbeheer-formulier']) !!}
        <fieldset>
        	<ul class="velden">
        		<li class="form-label">
					<span>{{ Lang::get('daterangepicker.label') }}:</span>
				</li>	


        		<li class="form-input-textfield" data-icon="V">
        			@include('forms.inputerror')
        			{!! Form::text('daterange', '') !!}
        		</li>	
        	</ul>	
        </fieldset>	
    {!! Form::close() !!}