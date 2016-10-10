<!-- {{$debugpath}} -->

<div class="blog-wrapper">
	
	@foreach($blog as $post)
		<article>
			<h2>{{$post}}</h2>
			<p>{{$post->content}}</p>
			<p><small>Posted by <b>{{$post->Author->name}}</b> at <b>{{$post->created_at}}</b></small></p>
		</article>
	@endforeach

	{{$blog->links()}}
</div>