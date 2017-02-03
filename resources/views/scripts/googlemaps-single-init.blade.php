<script async defer src="https://maps.googleapis.com/maps/api/js?key={{env('GOOGLE_MAPS_KEY')}}&libraries=places&callback=initMap"></script>
<script type="text/javascript">
    // This script requires the Places library. Include the libraries=places
    var locations_object = [];

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
            icon: iconBase + 'events-50.png'
        },
        foodstands: {
            icon: iconBase + 'foodstands-50.png'
        },
        entertainers: {
            icon: iconBase + 'entertainers-50.png'
        }
    };

    function initMap() {
        //Get the user agenda items
        locations_object = createDefaultAgendaObject();

        //Set to use to center map based on user info
        geocoder = new google.maps.Geocoder();

        //Set animation
        animation = false;

        map = new google.maps.Map(document.getElementById('google-maps'), {
            zoom: 9,
            scrollwheel: false,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });

        createMap(map,animation);

        //Set the bounds and zoom
        setBounds();

        //Update the agenda items
        setAgendaItems();
    }

    function createMap(map,animation){
        $.each(locations_object, function(key, fd) {
            if(fd['info'] != ""){
                var locations = set_locations(key,fd['info']);
                add_markers(key,map,locations,icons['events'].icon,animation);
            }
        });
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
                  '<h3 class="firstHeading">'+locations[i][4]+'</h3>'+
                  '<p>'+description+' <a href="'+url+'/'+locations[i][5]+'" target="_blank">{!! Lang::get('commons.more-info') !!}</a>'+'</p>'+
                  '</div>'+
                  '</div>';

                return function () {
                    infowindow.setContent(contentString);
                    infowindow.open(map, marker);
                }
            })(marker, i));
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
        var collection = {!! $user['agenda']->sortBy('date_start') !!};
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
        locations_object = [];

        @foreach ($user['agenda'] as $item)
            locations_object.push({!! $item !!});
        @endforeach

        return locations_object;
    }

    // Markers filtering magic
    function filterObject(){
        //Remove all the markers
        deleteMarkers();

        //Add the new markers on the map
        createMap(map,animation);

        //Set the bounds and zoom
        setBounds();

        //Update the agenda items
        setAgendaItems();
    }

    //Set the agenda items
    function setAgendaItems(){

        //Get the agenda info
        var agenda_listitems = '';

        for (var key in locations_object) {
            if(typeof locations_object[key]['info'].name != 'undefined' && locations_object[key]['info'].name != ''){
                var name = locations_object[key]['info'].name;
                var item = "<li class='agendaitem'><span data-icon='H'>"+name+"</span></li>";
                agenda_listitems = agenda_listitems+item;
            }
        }

        var contentAgenda = '<ul class="agendaitems-wrapper">'+agenda_listitems+'</ul>';

        $('#js-google-maps-overlay-agenda').empty();
        $('#js-google-maps-overlay-agenda').append(contentAgenda);

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
            locations_object = createAgendaObject(filter_start_date,filter_end_date);

            //Filter the object based on the user input
            animation = false;
            filterObject();
        });

        $('input[name="daterange"]').on('cancel.daterangepicker', function(ev, picker) {

            //Set the default object
            createDefaultAgendaObject();

            //Filter the object based on the user input
            animation = false;
            filterObject();
        });
    }
</script>