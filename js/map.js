//Defining some global variables
var map, geocoder, marker, infowindow;
var overlay;

var mapContainer = 'mapDisplayArea';
var txtAddress = 'txtSearchMap';
var mapLatLng = 'mapLatLonTemp';
var mapAddressHTML = 'displayAddress';

var defaultLat = 21.033840;
var defaultLon = 105.850110;
var defaultZoom = 12;

/**
 * initial map
 * @return 
 */
function map_initialize() {
    // Initialize default values
    var zoom = defaultZoom;
    var latlng = new google.maps.LatLng(defaultLat, defaultLon);
	
    //options
    var options = {
        zoom: zoom,
        center: latlng,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        disableDefaultUI: false,
        
        navigationControl: true,
        navigationControlOptions: {
            position: google.maps.ControlPosition.LEFT,
            style: google.maps.NavigationControlStyle.SMALL//ANDROID//ZOOM_PAN//
        },
        scaleControl: true,
        disableDoubleClickZoom: false,
        draggable: true,
        scrollwheel: false,
        streetViewControl: true

    }
	
    map = new google.maps.Map(document.getElementById(mapContainer), options);
	
    marker = new google.maps.Marker({
        position: latlng,	    
        map: map,
        draggable: true
    });
	
    // Update current position info.
    updatePosition(latlng);
	
	
    /*// Attaching a click event to the map
	google.maps.event.addListener(map, 'click', function(e) {
		// Getting the address for the position being clicked
		getByLatLng(e.latLng);
	});*/

    // Attaching a click event to the map
    google.maps.event.addListener(marker, 'click', function() {
        // Getting the address for the position being clicked
        getByLatLng(marker.getPosition());
        showInfoWindow();
    });
    // Add dragging event listeners.
    google.maps.event.addListener(marker, 'dragstart', function() {
        //updateMarkerAddress('Dragging...');
        hideInfoWindow();
    });
  
    google.maps.event.addListener(marker, 'drag', function() {
        //updateMarkerStatus('Dragging...');
        updatePosition(marker.getPosition());
    });
  
    google.maps.event.addListener(marker, 'dragend', function() {
        //updateMarkerStatus('Drag ended');
        if (!marker) 
        {				
            marker = new google.maps.Marker({
                map: map
            });
            marker.setPosition(marker.getPosition());
        }
		
		
        geocodePosition(marker.getPosition());
		
        showInfoWindow();
    });
  
    google.maps.event.addListener(map, 'center_changed', onCenterChanged);	
	
    google.maps.event.addListener(map, 'zoom_changed', onZoomChanged);
	
    //autocomplete address
    $(function() {
        $("#"+txtAddress).autocomplete({
            //This bit uses the geocoder to fetch address values
            source: function(request, response) {
                if(!geocoder) {
                    geocoder = new google.maps.Geocoder();
                }
                geocoder.geocode( {
                    'address': request.term+',vn,Vietnam',
                    'region': 'vn',
                    'language':'vn'
                }, function(results, status) {
                    response($.map(results, function(item) {
                        return {
                            label:  item.formatted_address,
                            value: item.formatted_address,
                            latitude: item.geometry.location.lat(),
                            longitude: item.geometry.location.lng()
                        }
                    }));
                })
            },
	      
            //This bit is executed upon selection of an address
            select: function(event, ui) {	        
                var location = new google.maps.LatLng(ui.item.latitude, ui.item.longitude);
                marker.setPosition(location);
                map.setCenter(location);
            }
        });
    });
}

/**
 * zoom minimum
 */

function onZoomChanged() {
    if (map.getZoom() < 6){
        //alert("You cannot zoom out any further");
        map.setZoom(6);
    }

}

/**
 * update marker position
 */
function updatePosition(latLng) {
    $('#'+mapLatLng).val(latLng.lat().toFixed(6)+', '+latLng.lng().toFixed(6));
}

/**
 * update marker Address
 */
function updateAddress(str) {
    $('#'+mapAddressHTML).html(str);
}


/**
 * change center event 
 */
function onCenterChanged() {	
    
    var latlng = new google.maps.LatLng(map.getCenter().lat(), map.getCenter().lng());
   
    if (!marker) {      
        marker = new google.maps.Marker({
            map: map
        });
    }
    
    // Setting the position of the marker to the returned location
    marker.setPosition(latlng);
    
    //update position   
    updatePosition(latlng);
    
    //get position by latlng
    getByLatLng(latlng);
    
    //hide info window
    hideInfoWindow();
    return false;
}
/**
 * get address from position
 */
function geocodePosition(pos) {
    if(!geocoder) {
        geocoder = new google.maps.Geocoder();
    }
	
    geocoder.geocode({
        latLng: pos
    }, function(responses) {
        if (responses && responses.length > 0) {			
            var content = responses[0].formatted_address;
			 
            //update infowindow
            map.setCenter(pos);
            updateInfoWindow(content);
        } else {
    //alert('Cannot determine address at this location.');
    }
    });
}

/**
 * update infowindow
 */
function updateInfoWindow(content)
{
    // Check to see if we've already got an InfoWindow object
    if (!infowindow) {
        // Creating a new InfoWindow
        infowindow = new google.maps.InfoWindow();
    }
    
    var contentHTML = 	'<div id="info">' +						    
    '<h3>'+content+'</h3>' +
    '<div id="controls"><a href="javascript:;" style="float:none;padding-bottom:0px;" title="Lưu lại" onclick="$(\'#saveMap\').click();"><img src="/images/save_map.gif" title="Lưu lại" alt="Lưu lại"></a></div>' +						    
    '</div>';
    
    infowindow.setContent(contentHTML);
        
    return false;
}

/**
 * show infowindow
 */
function showInfoWindow()
{
    // Check to see if we've already got an InfoWindow object
    if (!infowindow) {
        // Creating a new InfoWindow
        infowindow = new google.maps.InfoWindow();
    }
        
    // Opening the InfoWindow
    infowindow.open(map, marker);
}

/**
 * hide infowindow
 */
function hideInfoWindow()
{
    // Check to see if we've already got an InfoWindow object
    if (!infowindow) {
        // Creating a new InfoWindow
        infowindow = new google.maps.InfoWindow();
    }
        
    infowindow.close();
}

/**
 * get position by address
 */
function getByAddress(address) {	
    if(!geocoder) 
    {
        geocoder = new google.maps.Geocoder();		
    }
	
    var geocoderRequest = 
    {
        address: address,
        'region':'vn'
    }
	
    // Making the Geocode request
    geocoder.geocode(geocoderRequest, function(results, status) {		
        if (status == google.maps.GeocoderStatus.OK) 
        {						
            map.setCenter(results[0].geometry.location);
			
            if (!marker) 
            {				
                marker = new google.maps.Marker({
                    map: map
                });
            }
			
            marker.setPosition(results[0].geometry.location);
			
            geocodePosition(marker.getPosition());
			
            var content = results[0].formatted_address;			
            updateInfoWindow(content);
			
            updateAddress(results[0].formatted_address);
        }
    });
}

/**
 * get address by position
 */
function getByLatLng(latLng) {	  
    if (!geocoder) {
        geocoder = new google.maps.Geocoder();
    }
	  
    var geocoderRequest = {
        latLng: latLng
    }
	  
    geocoder.geocode(geocoderRequest, function(results, status){
        if (!infowindow) 
        {
            infowindow = new google.maps.InfoWindow();			  
        }
		  
        infowindow.setPosition(latLng);
		  
        if (status == google.maps.GeocoderStatus.OK) {
            // Looping through the result
            //for (var i = 0; i < results.length; i++) {
            if (results[0].formatted_address) {
                var content = results[0].formatted_address;//latLng.toUrlValue()
                updateInfoWindow(content);	        	
                //infowindow.setContent(content);
	    	    
                //infowindow.open(map);
	    	    
                updateAddress(results[0].formatted_address);
            }
        //}
        }
		  
        else {
            content += '<div>No address could be found. Status = ' + status + '</div>';
			  
        }
		  
    });
	  
    return false;
	  
}