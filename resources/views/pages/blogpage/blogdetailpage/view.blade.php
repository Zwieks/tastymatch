<!-- {{$debugpath}} -->
<div class="single-blog-wrapper">
    <article>
        <h2 class="single-blog-title">{{$blog->title}}</h2>
        <p><small>{{ Lang::get('blogpage.meta-postedby') }} <b>{{$blog->Author->name}}</b> {{ Lang::get('blogpage.meta-time') }} <b>{{date('F d, Y', strtotime($blog->created_at))}}</b></small></p>

        <div class="comp-alinea intro">
            <p class="intro">{{$blog->content[0]}}</p>
        </div>    

        <figure class="image-wrapper image-1-2">
            <img class="image" src="{{ asset('img/blog/'.$blog->images[0]->file)}}" alt="Logo {{ $globals->title }}">
        </figure>

        <div class="comp-alinea">
            <p>{{$blog->content[1]}}</p>
        </div>

        <div class="comp-alinea">
            <p>{{$blog->content[2]}}</p>
        </div>  

        <div class="comp-alinea">
            <p>{{$blog->content[3]}}</p>
        </div> 

        <div class="comp-alinea">
            <p>{{$blog->content[4]}}</p>
        </div>    

        <figure class="image-wrapper image-1-2">
            <img class="image" src="{{ asset('img/blog/'.$blog->images[0]->file)}}" alt="Logo {{ $globals->title }}">
        </figure>                          
    </article>

    @if(isset($blog->comments[0]))
        <div class="comments-wrapper">
            @foreach($blog->comments as $comment)
                <p class="comment-text">{{$comment->comment}}</p>
            @endforeach
        </div>
     @endif
</div>