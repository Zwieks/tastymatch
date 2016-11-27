<script async defer src="https://maps.googleapis.com/maps/api/js?key={{env('GOOGLE_MAPS_KEY')}}&libraries=places&callback=initMap"></script>
<script type="text/javascript">
    // This script requires the Places library. Include the libraries=places

    // parameter when you first load the API.
    var markers = [];
    var db_locations = {!! $locations !!};
    var locations_object = db_locations;
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
    var city = {!! json_encode($user['city']) !!};

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
        //Set to use to center map based on user info
        geocoder = new google.maps.Geocoder();

        //Set animation
        animation = false;

        //Center the map based on user city and country
        geocoder.geocode( {'address' : country+','+city}, function(results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                map.setCenter(results[0].geometry.location);
            }
        });

        map = new google.maps.Map(document.getElementById('google-maps'), {
            zoom: 9,
            scrollwheel: false,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });

        createMap(map,animation);
    }

    function createMap(map,animation){
        for (var key in locations_object) {
            var locations = set_locations(locations_object[key]);
            add_markers(map,locations,icons[key].icon,animation);
        }
    }

    function set_locations(object){
        var locations = [];

        for (var i = 0; i < object.length; i++) {

            if (object[i]['images'].length == 0){
                object[i]['images'][0] = {
                    file: 'logo.svg'
                }
            }

            locations.push([
                object[i].description, 
                object[i].lat, 
                object[i].long, 
                object[i]['images'][0].file, 
                object[i].name
            ]);
        }

        return locations;
    }

    function add_markers(map,locations,icon,animation){
        infowindow = new google.maps.InfoWindow({});
        var marker, i, contentString;

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

            markers.push(marker);

            google.maps.event.addListener(marker, 'click', (function (marker, i, contentString) {
                contentString = '<div class="infowindow-wrapper">'+
                  '<div class="image-wrapper"><img src="/img/uploads/'+locations[i][3]+'"></div>'+
                  '<div class="text-wrapper">'+
                  '<h3 class="firstHeading">'+locations[i][0]+'</h3>'+
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

    // Markers filtering magic
    function filterObject(){
        locations_object = {};
        animation = true;
        checkedValues = [];
        matching_words = {};
        string = $.trim(document.getElementById('js-filter-input').value);    
        var inputElements = document.getElementsByClassName('form-input-checkbox');
        var i = 0;

        //Get the checkbox filters
        for(var count=0; count < inputElements.length; ++count){
            var element = document.getElementById("filter-"+count);
            var value = element.checked;
            if(value == true){
                checkedValues.push(element.value.toUpperCase());
            }
        }

        //Search in
        for (var key in db_locations) {
            if(checkedValues.indexOf(key.toUpperCase()) > -1){
                var obj = db_locations[key];
                var detail_object = [];
                var matching_array_keywords = [];
                var matching_array_name = [];

                for (var prop in obj) {    

                    var str = string.toUpperCase();
                    var split_str_keywords = obj[prop]['keywords'].split(",");
                    var in_keywords = false;
                    var in_name = false;

                    for(var count=0; count < split_str_keywords.length; ++count){
                        if (split_str_keywords[count].toUpperCase().search(str) !== -1) {
                            in_keywords = true;

                            //Put the matching keyword in the array    
                            if(split_str_keywords[count] != ''){
                                matching_array_keywords.push(split_str_keywords[count]);
                                matching_words['keywords'] = matching_array_keywords;
                            }
                        }    
                    }

                    if(obj[prop]['name'].toUpperCase().includes(str)){
                        in_name = true;

                        //Put the matching name in the array
                        if(obj[prop]['name'] != ''){
                            matching_array_name.push(obj[prop]);
                            matching_words[key] = matching_array_name;
                        }    
                    }

                    if(in_name == true || in_keywords == true){ 
                        detail_object.push(obj[prop]);
                        locations_object[key] = detail_object;
                    }      
                }
            }    
        }

        //Show autocomplete list
        createAutoComplete();

        //Remove all the markers
        deleteMarkers();

        //Add the new markers on the map
        createMap(map,animation);
    }

    //Create the autocomplete list
    function createAutoComplete(){
        var container = $('<div class="autocomplete-wrapper" />');
        var section = '';
        var title = '';
        var ul = '';
        var li = '';

        $.each( matching_words, function( key, value ) {
            section = $('<section class="autocomplete-content" />');
            title = $('<h3>'+key+'</h3>');
            ul = $('<ul class="autocomplete-items" />');
            section.append(title);

            //Loop through the objects
            $.each( value.slice(0,3), function( key, value ) {
                //Check if the value is a keyword or an object, when the value is undefined is is a keyword
                if(typeof value['name'] != 'undefined'){
                    li = $('<li class="autocomplete-item">'+value['name']+'</li>');
                }else{
                     li = $('<li class="autocomplete-item">'+value+'</li>');
                }   

                //Put the item in the list
                ul.append(li);
            });  

            section.append(ul);

            //Put the HTML in the container
            container.append(section);
        });

        if(string == ''){
            $('html').removeClass('open-autocomplete');
        }else{
            $('html').addClass('open-autocomplete');
            $('#js-autocomplete-results .mCSB_container').html(container);    
        }


    }

    window.onload = function (map) { 
        //Prevent submitting form on hitting ENTER
        $(window).keydown(function(event){
            if(event.keyCode == 13) {
                event.preventDefault();
                return false;
            }
        });  

        //Using jQuery to handle the inputfield on key-up
        $( "#js-filter-input" ).keyup(function() {
            //Filter the object based on the user input
            filterObject();   
        });

        //Using jQuery to handle the checkbox filter
        $('.checkboxfilter').change(function() {
            //Filter the object based on the user input
            filterObject();   
        });

        if($('#js-autocomplete-results').length) {
            $("#js-autocomplete-results").mCustomScrollbar({
                theme:"light-3"
            });
        }

    }
</script>