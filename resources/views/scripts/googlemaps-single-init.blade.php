<script async defer src="https://maps.googleapis.com/maps/api/js?key={{env('GOOGLE_MAPS_KEY')}}&libraries=places&callback=initMap"></script>
<script type="text/javascript">
    // This script requires the Places library. Include the libraries=places
    $.fn.locations_object = [];

    // parameter when you first load the API.
    var markers = [];
    var geocoder;
    var map;
    var infowindow;
    var string;

    //Matching words for autocomplete
    var matching_words = {};

    //animation
    var animation;

    //Filter standards
    var checkedValues = [];

    //User country
    var country = "{!! strtolower(urlencode(str_replace(' ', '_', getUserCountry()))) !!}";

    //User city
    var city = 'utrecht';

    //Custom markers
    var iconBase = '/img/googlemaps/markers/';
    var icons = {
        events: {
            icon: iconBase + 'events-50.png',
            icon_new: iconBase + 'events-50.png'
        },
        foodstands: {
            icon: iconBase + 'foodstands-50.png'
        },
        entertainers: {
            icon: iconBase + 'entertainers-50.png'
        }
    };

    //set the content
    //This is kind of a hack because we need to use an exception of the user object
    @if(isset($user))
        <?php $page_content_bu = $page_content; ?>
        <?php $page_content = $user; ?>
    @endif

    function getCityDropdown(input) {
        var autocomplete = new google.maps.places.Autocomplete(input);
        autocomplete.addListener('place_changed', function () {
                      clearMarkers();
            var infowindow = new google.maps.InfoWindow();
            var infowindowContent = document.getElementById('infowindow-content');
            infowindow.setContent(infowindowContent);
            var marker = new google.maps.Marker({
              map: map,
              anchorPoint: new google.maps.Point(0, -29)
            });

            infowindow.close();
            marker.setVisible(false);
            markers.push(marker);
            var place = autocomplete.getPlace();
            if (!place.geometry) {
                // User entered the name of a Place that was not suggested and
                // pressed the Enter key, or the Place Details request failed.
                alert("Please select an option");
                return;
            }else{
                // If the place has a geometry, then present it on a map.
                if (place.geometry.viewport) {
                    map.fitBounds(place.geometry.viewport);
                } else {
                    map.setCenter(place.geometry.location);
                    map.setZoom(17);  // Why 17? Because it looks good.
                }

                marker.setPosition(place.geometry.location);
                marker.setVisible(true);

                var address = '';

                var infowindowContent = document.getElementById('infowindow-content');

                //Remove the coordinates if they are set
                $('#place_lat, #place_lng').val('');
                //Add the new coordinates to the inputfields
                $('#place_lat').val(place.geometry.location.lat());
                $('#place_lng').val(place.geometry.location.lng());

                if (place.address_components) {
                    address = [
                        (place.address_components[0] && place.address_components[0].short_name || ''),
                        (place.address_components[2] && place.address_components[2].short_name || ''),
                        (place.address_components[3] && place.address_components[3].short_name || ''),
                        (place.address_components[4] && place.address_components[4].short_name || '')
                    ].join(' ');
                }
            }
        });
    }

    function initMap() {
        //Get the user agenda items
        if($.fn.locations_object.length === 0){
            $.fn.locations_object = createDefaultAgendaObject();
        }else{
            markers = [];
        }

        //Check if there is a dropdown for the locations
        if(document.getElementById('googlemaps-dropdown')) {
            var input = document.getElementById('googlemaps-dropdown');

            google.maps.event.addDomListener(input, 'keydown', function(event) { 
                if (event.keyCode === 13) { 
                    event.preventDefault(); 
                }
            });

            getCityDropdown(input);
        }

        //Set to use to center map based on user info
        geocoder = new google.maps.Geocoder();

        //Set animation
        animation = false;

        if(document.getElementById('google-maps')) {
            map = new google.maps.Map(document.getElementById('google-maps'), {
                zoom: 9,
                scrollwheel: false,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            });

            if ($.fn.locations_object.length == 0) {
                emptyMap();
            }

            createMap(map,animation,$.fn.locations_object);

            //Set the bounds and zoom
            setBounds();

            //Update the agenda items
            setAgendaItems();
        }   else{
            emptyMap();
        } 
    }

    function createMap(map,animation,set_markers){
        if(set_markers.length != 0){
            $.each(set_markers, function(key, fd) {
                if(fd['info'] != ""){
                    var locations = set_locations(key,fd['info']);
                    add_markers(key,map,locations,icons['events'].icon,animation);
                }
            });
        }else{
            @if(isset($page_content_bu['getEvent']))
                var lat = {{ $page_content_bu['getEvent']->lat }},
                    long = {{ $page_content_bu['getEvent']->long }}
            @endif

            set_singleMarker(map, lat, long);
        }
    }

    function set_singleMarker(map,lat,long){
        marker = new google.maps.Marker({
            position: new google.maps.LatLng(lat, long),
            map: map,
            animation: google.maps.Animation.DROP
        });

        markers.push(marker);
    }

    function set_locations(i,object){
        var locations = [];

        if (typeof object['images'] != 'undefined' && object['images'].length == 0){
            object['images'][0] = {
                file: 'logo.svg'
            }
        }

        locations.push([
            object.description,
            object.lat,
            object.long,
            object.name,
            object.slug
        ]);

        return locations;
    }

    function create_new_marker(info){
        var new_info_object = new Object();
        var place_detail = [];
        var lat = '';
        var lng = '';
        var eventid = '';
        var position_innit = false;

        $.each(info, function(key, fd) {
            new_info_object = jQuery.extend(new_info_object, fd);
        });

        //Get the status
        if(typeof new_info_object.status != 'undefined'){
            var status = new_info_object.status;
        }else{
            var status = '';
        }

        //Get the new location
        var location = new_info_object.location;

        //Get the eventid
        if(typeof new_info_object.neweventid != 'undefined'){
            eventid = new_info_object.neweventid;
        }else{
            eventid = new_info_object.eventid;
        }

        //Get the title
        var name = new_info_object.searchevents;

        //Get the start date
        if(typeof new_info_object.datestart != 'undefined'){
            var date_start = new_info_object.datestart;
        }else{
            var date_start = '';
        }

        //Get the end date
        if(typeof new_info_object.dateend != 'undefined'){
            var date_end = new_info_object.dateend;
        }else{
            var date_end = '';
        }

        //Get the agenda id
        if(typeof new_info_object.id != 'undefined'){
            var agenda_id = new_info_object.id;
        }else{
            var agenda_id = '';
        }


        //Get the description
        if(typeof new_info_object.description != 'undefined'){
            var description = new_info_object.description;
        }else{
            var description = '';
        }

        //Get the type
        if(typeof new_info_object.eventtype != 'undefined'){
            var event_type = new_info_object.eventtype;
        }else{
            var event_type = '';
        }

        //Get the searchable
        if(typeof new_info_object.searchable != 'undefined'){
            var searchable = new_info_object.searchable;
        }else{
            var searchable = '';
        }

        //Get the current user location
        var country = '{!! App::getLocale() !!}';

        getLocationDetails(agenda_id,status,eventid,info,country,location,name,date_start,date_end,description,event_type,searchable);
    }

    // Should work for most cases
    function uniqId() {
      return Math.round(new Date().getTime() + (Math.random() * 100));
    }

    //Create empty map
    function emptyMap(){
        var country = '{!! App::getLocale() !!}',
            location = '';

            @if(isset($page_content_bu['getEvent']))
                location = '{!! $page_content_bu['getEvent']->location !!}';
            @else if(isset($user['city']))
                 location = {!! json_encode($user['city']) !!};
            @endif

        $.getJSON("https://maps.googleapis.com/maps/api/geocode/json?region="+country+"&address="+encodeURIComponent(location)+"&key={{env('GOOGLE_MAPS_KEY')}}", function(val){ 
            var locationInfo = val.results[0].geometry.location;

            var lat = locationInfo.lat,
                long = locationInfo.lng;

            map.setCenter({lat: lat, lng: long}); 
        });
    }

    function getLocationDetails(agenda_id,status,eventid,info,country,location,name,date_start,date_end,description,event_type,searchable){
        //Get the details using the maps API
        $.getJSON("https://maps.googleapis.com/maps/api/geocode/json?region="+country+"&address="+encodeURIComponent(location)+"&key={{env('GOOGLE_MAPS_KEY')}}", function(val){
            if(val.results.length) {
                var locationInfo = val.results[0].geometry.location;

                //New objects
                var new_detail_object = {};
                    new_detail_object['description'] = description;
                    new_detail_object['type_id'] = event_type;
                    new_detail_object['location'] = location;
                    new_detail_object['name'] = name;
                    new_detail_object['lat'] = locationInfo.lat.toString();
                    new_detail_object['long'] = locationInfo.lng.toString();
                    new_detail_object['searchable'] = searchable;
                    new_detail_object['random'] = uniqId();

                var new_location_object = {};
                    if(status != ''){
                        new_detail_object['status'] = status;
                    }

                    new_location_object['event_id'] = eventid;
                    new_location_object['date_end'] = date_end;
                    new_location_object['date_start'] = date_start;
                    new_location_object['id'] = agenda_id;
                    new_location_object['info'] = new_detail_object;

                //Add the new marker info the the $.fn.locations_object
                $.fn.locations_object.push(new_location_object);
            }
        }).done(function(new_location_object) {
            initMap();     
        });

    }

    function add_markers(key,map,locations,icon,animation){
        infowindow = new google.maps.InfoWindow({});
        var marker, i, contentString;

        //Get the first URL part
        var url = getEventUrl(key).toLowerCase();

        if(animation == true){
            var animation_type = google.maps.Animation.DROP;
        }else{
            var animation_type = null;
        }

        var image = {
            url: icon,
            scaledSize : new google.maps.Size(30, 30)
        };

        for (i = 0; i < locations.length; i++) {
            marker = new google.maps.Marker({
                position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                icon: image,
                id:key,
                animation: animation_type,
                map: map
            });

            //Count the description string and truncate when it is to long
            if(locations[i][0].length < 100){
                var description = locations[i][0];
            }else{
                var description = locations[i][0].substring(0,100)+'...';
            }

            markers.push(marker);
            google.maps.event.addListener(marker, 'click', (function (marker, i, contentString) {
                contentString = '<div class="infowindow-wrapper">'+
                  '<div class="image-wrapper"><img src="/img/uploads/'+locations[i][3]+'"></div>'+
                  '<div class="text-wrapper">'+
                  '<h3 class="firstHeading">'+locations[i][3]+'</h3>'+
                  '<p>'+description+' <a href="'+url+'/'+locations[i][4]+'" target="_blank">{!! Lang::get('commons.more-info') !!}</a>'+'</p>'+
                  '</div>'+
                  '</div>';

                return function () {
                    $('.js-googlemap-agendaitem').removeClass('active');
                    $(".agendaitems-wrapper").mCustomScrollbar("scrollTo","[data-marker-id="+marker.id+"]");
                    $('[data-marker-id='+marker.id+']').addClass('active');

                    infowindow.setContent(contentString);
                    infowindow.open(map, marker);
                }
            })(marker, i));

            google.maps.event.addListener(infowindow,'closeclick',function(){
               $('.js-googlemap-agendaitem').removeClass('active');
            });
        }
    }

    // Sets the map on all markers in the array.
    function setMapOnAll(map) {
        for (var i = 0; i < markers.length; i++) {
            markers[i].setMap(map);
        }
    }

    // Removes the markers from the map, but keeps them in the array.
    function clearMarkers() {
        setMapOnAll(null);
    }

    // Deletes all markers in the array by removing references to them.
    function deleteMarkers() {
        clearMarkers();
        markers = [];
    }

    // Create agenda object
    function createAgendaObject(filter_start_date, filter_end_date){
        var collection = $.fn.locations_object;
        var agenda_object = new Object();
        var index = 0;

        //Search in
        for (var key in collection) {
            if(typeof collection[key].date_start != 'undefined' && collection[key].date_start != ''){

                if( new Date(collection[key].date_start).getTime() >= new Date(filter_start_date).getTime() && new Date(collection[key].date_end).getTime() <= new Date(filter_end_date).getTime()){
                    agenda_object[index] = collection[key];
                    index++;
                }
            }
        }

        return agenda_object;
    }

    //Create default agenda object
    function createDefaultAgendaObject(){
        $.fn.locations_ofbject = [];
        @foreach ($page_content['agenda'] as $item)
            @if($detailpage_id == $item['detailpage_id'])
                $.fn.locations_object.push({!! $item !!});
            @endif    
        @endforeach

        return $.fn.locations_object;
    }

    // Markers filtering magic
    function filterObject(set_markers){
        //Remove all the markers
        deleteMarkers();

        //Add the new markers on the map
        createMap(map,animation,set_markers);

        //Set the bounds and zoom
        setBounds();

        //Update the agenda items
        setAgendaItems();
    }

    //Set the agenda items
    function setAgendaItems(){
        //Get the agenda info
        var agenda_listitems = '',
            eventid = '';


        if($.fn.locations_object.length != 0){    
            for (var key in $.fn.locations_object) {
                if(typeof $.fn.locations_object[key]['info'].name != 'undefined' && $.fn.locations_object[key]['info'].name != ''){
                    var id = $.fn.locations_object[key].id;

                    if(typeof $.fn.locations_object[key].event_id != 'undefined'){
                        eventid = $.fn.locations_object[key].event_id;
                    }else{
                         eventid = '';
                    }

                    var name = $.fn.locations_object[key]['info'].name;
                    var location = $.fn.locations_object[key]['info'].location;
                    var searchable_id = $.fn.locations_object[key]['info'].searchable;
                    var start = $.fn.locations_object[key].date_start;
                    var end = $.fn.locations_object[key].date_end;
                    var date = '';
                    var edit = '';

                    if(typeof $.fn.locations_object[key]['info'].random != 'undefined'){
                        var random = $.fn.locations_object[key]['info'].random;
                    }else{
                        var random = '';
                    }

                    if(typeof start != 'undefined' && start != ''){
                        date = start+' - '+end;
                    }else{
                        date = start;
                    }

                    //Set modal options if the page is new or in updates status
                    @if(isset($page_type) && ($page_type == 'update' || $page_type == 'new'))
                        edit = "title='{!! Lang::get('agenda.edit-agenda') !!}' data-toggle='modal' data-target='#modal-form' data-icon='X'";
                    @endif
                    //Create the user agenda items
                    var item = "<li id='"+id+"' data-random='"+random+"' data-event-id='"+eventid+"' class='agendaitem js-googlemap-agendaitem' "+edit+"data-marker-id='"+key+"' data-searchable='"+searchable_id+"'>"+
                                "<span class='agenda-date' data-icon='H'>"+date+"</span>"+
                                "<span class='agenda-name'><b>"+location+"</b> - "+name+"</span>"+
                                "</li>";       
                    agenda_listitems = agenda_listitems+item;
                }
            }
        }else{
            agenda_listitems = "<li class='agenda-empty'><span>{{ Lang::get('agenda.no-items') }}</span></li>";
        }    

        $('.agendaitems-wrapper .mCSB_container').empty();
        $('.agendaitems-wrapper .mCSB_container').append(agenda_listitems);
    }

    function highlightMarker(id){
        for (var i = 0; i < markers.length; i++) {
            if(id === i){
                markers[i].setAnimation(google.maps.Animation.BOUNCE);
            }
        } 
    }

    //Stop animation
    function stopAnimation(id) {
        for (var i = 0; i < markers.length; i++) {
            if(id === i){                    
                markers[i].setAnimation(null);
            }    
        }    
    }

    //Set the boundries and zoom of the viewport
    function setBounds(){
        var bounds = new google.maps.LatLngBounds();
        for (var i = 0; i < markers.length; i++) {
            bounds.extend(markers[i].getPosition());
        }

        if(i > 0){
            map.fitBounds(bounds);

            google.maps.event.addListenerOnce(map, 'bounds_changed', function(event) {
                this.setZoom(map.getZoom()-1);

                if (this.getZoom() > 15) {
                    this.setZoom(15);
                }
            });
        }
    }

    function getEventUrl(key){
        if(key == 'events'){
            var title = '{!! Lang::get('products.product-event') !!}';
        }else if(key == 'foodstands'){
            var title = '{!! Lang::get('products.product-foodstand') !!}';
        }else if(key == 'entertainers'){
            var title = '{!! Lang::get('products.product-entertainer') !!}';
        }else{
            var title = '{!! Lang::get('googlemaps.filter-keywords-title') !!}';
        }

        return title;
    }

    window.onload = function (map) {
        //Change Agenda input
        $('input[name="daterange"]').on('apply.daterangepicker', function(ev, picker) {
            //do something, like clearing an input

            var filter_start_date = picker.startDate.format('YYYY-MM-DD'),
                filter_end_date = picker.endDate.format('YYYY-MM-DD');

            //Create the new object based on the user input
            var set_markers = createAgendaObject(filter_start_date,filter_end_date);

            //Filter the object based on the user input
            animation = false;
            filterObject(set_markers);
        });

        $('input[name="daterange"]').on('cancel.daterangepicker', function(ev, picker) {

            //Set the default object
            initMap();

            //Filter the object based on the user input
            animation = false;
            filterObject($.fn.locations_object);
        });
    }

    jQuery(document).ready(function($){
        //Hover
        $(document).on('mouseover','.js-googlemap-agendaitem',function() {
            var id = parseInt($(this).attr('data-marker-id'));
            highlightMarker(id);
        });

        $(document).on('mouseleave','.js-googlemap-agendaitem',function() {
            var id = parseInt($(this).attr('data-marker-id'));
            stopAnimation(id);
        });
    });

</script>