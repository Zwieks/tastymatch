<!-- {{$debugpath}} -->
<form class="detailpage detailpage-menu" method="POST">
    <fieldset>
        <ul class="velden">
            <li class="form-input-textfield">
                @include('forms.inputerror')
                <input placeholder="{{ Lang::get('tinymce.detailpage-foodstand-menu') }}" type="text" name="menuitem">
            </li>
        </ul>
    </fieldset>
</form>