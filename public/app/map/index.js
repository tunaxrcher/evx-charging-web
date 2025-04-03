var map;
var mapCenter;
var autocomplete;

var mapEVX;

$(function () {
  initMap();
});

function initMap() {
  //get my location
  navigator.geolocation.getCurrentPosition(function (position) {
    mapCenter = {
      lat: position.coords.latitude,
      lng: position.coords.longitude,
    };
  });

  // Map Options
  var options = {
    zoom: 12.5,
    center: mapCenter,
  };

  //new map
  map = new google.maps.Map(document.getElementById("map"), options);

  var input_search = document.getElementById("location-input");
  map.controls[google.maps.ControlPosition.TOP_LEFT].push(input_search);

  autocomplete = new google.maps.places.Autocomplete(input_search);
  autocomplete.bindTo("bounds", map);

  //   //Add Mareker
  //   var marker = new google.maps.Marker({
  //     position: mapCenter,
  //     map: map,
  //     icon: {
  //       url: "https://media.discordapp.net/attachments/1055709711128875008/1308686177380864000/7dd7d24e61bb1cb2.png?ex=673ed87a&is=673d86fa&hm=566a9280e240949cf744e6c71f7d180d20cb9351f8bf9bff7b5427f86ead34e6&=&format=webp&quality=lossless&width=140&height=210",
  //       scaledSize: new google.maps.Size(80, 80), // scaled size
  //       origin: new google.maps.Point(0, 0), // origin
  //       anchor: new google.maps.Point(0, 0), // anchor
  //     },
  //   });

  getLocation();
  myMarker(mapCenter);

  autocomplete.addListener("place_changed", function () {
    infoBox.close();
    var place = autocomplete.getPlace();
    if (!place.geometry) {
      window.alert("ไม่พบพื้นที่");
      return;
    }

    if (place.geometry.viewport) {
      map.fitBounds(place.geometry.viewport);
    } else {
      map.setCenter(place.geometry.viewport);
      map.setZoom(16);
    }
  });
}

function addMarker(location) {
  let link_img = serverUrl + "/assets/images/hero-img/EVX_Icon2.png";

  let mapLatLng = {
    lat: location.lat,
    lng: location.lng,
  };

  var marker = new google.maps.Marker({
    position: mapLatLng,
    map: map,
    icon: {
      url: link_img,
      scaledSize: new google.maps.Size(80, 80), // scaled size
      origin: new google.maps.Point(0, 0), // origin
      anchor: new google.maps.Point(0, 0), // anchor
    },
  });

  var infoBox = new google.maps.InfoWindow({
    content: "<h1 style='color:#000'>" + location.station_name + "</h1>",
  });

  marker.addListener("click", function () {
    infoBox.open(map, marker);
  });
}

function myMarker(location) {
  var marker = new google.maps.Marker({
    position: location,
    map: map,
  });
}

function getLocation() {
  $.ajax({
    type: "GET",
    url: `${serverUrl}/map/GetLocations`,
    contentType: "application/json; charset=utf-8;",
    processData: false,
    success: function (res) {
      if (res.success === 1) {
        for (let index_ = 0; index_ < res.data.length; index_++) {
          mapEVX = {
            lat: parseFloat(res.data[index_].location_latitude),
            lng: parseFloat(res.data[index_].location_longitude),
            station_name: res.data[index_].charge_box_id,
          };

          addMarker(mapEVX);
        }
      } else {
      }
    },
    error: function (res) {
      console.log(res);
    },
  });
}
