<!-- {{$debugpath}} -->
<div class="article-content-container">
	<h2>{{ Lang::get('aboutpage.title') }}</h2>

	<div class="comp-alinea intro">
		<p class="intro">{{ Lang::get('aboutpage.intro') }}</p>
	</div>	

	<div class="comp-alinea">
		<h2>{{ Lang::get('aboutpage.alinea1_title') }}</h2>

		<p>{!! nl2br(e(Lang::get('aboutpage.alinea1'))) !!}</p>
	</div>	

	<div class="comp-alinea">
		<h2>{{ Lang::get('aboutpage.alinea2_title') }}</h2>

		<p>{!! nl2br(e(Lang::get('aboutpage.alinea2'))) !!}</p>
	</div>	

	<div class="image-wrapper image-1-5">
		<img src="{{ asset('img/articles/event-overview.jpg') }}" alt="Event TastyMatch">
	</div>
</div>