<!-- {{$debugpath}} -->
<form class="detailpage detailpage-contact" method="POST">
    <fieldset>
        <ul class="velden">
            <li class="form-input-textfield" data-icon="V">
                <input placeholder="{{ Lang::get('tinymce.detailpage-foodstand-phone') }}" type="text" name="phone">
            </li>
            <li class="form-input-textfield" data-icon="e">
                <input placeholder="{{ Lang::get('tinymce.detailpage-foodstand-email') }}" type="text" name="email">
            </li>
            <li class="form-input-textfield" data-icon="3">
                <input placeholder="{{ Lang::get('tinymce.detailpage-foodstand-site') }}" type="url" name="site">
            </li>
            <li class="form-input-textfield" data-icon="f">
                <input placeholder="{{ Lang::get('tinymce.detailpage-foodstand-facebook') }}" type="url" name="facebook">
            </li>
            <li class="form-input-textfield" data-icon="l">
                <input placeholder="{{ Lang::get('tinymce.detailpage-foodstand-twitter') }}" type="url" name="twitter">
            </li>
            <li class="form-input-textfield" data-icon="g">
                <input placeholder="{{ Lang::get('tinymce.detailpage-foodstand-linkedin') }}" type="url" name="linkedin">
            </li>
        </ul>
    </fieldset>
</form>