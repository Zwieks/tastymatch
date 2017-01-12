<!-- {{$debugpath}} -->
<form class="detailpage detailpage-title" method="POST">
    <fieldset>
        <ul class="velden">
            <li class="form-input-textfield">
                @include('forms.inputerror')
                <input placeholder="{{ Lang::get('tinymce.detailpage-foodstand-title') }}" type="text" name="title">
            </li>
        </ul>
    </fieldset>
</form>