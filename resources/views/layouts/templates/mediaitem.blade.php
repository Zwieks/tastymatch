<!-- {{$debugpath}} -->
<div class="media">
    <div class="product-wrapper">

        <figure data-toggle="modal" data-target="#modal-media" data-content="{{ ( $data['video'] != '' ? $data['video'] : URL::asset('storage/'.$data['image'])) }}" data-type="{{ ( $data['video'] != '' ? 'video' : 'image' ) }}" class="{{ ( $data['video'] != '' ? 'youtube-playbtn' : 'image-wrapper' )}}">

            @if($data['video'] != '')
                <?php
                    preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $data['video'], $match);
                    $youtube_id = $match[1];
                ?>
                <div class="ytp-thumbnail-overlay"></div>   
                <img src="https://img.youtube.com/vi/{{$youtube_id}}/hqdefault.jpg"/>
            @else
                <img src="{{ URL::asset('storage/app/public/'.$data['image']) }}" alt=""/>
            @endif
        </figure> 

        <p>{!! html_entity_decode($data['content']) !!}</p>  
    </div>
</div>