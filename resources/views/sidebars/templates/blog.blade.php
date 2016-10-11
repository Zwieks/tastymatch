<!-- {{$debugpath}} -->
<?php $blog = $blog->sortBy('views', SORT_REGULAR, true); ?>

<section class="explanation-wrapper">
	<h2>Meest gelezen</h2>
	<ul class="most-populair-blogs-wrapper">
	    @foreach($blog->slice(0, 4) as $post)
			<li class="most-populair-blogs-item">
				<a href="blog/{{$post->slug}}" title="{{$post->title}}" class="blog-item-link">
					<figure class="image-wrapper image-2-3">
	                    <img class="image" src="{{ asset('img/blog/'.$post->images[0]->file)}}" alt="Logo {{ $globals->title }}">
	                </figure>
	                <div class="text">
						<h3>{{$post->title}}</h3>
						<p class="date"><small>Posted by <b>{{$post->Author->name}}</b> at <b>{{$post->created_at}}</b></small></p>
	                </div>
                </a>
			</li>
	    @endforeach
    </ul>
</section>