/**
 * Created by benjaminthdev on 11/07/2017.
 */
if (contact.map) {

    let google_maps_api = require('load-google-maps-api-2');

    google_maps_api.key = 'AIzaSyCFggcHseEIECvNWvEOPon3_lgSft2Mh0Y';


    google_maps_api().then(function (googleMaps) {

        let myLatlng = new googleMaps.LatLng(parseFloat(contact.map.lat), parseFloat(contact.map.lng));

        let mapOptions = {
            zoom: 12,
            center: myLatlng
        };

        let map = new googleMaps.Map(document.getElementById("contact_map"), mapOptions);

        let marker = new googleMaps.Marker({
            position: myLatlng,
            title: "Hello World!"
        });

        marker.setMap(map);


    }).catch(function (err) {
        console.error(err);
    });
}
