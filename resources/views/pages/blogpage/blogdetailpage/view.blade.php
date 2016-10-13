<!-- {{$debugpath}} -->
<div class="single-blog-wrapper">
    <article>
        <h2 class="single-blog-title">{{$blog->title}}</h2>
        <p><small>{{ Lang::get('blogpage.meta-postedby') }} <b>{{$blog->Author->name}}</b> {{ Lang::get('blogpage.meta-time') }} <b>{{date('F d, Y', strtotime($blog->created_at))}}</b></small></p>

        @if(isset($blog->content[0]))
            <div class="comp-alinea intro">
                <p class="intro">{{$blog->content[0]}}</p>
            </div>
        @endif

        @if(isset($blog->images[0]))
            <figure class="image-wrapper image-1-2">
                <img class="image" src="{{ asset('img/blog/'.$blog->images[0]->file)}}" alt="Logo {{ $globals->title }}">
            </figure>
        @endif

        @if(isset($blog->content[1]))
            <div class="comp-alinea">
                <p>{!! nl2br(($blog->content[1])) !!}</p>
            </div>
        @endif

        @if(isset($blog->images[1]))
            <figure class="image-wrapper image-1-2">
                <img class="image" src="{{ asset('img/blog/'.$blog->images[0]->file)}}" alt="Logo {{ $globals->title }}">
            </figure>
        @endif
    </article>

    @if(isset($blog->comments[0]))
        <div class="comments-wrapper">
            @foreach($blog->comments as $comment)
                <p class="comment-text">{{$comment->comment}}</p>
            @endforeach
        </div>
     @endif
</div>