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
            <div placeholder="Vul hier de naam van je foodstand in" id="js-editable-title" class="content editable product-wrapper pagetitle">
                <h2 id="js-page-title" class="editable-default">Vul hier de naam van je foodstand in</h2>
            </div>
        </div>

        <div id="component-intro">
            <div id="js-editable-intro" class="content editable product-wrapper">
                <p class="editable-default">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam lacus justo, cursus in mattis in, feugiat eu mauris. Phasellus quis porttitor metus. Vestibulum sed risus at lectus finibus vulputate ut eget velit. In sit amet tortor lacinia, vehicula magna ut, sagittis odio. Cras tellus urna, consequat ac porta eu, elementum eget arcu. Phasellus condimentum ante a sodales hendrerit. Sed mattis neque ac venenatis faucibus. Fusce fringilla cursus convallis. Donec et hendrerit ligula. Cras blandit ex ut augue ultrices ultrices. Praesent nisi sem, bibendum at lectus vitae, sollicitudin ultricies orci.</p>
            </div>
        </div>
    </div>

    <div class="details-wrapper">
        <div id="component-details" class="details">
            <div id="js-editable-contact" class="content editable product-wrapper">
                <h2>Neem contact met ons op</h2>
                <ul class="editable-default">
                   <li>
                      <p class="contact-intro">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam lacus justo, cursus in mattis in, feugiat eu mauris. Phasellus quis porttitor metus.</p>
                   </li>

                   <li>
                       <p data-icon="V">345345345</p>
                   </li>

                     <li>
                       <p data-icon="e">ronaldzwiers@hotmail.com</p>
                   </li>
                </ul>
            </div>
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