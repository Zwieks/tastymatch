<!-- {{$debugpath}} -->

{{-- HEADERIMAGE MODULE--}}
<div id="component-headerimage" class="dropzone-wrapper">
    <form method="POST" action="{{url('ajax/upload')}}" class="webbeheer-formulier dropzone" id="DropzoneElementIdHeader" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        {{ Form::hidden('pageid', $detailpage_id ) }}
    </form>
</div>

<div class="editable-wrapper">
    {{-- INTRO MODULE--}}
    <div class="intro">
        <div id="component-intro" class="product-wrapper">
            @include('forms.detailpagetitle')

            <div id="js-editable-intro" class="content editable">
                <p class="editable-default">{{ Lang::get('tinymce.detailpage-foodstand-description') }}</p>
            </div>
        </div>
    </div>

    <div class="details-wrapper">
        {{-- CONTACT MODULE--}}
        <div id="component-contact" class="details product-wrapper">
            <h2>{{ Lang::get('tinymce.detailpage-foodstand-contact-intro')  }}</h2>
            <div id="js-editable-contact" class="content editable">
               <p class="editable-default">{{ Lang::get('tinymce.detailpage-foodstand-contact-description') }}</p>
            </div>

            @include('forms.detailpagecontact')
        </div>

        {{-- ADDITIONAL DETAIL MODULE--}}
        @include($additionaldetail)

        {{-- DETAIL MODULE--}}
        @include($detail)
    </div>
</div>

{{-- MEDIA ITEMS MODULE--}}
<div id="js-editable-wrapper">
    <div class="editable-wrapper mediaitems-wrapper">
        @foreach($page_content['getMediaItems'] as $key => $item)
            @include('layouts.templates.update-mediaitem', array('data'=> $key ))
        @endforeach
    </div>
</div>
<div id="js_add_mediaitem" class="add-media-item-wrapper">
     <div class="add-media-item">
        <div class="media add-item">
            <div class="product-wrapper" data-icon="Z" title="Voeg een nieuw mediablok toe">
                <div class="add-media-outline"></div>
            </div>
        </div>
    </div>
</div>

{{--Render GoogleMaps --}}
@include($googlemaps)