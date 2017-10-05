<!-- {{$debugpath}} -->
<div class="media">
    <div class="product-wrapper">
        <figure data-toggle="modal" data-target="#modal-media" data-content="{{ ( isset($data['video']) && $data['video'] != '' ? $data['video'] : URL::asset('storage/app/public/'.$data['path'])) }}" data-type="{{ ( isset($data['video']) && $data['video'] != '' ? 'video' : 'image' ) }}" class="{{ ( isset($data['video']) && $data['video'] != '' ? 'youtube-playbtn' : 'image-wrapper' )}}">

            @if(isset($data['video']) && $data['video'] != '')
                <?php
                    preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $data['video'], $match);
                    $youtube_id = $match[1];
                ?>
                <div class="ytp-thumbnail-overlay"></div>   
                <img src="https://img.youtube.com/vi/{{$youtube_id}}/hqdefault.jpg"/>
            @else
                <img src="{{ URL::asset('storage/app/public/'.$data['path']) }}" alt=""/>
            @endif
        </figure> 

        @if(isset($data['content']) && $data['content'] != '')
            <p>{!! html_entity_decode($data['content']) !!}</p>
        @endif    
    </div>
</div>