<!-- {{$debugpath}} -->
<div class="media">
    <div class="product-wrapper">
        <figure>
            @if($data['video'] != '')
                <?php
                    preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $data['video'], $match);
                    $youtube_id = $match[1];
                ?>
                <img src="https://img.youtube.com/vi/{{$youtube_id}}/hqdefault.jpg"/>
            @else
                <img src="{{ URL::asset('storage/'.$data['image']) }}" alt=""/>
            @endif
        </figure> 

        <p>{!! html_entity_decode($data['content']) !!}</p>  
    </div>
</div>