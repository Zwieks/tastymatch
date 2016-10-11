<!-- {{$debugpath}} -->

<div class="blog-wrapper">
	
	@foreach($blog as $post)
        <article class="blog-preview">
            <a href="blog/{{$post->slug}}" title="{{$post->title}}" class="blog-item-link">
                <figure class="image-wrapper image-2-3">
                    <img class="image" src="{{ asset('img/blog/'.$post->images[0]->file)}}" alt="Logo {{ $globals->title }}">
                </figure>

                <div class="text">
                    <h2 class="blog-preview-title">{{$post->title}}</h2>
                    <p class="date"><small>Posted by <b>{{$post->Author->name}}</b> at <b>{{$post->created_at}}</b></small></p>
                    <p>{{ str_limit($post->content, 180) }}</p>
                    <span class="readmore">Lees verder</span>
                </div>
            </a>
        </article>
	@endforeach

	{{$blog->links()}}
</div>