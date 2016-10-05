<!-- {{$debugpath}} -->

<div class="contact-wrapper">
	<div class="contact-logo-wrapper">

	</div>	

	<section class="contact-info-wrapper">
		<h2 class="contact-info-title">{{ Lang::get('contactpage.title') }}:</h2>

		<div class="contact-items-wrapper">

			<div class="contact-items">
				<h3>{{ Lang::get('contactpage.subtitle_business') }}</h3>
				<dl>
					<dt>{{ Lang::get('forms.chamberofcommerce') }}:</dt><dd>{{ $globalinfo[0]->kvk }}</dd>
					<dt>{{ Lang::get('forms.valueaddedtax') }}:</dt><dd>{{ $globalinfo[0]->kvk }}</dd>
					<dt>{{ Lang::get('forms.iban') }}:</dt><dd>{{ $globalinfo[0]->kvk }}</dd>
					<dt>{{ Lang::get('forms.bic') }}:</dt><dd>{{ $globalinfo[0]->kvk }}</dd>
				</dl>
			</div>	

			<div class="contact-items">
				<h3>{{ Lang::get('contactpage.subtitle_mail') }}</h3>
				<dl>
					<dt>{{ Lang::get('forms.support') }}:</dt><dd><a href="mailto:{{ $globalinfo[0]->email }}" title="">{{ $globalinfo[0]->email }}</a></dd>
					<dt>{{ Lang::get('forms.sales') }}:</dt><dd><a href="mailto:{{ $globalinfo[0]->email }}" title="">{{ $globalinfo[0]->email }}</a></dd>
					<dt>{{ Lang::get('forms.billing') }}:</dt><dd><a href="mailto:{{ $globalinfo[0]->email }}" title="">{{ $globalinfo[0]->email }}</a></dd>
				</dl>		
			</div>	
		</div>	

		<div class="contact-items-wrapper">
			<article class="contact-text-wrapper">
				<h3>{{ Lang::get('contactpage.remainder') }}</h3>
				<p>{{ Lang::get('contactpage.remaindertext') }}: <a href="mailto:{{ $globalinfo[0]->email }}" title="">{{ $globalinfo[0]->email }}</a></p>
			</article>
		</div>	
	</section>		
</div>