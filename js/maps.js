//declare global variables
var map = null; 
var info_window = new google.maps.InfoWindow();
var markersArray = [];


// handles the initial settings and styling for google maps 
function initialize() {
		var infos = [];
		
	  var map_options = {
		zoom: 12,
		center: new google.maps.LatLng(1.35208, 103.81984),
		panControl: false,
		panControlOptions: {
		position: google.maps.ControlPosition.BOTTOM_LEFT
		},
			
		zoomControl: true,
		zoomControlOptions: {
		style: google.maps.ZoomControlStyle.LARGE,
		position: google.maps.ControlPosition.RIGHT_CENTER
		},
		scaleControl: false
	  }
	  
	 map = new google.maps.Map(document.getElementById('map-canvas'), map_options); 
	 
		var encodedString;
        //Initialize the array that will hold the contents of the split string
        var stringArray = [];
        //Get the value of the encoded string from the hidden input
        encodedString = document.getElementById("encodedString").value;
		console.log("The encoded string is " + encodedString);
        //Split the encoded string into an array the separates each location
        stringArray = encodedString.split("****");
 
        var x;
        for (x = 0; x < stringArray.length; x = x + 1){
            var addressDetails = [];
            var marker;
            //Separate each field
            addressDetails = stringArray[x].split("&&&");
            //Load the lat, long data
            var lat = new google.maps.LatLng(addressDetails[1], addressDetails[2]);
            //Create a new marker and info window
            marker = new google.maps.Marker({
                map: map,
                position: lat,
                //Content is what will show up in the info window
                content: addressDetails[0]
            });
			
            //Pushing the markers into an array so that it's easier to manage them
            markersArray.push(marker);
            google.maps.event.addListener(marker, 'click', function (){
                //close_info();
                var info = new google.maps.InfoWindow({content: this.content});
                //On click the map will load the info window
                info.open(map,this);
                infos[0]=info;
            });
			
			
			google.maps.event.addListener(marker, 'rightclick', function() {
				//call remove marker function
				marker.setMap(null);
			});
		}
	 
	 //add marker to the event where the point of the map is clicked
	 google.maps.event.addListener(map, 'click', function(event) { add_marker(event.latLng); });
} 


function add_marker(location) {
	//ensure that the map is initialized
	if(map != null) { 
    	var marker = new google.maps.Marker({ 
		position: location, 
		map: map, 
		animation: google.maps.Animation.DROP });
		
		//listener on markers to listen for clicks/right clicks 
    	google.maps.event.addListener(marker, 'rightclick', function(event) { marker.setMap(null); });
		google.maps.event.addListener(marker, 'click', function() { open_info(marker, location) });
    	markersArray.push(marker); 
	}
}

function open_info(marker, location) {
	if(map != null) {					  
		//infowindow form that calls appendLatLong() before submit
				var content =   '<form method="post" action="addmarker.php" name="infoWindow" id="infoWindow">' +
								'<input type="text" name="location" id="location" placeholder= "Location"/><br />' +
								'<input type="textarea" name="description" id="description" cols="40" rows="5" placeholder="Description"/><hr />' +
								'<input type="hidden" name="lat" id="lat" value="'+marker.getPosition().lat()+'"/>' +
								'<input type="hidden" name="lng" id="lng" value="'+marker.getPosition().lng()+'"/>' +
								'<input type="submit" name="save" id="save" value="Save" />' +
								'</form>';
		
		
		info_window.setContent(content);
		info_window.open(map, marker);
	}
}

//not needed
/*
function close_info(){
	if(infos.length > 0){
          infos[0].set("marker",null);
          infos[0].close();
          infos.length = 0;
	}
}*/

google.maps.event.addDomListener(window, 'load', initialize);

