<!-- {{$debugpath}} -->

<div class="blog-wrapper">
    <article>
        <figure class="image-wrapper image-2-3">
            <img class="image" src="{{ asset('img/blog/'.$blog->images[0]->file)}}" alt="Logo {{ $globals->title }}">
        </figure>

        <div class="text">
            <h2>{{$blog->title}}</h2>
            <p><small>Posted by <b>{{$blog->Author->name}}</b> at <b>{{$blog->created_at}}</b></small></p>
            <p>{{$blog->content}}</p>
        </div>
    </article>
</div>