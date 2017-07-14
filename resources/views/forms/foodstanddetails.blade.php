<!-- {{$debugpath}} -->
{!! Form::open(['method' => 'post', 'class' => 'detailpage detailpage-additionaldetails changed']) !!}
    <fieldset>
        <ul class="velden">
            <!-- FOODSTAND TYPE SELECT -->
            <li class="form-label">
                <span>{{ Lang::get('forms.foodstandtype') }}:</span>
            </li>
            <div class="multiple-wrapper fix-sizes">
                @php ($types = Lang::get('foodstandtypes'))

                @if(isset($page_content['getFoodstand']->foodstandtype_ids))
                    @php ($foodstandtypes_array = explode(',',$page_content['getFoodstand']->foodstandtype_ids))
                @endif    

                @foreach($types as $type)
                    <li class="form-input-checkbox">
                        <input class="radio checkboxfilter" type="checkbox" value="{{ $loop->iteration }}" name="foodstand_type" id="foodstandtype-{{ $loop->iteration }}" {{ isset($page_content['getFoodstand']->foodstandtype_ids) && in_array($loop->iteration,$foodstandtypes_array) ? 'checked' : ''}}>
                        <label for="foodstandtype-{{ $loop->iteration }}">{{ $type }}</label>
                    </li>
                @endforeach     
            </div> 
            {{-- dd($page_content['getEvent']) --}}

            <!-- FOODSTAND DIMENSIONS -->
            <li class="form-label">
                <span>{{ Lang::get('forms.foodstanddimensions') }}:</span>
            </li>
            <div class="multiple-wrapper">
                <li class="form-input-textfield">
                    @include('forms.inputerror')
                    {!! Form::number('dimensionx',
                        isset($page_content['getFoodstand']->dimension_x) ? $page_content['getFoodstand']->dimension_x : '',
                        array_merge(['placeholder' => Lang::get('forms.dimensionX'),
                        'id' => 'foodstand-dimension-x', 
                        'class' => 'smallbox dimension'])) !!}
                </li>
                <li>
                    <span class="form-separator">x</span>
                </li>
                <li class="form-input-textfield">
                    @include('forms.inputerror')
                    {!! Form::number('dimensiony',
                        isset($page_content['getFoodstand']->dimension_y) ? $page_content['getFoodstand']->dimension_y : '',
                        array_merge(['placeholder' => Lang::get('forms.dimensionY'), 
                        'id' => 'foodstand-dimension-y', 
                        'class' => 'smallbox dimension'])) !!}
                </li>
                <li>
                <span class="form-separator form-indication">m<sup>2</sup></span>
                </li>
            </div>    
        </ul>
    </fieldset>
{!! Form::close() !!}