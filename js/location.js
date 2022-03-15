if ("geolocation" in navigator) { //check geolocation available 
    //try to get user current location using getCurrentPosition() method
    navigator.geolocation.getCurrentPosition(function(position) {
       //console.log("Found your location \nLat : " + position.coords.latitude + " \nLang :" + position.coords.longitude);
       $('#long').val( position.coords.longitude);
       $('#lanti').val(position.coords.latitude);
    });
 } else {
    console.log("Browser doesn't support geolocation!");
 }  