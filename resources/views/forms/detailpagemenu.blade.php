<!-- {{$debugpath}} -->
{!! Form::open(['method' => 'post', 'class' => 'detailpage detailpage-menu changed']) !!}
    <fieldset>
        <ul class="velden">
            @if(isset($page_content['getMenu']->content))
                @foreach(explode(',', $page_content['getMenu']->content) as $item)
                    <li class="form-input-textfield">
                        @include('forms.inputerror')
                        {!! Form::text('menuitem',isset($item) ? $item : '' ,array_merge(['placeholder' => Lang::get('tinymce.detailpage-foodstand-menu')])) !!}
                    </li>
                @endforeach
            @else
                <li class="form-input-textfield">
                    @include('forms.inputerror')
                    {!! Form::text('menuitem','' ,array_merge(['placeholder' => Lang::get('tinymce.detailpage-foodstand-menu')])) !!}
                </li>
            @endif
        </ul>
    </fieldset>
{!! Form::close() !!}