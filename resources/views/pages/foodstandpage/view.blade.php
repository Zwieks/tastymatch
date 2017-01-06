<!-- {{$debugpath}} -->
<div id="component-headerimage" class="dropzone-wrapper">
    <form method="POST" action="{{url('ajax/upload')}}" class="webbeheer-formulier dropzone" id="DropzoneElementIdHeader" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
    </form>
</div>

<div class="editable-wrapper">
    <div class="intro">

        <div id="component-title">
            <div id="js-editable-title" class="content editable product-wrapper pagetitle">
                <h2 id="js-page-title" class="editable-default">{{ Lang::get('tinymce.detailpage-foodstand-title') }}</h2>
            </div>
        </div>

        <div id="component-intro">
            <div id="js-editable-intro" class="content editable product-wrapper">
                <p class="editable-default">{{ Lang::get('tinymce.detailpage-foodstand-description') }}</p>
            </div>
        </div>
    </div>

    <div class="details-wrapper">
        <div id="component-details" class="details product-wrapper">
            <h2>{{ Lang::get('tinymce.detailpage-foodstand-contact-intro')  }}</h2>


           <div id="js-editable-contact" class="content editable">
               <p class="editable-default">{{ Lang::get('tinymce.detailpage-foodstand-contact-description') }}</p>
            </div>

            @include('forms.detailpagecontact')
        </div>

        <div id="component-menu" class="menu">
            <div id="js-editable-menu" class="content editable product-wrapper foodstand-menu-items">
                <h2>Menu</h2>
                <ul class="editable-default">
                   <li>
                       <p>Vul hier je menu items in</p>
                   </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div id="js-editable-wrapper">
    <div class="editable-wrapper mediaitems-wrapper">
        @include('layouts.templates.empty-mediaitem')
    </div>
</div>
<div id="js_add_mediaitem" class="add-media-item-wrapper">
  <div class="add-media-item">
    <div class="media">
      <div class="product-wrapper" data-icon="Z" title="Voeg een nieuw mediablok toe">
        <div class="add-media-outline"></div>
      </div>
    </div>

  </div>
</div>

{{--Render GoogleMaps --}}
@include('includes.googlemaps.single-googlemap')