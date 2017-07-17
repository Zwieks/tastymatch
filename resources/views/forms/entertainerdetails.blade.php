<!-- {{$debugpath}} -->
{!! Form::open(['method' => 'post', 'class' => 'detailpage detailpage-additionaldetails changed']) !!}
    <fieldset>
        <ul class="velden">
            <!-- ENTERTAINER TYPE SELECT -->
            <li class="form-label">
                <span>{{ Lang::get('forms.entertainertype') }}:</span>
            </li>
            <div class="multiple-wrapper fix-sizes">
                @php ($types = Lang::get('entertainertypes'))

                @if(isset($page_content['getEntertainer']->entertainertype_ids))
                    @php ($entertainertypes_array = explode(',',$page_content['getEntertainer']->entertainertype_ids))
                    @php ($subentertainertypes_array = explode(',',$page_content['getEntertainer']->subentertainertype_ids))
                @endif    

                @foreach($types as $type)
                    <div>
                        <li class="form-input-checkbox dropdown" data-icon="O">
                            <input class="radio checkboxfilter" data-icon="~" type="checkbox" value="{{ $loop->iteration }}" name="entertainer_type" id="entertainertype-{{ $loop->iteration }}" {{ isset($page_content['getEntertainer']->entertainertype_ids) && in_array($loop->iteration,$entertainertypes_array) ? 'checked' : ''}}>
                            <label class="js-toggle-dropdown" for="entertainertype-{{ $loop->iteration }}">{{ $type['label'] }}</label>
                        </li>  

                        <ul class="submenu-wrapper">
                            @foreach($type as $key => $subitem)
                                @if(substr($key, 0, strlen('subtype-')) === 'subtype-')
                                     <li class="form-input-checkbox subitem">
                                        <input class="radio checkboxfilter" type="checkbox" value="{{ $subitem }}" name="subentertainer_type" id="{{$subitem}}-subentertainertype-{{ $loop->iteration }}" {{ isset($page_content['getEntertainer']->subentertainertype_ids) && in_array($loop->iteration,$subentertainertypes_array) ? 'checked' : ''}}>
                                        <label for="{{$subitem}}-subentertainertype-{{ $loop->iteration }}">{{ $subitem }}</label>
                                    </li>         
                                @endif
                            @endforeach
                       </ul>     
                    </div>        
                @endforeach     
            </div> 
            {{-- dd($page_content['getEntertainer']) --}}  
        </ul>
    </fieldset>
{!! Form::close() !!}