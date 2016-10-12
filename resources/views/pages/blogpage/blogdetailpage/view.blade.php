<!-- {{$debugpath}} -->

<div class="blog-wrapper">
    <article>
        <figure class="image-wrapper image-2-3">
            <img class="image" src="{{ asset('img/blog/'.$blog->images[0]->file)}}" alt="Logo {{ $globals->title }}">
        </figure>

        <div class="text">
            <h2>{{$blog->title}}</h2>
            <p><small>{{ Lang::get('blogpage.meta-postedby') }} <b>{{$blog->Author->name}}</b> {{ Lang::get('blogpage.meta-time') }} <b>{{date('F d, Y', strtotime($blog->created_at))}}</b></small></p>
            <p>{{$blog->content}}</p>
        </div>
    </article>

    @if(isset($blog->comments[0]))
        <div class="comments-wrapper">
            @foreach($blog->comments as $comment)
                <p class="comment-text">{{$comment->comment}}</p>
            @endforeach
        </div>
     @endif
</div>