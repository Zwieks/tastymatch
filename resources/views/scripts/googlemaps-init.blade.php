<script async defer src="https://maps.googleapis.com/maps/api/js?key={{env('GOOGLE_MAPS_KEY')}}&libraries=places&callback=initMap"></script>
<script type="text/javascript">
    // This example requires the Places library. Include the libraries=places
    // parameter when you first load the API. For example:
    // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

function initMap() {
    //All the database locations

    var db_locations = {!! $locations !!};

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

    //Set to use to center map based on user info
    geocoder = new google.maps.Geocoder();
    var geocoder;

    //Center the map based on user city and country
    geocoder.geocode( {'address' : country+','+city}, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
            map.setCenter(results[0].geometry.location);
        }
    });

    var map = new google.maps.Map(document.getElementById('google-maps'), {
        zoom: 9,
        scrollwheel: false,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    });

    //Check if there are Events
    if( db_locations.events.length != 0 && db_locations.constructor === Object){
        var locations = set_locations(db_locations.events);
        add_markers(map,locations,icons.events.icon);
    }

    //Check if there are Foodstands
    if( db_locations.foodstands.length != 0 && db_locations.constructor === Object){
        var locations = set_locations(db_locations.foodstands);
        add_markers(map,locations,icons.foodstands.icon);
    }

    //Check if there are Entertainers
    if( db_locations.entertainers.length != 0 && db_locations.constructor === Object){
        var locations = set_locations(db_locations.entertainers);
        add_markers(map,locations,icons.entertainers.icon);
    }
}

function set_locations(db_locations){
    var objectCount = Object.keys(db_locations).length;
    var locations = [];

    for (var i = 0; i < db_locations.length; i++) {

        if (db_locations[i]['images'].length == 0){
            db_locations[i]['images'][0] = {
                file: 'logo.svg'
            }
        }

        locations.push([db_locations[i].description, db_locations[i].lat, db_locations[i].long, db_locations[i]['images'][0].file]);
    }

    return locations;
}

function add_markers(map,locations,icon){
    var infowindow = new google.maps.InfoWindow({});
    var marker, i, contentString;

    var image = {
        url: icon,
        scaledSize : new google.maps.Size(30, 30)
    };

    for (i = 0; i < locations.length; i++) {
        marker = new google.maps.Marker({
            position: new google.maps.LatLng(locations[i][1], locations[i][2]),
            icon: image,
            map: map
        });

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
</script>