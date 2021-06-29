function distance(lat1,lat2, lon1, lon2)
{
        lon1 = lon1 * Math.PI / 180;
        lon2 = lon2 * Math.PI / 180;
        lat1 = lat1 * Math.PI / 180;
        lat2 = lat2 * Math.PI / 180;

        // Haversine formula
        let dlon = lon2 - lon1;
        let dlat = lat2 - lat1;
        let a = Math.pow(Math.sin(dlat / 2), 2)
        + Math.cos(lat1) * Math.cos(lat2)
        * Math.pow(Math.sin(dlon / 2),2);

        let c = 2 * Math.asin(Math.sqrt(a));

        // Radius of earth in kilometers. Use 3956
        // for miles
        let r = 6371;

        // calculate the result
        let res = c * r;
        return(res.toFixed(2));
}

var curLat = -25.75423663605008, curLng = 28.195811362641845;

var curIcon = L.icon({
    iconUrl: '../maps/icons/current.png',

    iconSize:   [50, 64], // size of the shadow
    iconAnchor: [4, 62],  // the same for the shadow
    popupAnchor:  [-3, -76] // point from which the popup should open relative to the iconAnchor
});

const map = L.map('map').setView([curLat,curLng], 14);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    minZoom: 0,
    maxZoom: 20,
    attribution: 'Map data © <a href="https://openstreetmap.org">OpenStreetMap</a> contributors'
}).addTo(map);

L.marker([curLat,curLng], {icon: curIcon}).addTo(map).bindPopup('Your Current Location <i class="fa fa-location-arrow"></i>');


$.ajax({
    type: 'POST',
    url: '../customRegister.php',
    data: {
        getSaloon:5},
    dataType: 'json',
    success: function(response){
        if(response !=null){

            $.each(response,function (key,data) {
                var location = data.location;
                var lat = location.substr(0,location.indexOf(','));
                var lng = location.substr(location.indexOf(',')+1);

                var dist = distance(curLat,lat,curLng,lng);

                if(dist < 2.5){
                    L.marker([lat,lng]).addTo(map).bindPopup('<a href="#'+data.name+'" onclick="openSaloon('+data.id+')">'+data.name+'</a>('+dist+') k.m');
                }
            });

        }

    }
});

function openSaloon(id){
    console.log(id);
}
// console.log(JSON.parse(coords));
//     for(var i=0;i<coords.length;i++){
//        var dist = distance(curLat, coords[i].lat,curLng, coords[i].lng);
//
//        if(dist < 1.5){
//            L.marker([coords[i].lat,coords[i].lng]).addTo(map).bindPopup('<i id="'+coords[i].id+'" class="select-saloon">'+coords[i].name+'</i>('+dist+') k.m');
//        }
//     };

