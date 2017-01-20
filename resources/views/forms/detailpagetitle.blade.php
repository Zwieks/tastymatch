<!-- {{$debugpath}} -->
{!! Form::open(['method' => 'post', 'class' => 'detailpage detailpage-title changed']) !!}
    <fieldset>
        <ul class="velden">
            <li class="form-input-textfield">
                @include('forms.inputerror')
                {!! Form::text('title',isset($page_content['getIntro']->name) ? $page_content['getIntro']->name : '' ,array_merge(['placeholder' => Lang::get('tinymce.detailpage-foodstand-title')])) !!}
            </li>
        </ul>
    </fieldset>
{!! Form::close() !!}