<!-- {{$debugpath}} -->
<div id="@if(isset($data)){{'component-mediaitems-'}}{{$data}}@else{{'component-mediaitems-0'}}@endif" class="media" media="">
@if(isset($data) && $data != 0)
	<div class="js-remove-mediaitem remove-media-item" data-icon="U" title="Verwijder media item"></div>
@endif

    <div class="product-wrapper">
        <div class="editable-media-wrapper">
            <form id="@if(isset($data)){{'DropzoneElementId'}}{{$data}}@else{{'DropzoneElementId0'}}@endif" method="POST" action="{{url('ajax/upload')}}" class="webbeheer-formulier dropzone dropzoneMedia" id="@if(isset($data)){{'DropzoneElementId'}}{{$data}}@else{{'DropzoneElementId0'}}@endif" data-icon='Q' enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
            </form>
            <p id="@if(isset($data)){{'tinyMceVideoElementId'}}{{$data}}@else{{'tinyMceVideoElementId0'}}@endif" class="js-editable-video content mceNonEditable editable editable-default" data-icon='0'></p>
        </div>  

        <p id="@if(isset($data)){{'tinyMceElementId'}}{{$data}}@else{{'tinyMceElementId0'}}@endif" class="js-editable-media content editable editable-default">Plaat hier eventueel je tekst. Wanneer deze niet wordt ingevuld zal deze tekstbox niet getoond worden op de pagina.</p>
    </div>
</div>