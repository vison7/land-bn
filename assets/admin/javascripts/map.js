var map;
var marker = null;
var myCenter = {
    lat: 13.787804,
    lng: 100.575027
};

function initMap(myMap,customCenter) {

    if(customCenter==null)
        customCenter = myCenter

    map = new google.maps.Map(document.getElementById(myMap), {
        zoom: 13,
        center: customCenter
    });

    map.addListener('click', function (event) {
        addMarker(event.latLng);
        console.log('lat : ' + event.latLng.lat() + ' ,Lng : ' + event.latLng.lng());
    });
}

function addMarker(location) {
    if (marker != null) {
        marker.setPosition(location);
    } else {
        marker = new google.maps.Marker({
            position: location,
            draggable: true,
            map: map
        });
    }
}

function clearMarker() {
    //alert(marker.getPosition().lat() + ' , lgn ' + marker.getPosition().lng());
    if (marker != null) {
        marker.setMap(null);
        marker = null;
    }
}