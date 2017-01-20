<!-- {{$debugpath}} -->

{!! Form::open(['method' => 'post', 'class' => 'detailpage detailpage-contact changed']) !!}
    <fieldset>
        <ul class="velden">
            <li class="form-input-textfield" data-icon="V">
                @include('forms.inputerror')
                {!! Form::text('phone',isset($page_content['getContact']->phone) ? $page_content['getContact']->phone : '' ,array_merge(['placeholder' => Lang::get('tinymce.detailpage-foodstand-phone')])) !!}
            </li>
            <li class="form-input-textfield" data-icon="e">
                @include('forms.inputerror')
                {!! Form::email('email',isset($page_content['getContact']->email) ? $page_content['getContact']->email : '' ,array_merge(['placeholder' => Lang::get('tinymce.detailpage-foodstand-email')])) !!}
            </li>
            <li class="form-input-textfield" data-icon="3">
                @include('forms.inputerror')
                {!! Form::url('site',isset($page_content['getContact']->site) ? $page_content['getContact']->site : '' ,array_merge(['placeholder' => Lang::get('tinymce.detailpage-foodstand-site')])) !!}
            </li>
            <li class="form-input-textfield" data-icon="f">
                @include('forms.inputerror')
                {!! Form::url('facebook',isset($page_content['getContact']->facebook) ? $page_content['getContact']->facebook : '' ,array_merge(['placeholder' => Lang::get('tinymce.detailpage-foodstand-facebook')])) !!}
            </li>
            <li class="form-input-textfield" data-icon="l">
                @include('forms.inputerror')
                {!! Form::url('twitter',isset($page_content['getContact']->twitter) ? $page_content['getContact']->twitter : '' ,array_merge(['placeholder' => Lang::get('tinymce.detailpage-foodstand-twitter')])) !!}
            </li>
            <li class="form-input-textfield" data-icon="g">
                @include('forms.inputerror')
                {!! Form::url('linkedin',isset($page_content['getContact']->linkedin) ? $page_content['getContact']->linkedin : '' ,array_merge(['placeholder' => Lang::get('tinymce.detailpage-foodstand-linkedin')])) !!}
            </li>
        </ul>
    </fieldset>
{!! Form::close() !!}