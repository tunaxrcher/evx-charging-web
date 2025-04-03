//import { MarkerClusterer } from "@googlemaps/markerclusterer";
let map;
let locations;
let markers = [];
let clusterRenderer;

let moblieLocations;
let mobileMarkers = [];
let mobileClusterRenderer;

let infoWindow;
const mapCenter = {
  lat: 17.9604222,
  lng: 102.5233639,
};
const mapZoom = 6;
let focusStationKeyId = "";
let mapExtent = null;

//let isSmallScreen = window.matchMedia("only screen and (max-width: 760px)").matches;

const icons = [
  {},
  {
    icon: "https://geonine.io/galvanic/Resources/Images/map/map-marker_active.png",
  },
  {
    icon: "https://geonine.io/galvanic/Resources/Images/map/map-marker_under-construction.png",
  },
  {
    icon: "https://geonine.io/galvanic/Resources/Images/map/map-marker_maintain.png",
  },
  {
    icon: "https://geonine.io/galvanic/Resources/Images/map/map-marker_close.png",
  },
];

/**
 * Start Web Socket Scripts
 */

const getSocketKeyUrl = `${serverUrl}/map/SocketKey`;
const webSocketUrl = "wss://geonine.app/evsocket";
const defSocketKey = $.ajax({
  url: `${getSocketKeyUrl}`,
  type: "POST",
  dataType: "json",
});
let stationSocket;

$(function () {
  initWebsocket();
});

function initWebsocket() {
  $.when(defSocketKey)
    .done(function (v1) {
      var key = v1;

      //console.log(data);

      stationSocket = new WebSocket(
        webSocketUrl + `/ws/client/connect?t=${key.k}`
      );

      stationSocket.addEventListener("open", (event) => {
        let socketMessage = {
          messageType: 2,
          action: "GetStationStatusSync",
          messageId: Date.now().toString(),
        };
        //console.log(socketMessage);
        stationSocket.send(JSON.stringify(socketMessage));
      });

      stationSocket.addEventListener("message", (event) => {
        //console.log("Message from server ", event);
        //console.log("Message from server ", event.data);

        // Try parse data to JSON
        var data = null;
        try {
          data = JSON.parse(event.data);
        } catch {}

        if (data != null) {
          if (data.action == "UpdateStationStatus") {
            onUpdateStationStatus(data.payload);
          }
        }
      });
    })
    .always(function () {});
}

function onUpdateStationStatus(payload) {
  //console.log(payload);
  var wsStationId = payload.stationId.toLowerCase();
  var wsStationStatus = payload.status;
  // change map icon here...
  refreshMarkerStatusWS(wsStationId, wsStationStatus);
}

/**
 * End Web Socket Scripts
 */

function openDetailByStationKey(keyId) {
  var dataId = keyId;
  var location = locations.filter((l) => l.keyId == dataId)[0];
  var selMarker = markers.filter((m) => m.dataId == dataId)[0];
  if (typeof location != "undefined") {
    var lat = location.lat;
    var lng = location.lng;

    getInfoWindowContent(location, selMarker);
    getInfoWindowContentDetail(location, selMarker);
  }
}

function enableFormPopOver() {
  var checkPopOverInt = setInterval(() => {
    var popoverTriggerList = [].slice.call(
      document.querySelectorAll('[data-bs-toggle="popover"]')
    );
    console.log("popoverTriggerList", popoverTriggerList);
    if (popoverTriggerList.length > 0) {
      var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
        const popoverId = popoverTriggerEl.attributes["data-content-id"];
        if (popoverId) {
          const contentEl = $(`#${popoverId.value}`).html();
          return new bootstrap.Popover(popoverTriggerEl, {
            content: contentEl,
            html: true,
          });
        } else {
          //do something else cause data-content-id isn't there.
        }
      });

      clearInterval(checkPopOverInt);
    }
  }, 500);
}

function getQueryLocationCond() {
  var tmpStationName = $("#stationName").val() ?? "";
  var tmpStatus = $.map(
    $("input[type=checkbox][name=stationStatus]:checked"),
    (el) => $(el).val()
  );
  var tmpType = $.map(
    $("input[type=checkbox][name=stationType]:checked"),
    (el) => $(el).val()
  );
  var tmpConType = $.map(
    $("input[type=checkbox][name=connectorType]:checked"),
    (el) => $(el).val()
  );

  //console.log('tmpStatus', tmpStatus);
  //console.log('tmpType', tmpType);
  //console.log('tmpConType', tmpConType);

  var cond = {
    stationId: tmpStationName.trim().length > 0 ? tmpStationName.trim() : null,
    stationStatus: tmpStatus.length > 0 ? tmpStatus.join(",") : null,
    stationTypeId: tmpType.length > 0 ? tmpType.join(",") : null,
    connectorType: tmpConType.length > 0 ? tmpConType.join(",") : null,
    online: $("#chk_avaiableonly").prop("checked") ? true : null,
    isPublicStation: $("#chk_publicStation").prop("checked") ? true : null,
  };

  return cond;
}

/* Start : Function to get marker from station detail */

var fnGetMarkerIcon = function (cs) {
  const hubOwnerId = cs.hubOwnerId;
  const chargingStatusId =
    cs.chargingStatusId != null ? cs.chargingStatusId : 0;

  if (!cs.isMobileStation) {
    if (jsonMarkerType[hubOwnerId] == "s") {
      // return jsonMarker[hubOwnerId] + "&s=" + chargingStatusId;
      console.log(jsonMarker[hubOwnerId]);
      return jsonMarker[hubOwnerId];
    } else {
      return jsonMarker[hubOwnerId];
    }
  } else {
    if (jsonMarkerMobileType[hubOwnerId] == "s") {
      return jsonMarkerMobile[hubOwnerId];
      // return jsonMarkerMobile[hubOwnerId] + "&s=" + chargingStatusId;
    } else {
      return jsonMarkerMobile[hubOwnerId];
    }
  }
};

var fnGetMarker = function (cs) {
  const hubOwnerId = cs.hubOwnerId;
  const label = "";
  const position = {
    lat: cs.lat,
    lng: cs.lng,
  };
  const fnMarker = new google.maps.Marker({
    position,
    //label: !cs.isMobileStation ? '' : { color: '#000000', fontWeight: 'regular', fontSize: '14px', className: "marker-label-gps", text: cs.gpsRecordDate },
    label,
    icon: {
      //url: icons[cs.status].icon,
      url:
        cs.status == 1 && jsonMarker[hubOwnerId] != null
          ? //(!cs.isMobileStation ?
            //    jsonMarker[hubOwnerId] :
            //    jsonMarkerMobile[hubOwnerId])
            fnGetMarkerIcon(cs)
          : icons[cs.status].icon,
      //url: cs.status != 1 || Object.keys(jsonMarker).length === 0 ? icons[cs.status].icon : (!cs.isMobileStation ? jsonMarker[hubOwnerId] : jsonMarkerMobile[hubOwnerId]),
      scaledSize: new google.maps.Size(30, 40),
    },
  });

  fnMarker["dataId"] = cs.keyId;
  fnMarker["stationDescription"] = cs.stationDescription;
  fnMarker["description"] = cs.description;
  fnMarker["phone"] = cs.phone;
  fnMarker["evUserAppUrl"] = cs.evUserAppUrl;
  fnMarker["iOSUrl"] = cs.iOSUrl;
  fnMarker["androidUrl"] = cs.androidUrl;
  fnMarker["gpsRecordDate"] = cs.gpsRecordDate;
  fnMarker["gpsTimestamp"] = cs.gpsTimestamp;
  fnMarker["isMobileStation"] = !cs.isMobileStation ? "0" : "1";
  fnMarker["isPrivateStation"] = cs.isPrivateStation
    ? !cs.isPrivateStation
      ? "0"
      : "1"
    : "0";
  fnMarker["hubOwnerId"] = cs.hubOwnerId;
  fnMarker["hasRfidCharge"] = !cs.hasRfidCharge ? "0" : "1";

  return fnMarker;
};
/* End : Function to get marker from station detail */

var fnGetMarkerIconWS = function (selMarker, status) {
  const hubOwnerId = selMarker.hubOwnerId;
  const chargingStatusId = status != null ? status : 0;

  if (selMarker.isMobileStation == "0") {
    if (jsonMarkerType[hubOwnerId] == "s") {
      return jsonMarker[hubOwnerId] + "&s=" + chargingStatusId;
    } else {
      return jsonMarker[hubOwnerId];
    }
  } else {
    if (jsonMarkerMobileType[hubOwnerId] == "s") {
      return jsonMarkerMobile[hubOwnerId] + "&s=" + chargingStatusId;
    } else {
      return jsonMarkerMobile[hubOwnerId];
    }
  }
};

function refreshMarkerStatusWS(stationId, status) {
  //var allMarkers = markers.concat(mobileMarkers).concat(ocpiMarkers);
  var allMarkers = markers.concat(mobileMarkers);
  var selMarker = allMarkers.filter((m) => m.dataId == stationId)[0];

  var iconUrl = fnGetMarkerIconWS(selMarker, status);

  //selMarker.setIcon(iconUrl);
  selMarker.setIcon(
    new google.maps.MarkerImage(
      iconUrl,
      null, //size
      null, //origin
      null, //anchor
      new google.maps.Size(30, 40)
    )
  );
}

function refreshMobileLocation() {
  var cond = getQueryLocationCond();
  var defMobileLocation = $.ajax({
    url: `${serverUrl}/map/GetMobileLocations`,
    type: "POST",
    data: cond,
    dataType: "json",
  });
  $.when(defMobileLocation).done(function (v2) {
    mobileLocations = v2;

    mobileMarkers.forEach((marker) => {
      marker.setMap(null);
    });
    mobileMarkers = [];

    mobileMarkers = mobileLocations
      .filter((cs) => cs.lat !== null && cs.lng !== null)
      .map((cs, i) => {
        var marker = fnGetMarker(cs);
        marker.addListener("click", () => {
          getInfoWindowContent(cs, marker);
        });
        return marker;
      });
    if (mobileClusterRenderer) {
      mobileClusterRenderer.clearMarkers();
      mobileClusterRenderer.addMarkers(mobileMarkers);
    } else {
      mobileClusterRenderer = new markerClusterer.MarkerClusterer({
        markers: mobileMarkers,
        map,
        renderer: new EVRenderer(),
      });
    }

    if (mobileLocCount != v2.length) {
      refreshLocation();
      mobileLocCount = v2.length;
    }
  });
}

function refreshLocation() {
  var cond = getQueryLocationCond();
  var defMobileLocation = $.ajax({
    url: `${serverUrl}/map/GetLocations`,
    type: "POST",
    data: cond,
    dataType: "json",
  });
  $.when(defMobileLocation).done(function (v1) {
    locations = v1;

    markers.forEach((marker) => {
      marker.setMap(null);
    });
    markers = [];

    markers = locations
      .filter((cs) => cs.lat !== null && cs.lng !== null)
      .map((cs, i) => {
        var marker = fnGetMarker(cs);
        marker.addListener("click", () => {
          getInfoWindowContent(cs, marker);
        });
        return marker;
      });
    if (clusterRenderer) {
      clusterRenderer.clearMarkers();
      clusterRenderer.addMarkers(markers);
    } else {
      clusterRenderer = new markerClusterer.MarkerClusterer({
        markers: markers,
        map,
        renderer: new EVRenderer(),
      });
    }
  });
}

class EVRenderer {
  render({ count, position }, stats) {
    console.log("render");
    // change color if this cluster has more markers than the mean cluster
    //const color = count > Math.max(10, stats.clusters.markers.mean) ? "#0000ff" : "#1E90FF";
    const color =
      count > Math.max(10, stats.clusters.markers.mean) ? "#4169E1" : "#00BFFF";
    // create svg url with fill color
    const svg = window.btoa(`
        <svg fill="${color}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 240 240">
            <circle cx="120" cy="120" opacity="1" r="70" />
            <circle cx="120" cy="120" opacity=".6" r="90" />
            <circle cx="120" cy="120" opacity=".3" r="110" />
        </svg>
    `);
    // create marker using svg icon
    return new google.maps.Marker({
      position,
      icon: {
        url: `data:image/svg+xml;base64,${svg}`,
        scaledSize: new google.maps.Size(45, 45),
      },
      label: {
        text: String(count),
        color: "rgba(255,255,255,0.9)",
        fontSize: "12px",
      },
      title: `Cluster of ${count} markers`,
      // adjust zIndex to be above other markers
      zIndex: Number(google.maps.Marker.MAX_ZINDEX) + count,
    });
  }
}

function queryLocation(cond, callback) {
  globalFunction.showLoading("stationLocations");

  var defLocation = $.ajax({
    url: `${serverUrl}/map/GetLocations`,
    type: "POST",
    data: cond,
    dataType: "json",
  });

  var defMobileLocation = $.ajax({
    url: `${serverUrl}/map/GetMobileLocations`,
    type: "POST",
    data: cond,
    dataType: "json",
  });

  $.when(defLocation, defMobileLocation)
    .done(function (v1, v2) {
      locations = v1[0];
      mobileLocations = v2[0];
      mobileLocCount = mobileLocations.length;

      if (!map) {

        map = new google.maps.Map(document.getElementById("map"), {
          center: mapCenter,
          zoom: mapZoom,
          mapTypeControl: false,
          fullscreenControl: false,
          zoomControl: false,
          streetViewControl: false,
        });
        const styledMapType = new google.maps.StyledMapType([
          {
            elementType: "geometry",
            stylers: [
              {
                color: "#f5f5f5",
              },
            ],
          },
          {
            elementType: "labels.icon",
            stylers: [
              {
                visibility: "on",
              },
            ],
          },
          {
            elementType: "labels.text.fill",
            stylers: [
              {
                color: "#616161",
              },
            ],
          },
          {
            elementType: "labels.text.stroke",
            stylers: [
              {
                color: "#f5f5f5",
              },
            ],
          },
          {
            featureType: "administrative.land_parcel",
            elementType: "labels.text.fill",
            stylers: [
              {
                color: "#bdbdbd",
              },
            ],
          },
          {
            featureType: "poi",
            elementType: "geometry",
            stylers: [
              {
                color: "#eeeeee",
              },
            ],
          },
          {
            featureType: "poi",
            elementType: "labels.text.fill",
            stylers: [
              {
                color: "#757575",
              },
            ],
          },
          {
            featureType: "poi.park",
            elementType: "geometry",
            stylers: [
              {
                color: "#e5e5e5",
              },
            ],
          },
          {
            featureType: "poi.park",
            elementType: "labels.text.fill",
            stylers: [
              {
                color: "#9e9e9e",
              },
            ],
          },
          {
            featureType: "road",
            elementType: "geometry",
            stylers: [
              {
                color: "#ffffff",
              },
            ],
          },
          {
            featureType: "road.arterial",
            elementType: "labels.text.fill",
            stylers: [
              {
                color: "#2D8176",
              },
            ],
          },
          {
            featureType: "road.highway",
            elementType: "geometry",
            stylers: [
              {
                color: "#dadada",
              },
            ],
          },
          {
            featureType: "road.highway",
            elementType: "labels.text.fill",
            stylers: [
              {
                color: "#2D8176",
              },
            ],
          },
          {
            featureType: "road.local",
            elementType: "labels.text.fill",
            stylers: [
              {
                color: "#2D8176",
              },
            ],
          },
          {
            featureType: "transit.line",
            elementType: "geometry",
            stylers: [
              {
                color: "#e5e5e5",
              },
            ],
          },
          {
            featureType: "transit.station",
            elementType: "geometry",
            stylers: [
              {
                color: "#eeeeee",
              },
            ],
          },
          {
            featureType: "water",
            elementType: "geometry",
            stylers: [
              {
                color: "#c9c9c9",
              },
            ],
          },
          {
            featureType: "water",
            elementType: "labels.text.fill",
            stylers: [
              {
                color: "#9e9e9e",
              },
            ],
          },
        ]);

        map.mapTypes.set("styled_map", styledMapType);
        map.setMapTypeId("styled_map");

        // Create the search box and link it to the UI element.
        const input = document.getElementById("pac-input");
        const searchBox = new google.maps.places.SearchBox(input);

        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

        // Custom SearchControl
        const searchControlDiv = document.createElement("div");

        SearchControl(searchControlDiv, map, () => {
          //enableFormPopOver();
        });
        map.controls[google.maps.ControlPosition.RIGHT_BOTTOM].push(
          searchControlDiv
        );

        // Custom ResultTableControl
        const resultControlDiv = document.createElement("div");

        ResultTableControl(resultControlDiv, map, () => {
          //enableFormPopOver();
        });
        map.controls[google.maps.ControlPosition.RIGHT_BOTTOM].push(
          resultControlDiv
        );

        // Custom LegendControl
        const legendDiv = document.createElement("div");

        LegendControl(legendDiv, map, () => {
          //enableFormPopOver();
        });
        map.controls[google.maps.ControlPosition.RIGHT_BOTTOM].push(legendDiv);

        // Custom ZoomToFullExtent
        const fullExtentDiv = document.createElement("div");

        ZoomToFullExtent(fullExtentDiv, map, () => {
          //enableFormPopOver();
        });
        map.controls[google.maps.ControlPosition.RIGHT_BOTTOM].push(
          fullExtentDiv
        );

        // Custom CurrentLocationControl
        const currentLocDiv = document.createElement("div");

        CurrentLocationControl(currentLocDiv, map, () => {
          //enableFormPopOver();
        });
        map.controls[google.maps.ControlPosition.RIGHT_BOTTOM].push(
          currentLocDiv
        );

        // Bias the SearchBox results towards current map's viewport.
        map.addListener("bounds_changed", () => {
          searchBox.setBounds(map.getBounds());
        });

        // Listen for the event fired when the user selects a prediction and retrieve
        // more details for that place.
        searchBox.addListener("places_changed", () => {
          const places = searchBox.getPlaces();

          if (places.length == 0) {
            return;
          }

          // For each place, get the icon, name and location.
          const bounds = new google.maps.LatLngBounds();

          places.forEach((place) => {
            if (!place.geometry || !place.geometry.location) {
              console.log("Returned place contains no geometry");
              return;
            }

            if (place.geometry.viewport) {
              // Only geocodes have viewport.
              bounds.union(place.geometry.viewport);
            } else {
              bounds.extend(place.geometry.location);
            }
          });

          map.fitBounds(bounds);
        });

        infoWindow = new google.maps.InfoWindow({
          content: "",
          disableAutoPan: true,
        });
      }

      /* Start : Remove marker from maps */
      markers.forEach((marker) => {
        marker.setMap(null);
      });
      markers = [];
      mobileMarkers.forEach((marker) => {
        marker.setMap(null);
      });
      mobileMarkers = [];
      /* End : Remove marker from maps */

      const resultBounds = new google.maps.LatLngBounds();

      console.log(resultBounds);
      mapExtent = null;
      markers = locations
        .filter((cs) => cs.lat !== null && cs.lng !== null)
        .map((cs, i) => {
          //const label = cs.stationName;

          var marker = fnGetMarker(cs);

          // markers can only be keyboard focusable when they have click listeners
          // open info window when marker is clicked
          marker.addListener("click", () => {
            //const markerContent = `<div class="map-info-window"><div class="info-header"><i class="fas fa-gas-pump"></i> ${cs.stationName}</div><div class="info-content">${cs.address}</div></div>`;

            getInfoWindowContent(cs, marker);

            //infoWindow.setContent(markerContent);
            //infoWindow.open(map, marker);
          });

          resultBounds.extend(marker.position);

          return marker;
        });
      mobileMarkers = mobileLocations
        .filter((cs) => cs.lat !== null && cs.lng !== null)
        .map((cs, i) => {
          var marker = fnGetMarker(cs);
          marker.addListener("click", () => {
            getInfoWindowContent(cs, marker);
          });
          resultBounds.extend(marker.position);
          return marker;
        });

      if (clusterRenderer) {
        clusterRenderer.clearMarkers();
        clusterRenderer.addMarkers(markers);
      } else {
        clusterRenderer = new markerClusterer.MarkerClusterer({
          markers,
          map,
          renderer: new EVRenderer(),
        });
      }
      if (mobileClusterRenderer) {
        mobileClusterRenderer.clearMarkers();
        mobileClusterRenderer.addMarkers(mobileMarkers);
      } else {
        mobileClusterRenderer = new markerClusterer.MarkerClusterer({
          markers: mobileMarkers,
          map,
          renderer: new EVRenderer(),
        });
      }
      // Add a marker clusterer to manage the markers.
      var allMarkers = markers.concat(mobileMarkers);
      if (!resultBounds.isEmpty()) {
        if (allMarkers.length > 1) {
          console.log("aaaaaaaaa");
          if ("" !== "") {
            console.log("if");
            zoomToMapfromHome("");
          } else {
            console.log("else");
            map.fitBounds(resultBounds);
          }

          mapExtent = resultBounds;
        } else {
          const tmpMarker = allMarkers[0];

          const posLat = tmpMarker.getPosition().lat();
          const posLng = tmpMarker.getPosition().lng();

          if ("" !== "") {
            zoomToMapfromHome("");
          } else {
            map.panTo({
              lat: posLat,
              lng: posLng,
            });
            map.setZoom(18);
          }
        }
      } else {
        map.panTo(mapCenter);
        map.setZoom(mapZoom);
      }

      initDataTable(locations.concat(mobileLocations));
      setInterval(function () {
        refreshMobileLocation();
      }, 20000);
    })
    .always(function () {
      globalFunction.hideLoading("stationLocations");
    });
}

function zoomToMapfromHome(KeyId) {
  var allLocations = locations.concat(mobileLocations);
  var allMarkers = markers.concat(mobileMarkers);
  var location = allLocations.filter((l) => l.keyId == KeyId)[0];
  var selMarker = allMarkers.filter((m) => m.dataId == KeyId)[0];

  getInfoWindowContent(location, selMarker);
}

function initMap() {
  var cond = getQueryLocationCond();

  queryLocation(cond, function () {
    // Focus default station
    if (focusStationKeyId) {
      openDetailByStationKey(focusStationKeyId);
    }
  });
}

function initDataTable(locationData) {
  $.fn.dataTable.ext.errMode = "none";
  /*
     * <th>Id</th>
                <th>Station Name</th>
                <th>Type</th>
                <th>CP</th>
                <th>Connectors</th>
                <th>Status</th>
     * */
  var table = $(".dataTables-result").DataTable({
    dom:
      "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-12'f>>" +
      "<'row'<'col-sm-12'tr>>" +
      "<'row'<'col-sm-12'p>>",
    columns: [
      //{ 'data': 'stationId' },
      {
        data: "stationName",
      },
      {
        data: "connectorCount",
        class: "text-center",
      },
      //{
      //    'data': 'status',
      //    render: function (data, type, row, meta) {
      //        if (data == 1) {
      //            return '<span class="status-label station-status-1">' + row.statusName + '</span>';
      //        } else if (data == 2) {
      //            return '<span class="status-label station-status-2">' + row.statusName + '</span>';
      //        } else if (data == 3) {
      //            return '<span class="status-label station-status-3">' + row.statusName + '</span>';
      //        } else if (data == 4) {
      //            return '<span class="status-label station-status-4">' + row.statusName + '</span>';
      //        } else {
      //            return '<span class="status-label">' + row.statusName + '</span>';
      //        }
      //    },
      //    "searchable": false, "class": "text-center", "width": "50px"
      //},
      {
        render: function (data, type, row, meta) {
          if (row.hasLocation) {
            return `<a class="text-primary" data-toggle="tooltip" data-placement="top" title="Zoom To" data-original-title="Zoom To" href="#" data-value="zoom" data-id="${row.keyId}" data-lat="${row.lat}" data-lng="${row.lng}"><i class="fas fa-search-plus"></i></a>`;
          }
          return "";
        },
        searchable: false,
        orderable: false,
        class: "text-center",
        width: "30px",
      },
    ],
    data: locationData,
    searching: true,
    lengthChange: false,
    info: false,
    language: {
      url: dtLangUrl,
    },
    order: [[0, "asc"]],
    destroy: true,
    autoWidth: false,
    pageLength: 5,
  });

  //table.on('preXhr.dt', function (e, settings, data) {
  //    globalFunction.showLoading("processing.dt");
  //});
  //table.on('xhr.dt', function (e, settings, json, xhr) {
  //    globalFunction.hideLoading("processing.dt");
  //});

  table.on("error.dt", function (e, settings, techNote, message) {
    console.log(message);
    globalFunction.alert({
      type: "error",
      message: "เกิดข้อผิดพลาด",
    });
  });

  $(".dataTables-result").on("click", "a", function () {
    if ($(this).data("value") == "zoom") {
      var dataId = $(this).data("id");

      var allLocations = locations.concat(mobileLocations);
      var allMarkers = markers.concat(mobileMarkers);

      var location = allLocations.filter((l) => l.keyId == dataId)[0];
      var selMarker = allMarkers.filter((m) => m.dataId == dataId)[0];

      //var lat = $(this).data("lat");
      //var lng = $(this).data("lng");

      var lat = location.lat;
      var lng = location.lng;

      //map.panTo({ "lat": (lat + 0.0009), "lng": lng });
      //map.setZoom(18);

      //const markerConent = `<div class="map-info-window"><div class="info-header"><i class="fas fa-gas-pump"></i> ${location.stationName}</div><div class="info-content">${location.address}</div></div>`;
      const markerContent = getInfoWindowContent(location, selMarker);

      //infoWindow.setContent(markerContent);
      //infoWindow.open(map, selMarker);
    }
  });

  return table;
}

function getInfoWindowContent(location, marker) {
  // close all popup
  $(".popup-form").hide();
  const posLat = marker.getPosition().lat();
  const posLng = marker.getPosition().lng();
  const googleMapsUrl = `https://google.co.th/maps/place/${posLat},${posLng}`;

  const stationKeyId = location.keyId;
  const checkInUrl = `/galvanic/Main/Index/${stationKeyId}`;

  const addr = marker["fullAddress"]
    ? `<div class="info-content station-description">${marker["fullAddress"]}</div>`
    : "";
  const stationDesc = marker["stationDescription"]
    ? `<div class="info-content station-description small">${marker["stationDescription"]}</div>`
    : "";
  const description = marker["description"]
    ? `<div class="info-content station-description small"><i class="fas fa-info-circle text-primary"></i> ${marker["description"]}</div>`
    : "";

  const btnCall = marker["phone"]
    ? `<a href= "tel:${marker["phone"]}" class="btn btn-outline-primary btn-sm"><i class="fa fa-phone"></i></a>`
    : "";

  const btnCharge = marker["evUserAppUrl"]
    ? `<a href= "${marker["evUserAppUrl"]}" target="_blank" class="btn btn-primary btn-sm"><i class="fa fa-check"></i> <span class="small">Charge Now</span></a>`
    : "";
  const btniOS = marker["iOSUrl"]
    ? `<a href= "${marker["iOSUrl"]}" target="_blank"><img src="${iosIcon}" height="24" /></a>`
    : "";
  const btnAndroid = marker["androidUrl"]
    ? `<a href= "${marker["androidUrl"]}" target="_blank"><img src="${androidIcon}" height="36" /></a>`
    : "";

  const gpsInfo =
    marker["isMobileStation"] == "1"
      ? `<div class="text-primary"><small><i class="fas fa-clock"></i> GPS Time : ${marker["gpsTimestamp"]}</small></div>`
      : "";

  const privateStationInfo =
    marker["isPrivateStation"] == "1"
      ? `<div><span class="badge rounded-pill bg-danger"><i class="fas fa-lock"></i> ${privateStationLabel}</span></div>`
      : "";

  const rfidChargeAbility =
    marker["hasRfidCharge"] == "1"
      ? `<span class="badge rounded-pill bg-primary"><i class="fas fa-check"></i> RFID</span>`
      : "";
  //const abilityInfo = `<div>${plugAndChargeAbility}${plugAndChargeAbility.length > 0 ? " " : ""}${rfidChargeAbility}</div>`;
  const abilityInfo = `<div>${rfidChargeAbility}</div>`;

  //let _imgDiv = "";
  //if (location.stationImage != "" && location.stationImage != null) {
  //    _imgDiv = '<div class="col-12 mt-3 text-center"><img src = "' + location.stationImage + '" style="max-width:inherit; max-height: 200px;" crossorigin = "anonymous" /></div >';
  //}

  let _imgDiv = "";
  if (location.stationImages != null && location.stationImages.length > 0) {
    let btnGallery = "";
    let imageGallery = "";
    _imgDiv = '<div class="col-12 mt-3 text-center">';
    _imgDiv +=
      '<div id="carouselExampleIndicators" class="carousel slide text-center" data-bs-ride="carousel">';
    $.each(location.stationImages, function (key, value) {
      let isImgActive = "";
      if (key == 0) {
        isImgActive = "active";
      }
      btnGallery +=
        '<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="' +
        key +
        '" class="' +
        isImgActive +
        '" aria-current="true" aria-label="Slide ' +
        (key + 1) +
        '"></button>';

      imageGallery += '<div class="carousel-item ' + isImgActive + '">';
      imageGallery +=
        '<img src="' +
        value +
        '" class="d-block mx-auto" alt="..." style="max-width:inherit; max-height: 200px; width:auto; height:auto; display: block;" crossorigin = "anonymous">';
      imageGallery += "</div>";
    });

    _imgDiv += '<div class="carousel-indicators">';
    _imgDiv += btnGallery;
    _imgDiv += "</div>";

    _imgDiv += '<div class="carousel-inner">';
    _imgDiv += imageGallery;
    _imgDiv += "</div>";

    _imgDiv +=
      '<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">';
    _imgDiv +=
      '<span class="carousel-control-prev-icon" aria-hidden="true"></span>';
    _imgDiv += '<span class="visually-hidden">Previous</span>';
    _imgDiv += "</button>";
    _imgDiv +=
      '<button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">';
    _imgDiv +=
      '<span class="carousel-control-next-icon" aria-hidden="true"></span>';
    _imgDiv += '<span class="visually-hidden">Next</span>';
    _imgDiv += "</button>";

    _imgDiv += "</div>";
    _imgDiv += "</div>";
  }

  const markerHeader = `
        <div class="info-header p-3">
            <div class="row">
                <div class="col-12 small text-center">
                    <i class="fas fa-charging-station"></i> ${location.stationName}${stationDesc}${description}${privateStationInfo}${abilityInfo}
                </div>
            </div>
            ${_imgDiv}
            <div class="row text-center mt-2">
              <hr>
                <div class="col-12 mt-2 mb-2 p-0">
                    <button type="button" class="btn btn-outline-primary btn-sm" id="btnViewDetail"><i class="fa fa-info-circle"></i> <span class="small">รายละเอียด<span></button>
                    ${btnCall}
                    <a href="${googleMapsUrl}" target="_blank" class="btn btn-outline-primary btn-sm" title="นำทาง"><i class="fas fa-directions" style="color: #635bff;"></i></a>
                    <button type="button" class="btn btn-primary btn-sm btnCheckIn" data-url="${checkInUrl}"><i class="fa fa-check"></i> <span class="small">เช็คอิน<span></button>
                </div>
            </div>
            ${gpsInfo}
        </div>`;
  const markerConent = `<div class="map-info-window">${markerHeader}</div>`;

  infoWindow.addListener("domready", () => {
    var tooltipTriggerList = [].slice.call(
      document.querySelectorAll('[data-bs-toggle="tooltip"]')
    );
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // Clear previous event listener
    $("#btnViewDetail").off("click");

    $("#btnViewDetail").click(function () {
      getInfoWindowContentDetail(location, marker);
    });
  });

  infoWindow.setContent(markerConent);
  infoWindow.setOptions({
    minWidth: 350,
    maxWidth: 350,
  });
  infoWindow.open(map, marker);

  let latAdj = 0.0002;
  if (_imgDiv.length > 0) {
    latAdj = 0.0007;
  }

  //map.panTo({ "lat": (posLat + 0.0009), "lng": posLng });
  map.panTo({
    lat: posLat + latAdj,
    lng: posLng,
  });

  map.setZoom(18);
}

function getInfoWindowContentDetail(location, marker) {
  var keyId = location.keyId;
  const arrDay = [
    "อาทิตย์",
    "จันทร์",
    "อังคาร",
    "พุธ",
    "พฤหัส",
    "ศุกร์",
    "เสาร์",
  ];

  var getBadgeClass = (cnStatus) => {
    if (cnStatus) {
      if (cnStatus.toLowerCase() === "available") {
        return "bg-success";
      } else if (cnStatus.toLowerCase() === "offline") {
        return "bg-secondary";
      } else {
        return "bg-warning text-dark";
      }
    } else {
      return "bg-light text-dark";
    }
  };

  var getStatusBgClass = (cnStatus) => {
    if (cnStatus) {
      if (cnStatus.toLowerCase() === "available") {
        return "bg-white border border-success";
      } else if (cnStatus.toLowerCase() === "offline") {
        return "bg-light text-secondary";
      } else {
        return "bg-white border border-warning";
      }
    } else {
      return "bg-light text-secondary";
    }
  };

  var getConnectorDetail = (cn, cp, stationKey) => {
    console.log("cn", cn);
    console.log("cp", cp);
    //const badgeStatus = cn.ConnectorStatus && cn.ConnectorStatus.toLowerCase() === "available" ? `<span class="badge rounded-pill bg-success">${cn.ConnectorStatus}</span>` : `<span class="badge rounded-pill bg-warning text-dark">${cn.ConnectorStatus ? cn.ConnectorStatus : "N/A"}</span>`;
    const badgeStatus = `<span class="badge rounded-pill small ${getBadgeClass(
      cn.ConnectorStatus
    )}">${
      cn.ConnectorStatusDisplay ? cn.ConnectorStatusDisplay : "N/A"
    }</span>`;
    const iconImgUrl = cn.ConnectorIconUrl ? cn.ConnectorIconUrl : "";
    const iconImg = cn.ConnectorTypeId
      ? `<img class="img-connector-icon mx-auto d-block" src="${iconImgUrl}" />`
      : "";

    let selectedDate = "";

    let btnReserve =
      '<a href="/galvanic/Reserve/Form/' +
      stationKey +
      "/" +
      cn.ConnectorKey +
      '/20240722" class="btn btn-outline-primary btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="จอง"><i class="far fa-calendar-plus"></i></a>';

    // Check has reserve
    const ownerHasReserve = true;
    if (!ownerHasReserve || !cp.HasReserve) {
      btnReserve = "";
    }

    let conDetailContent = `<span class="text-primary small ps-1 fw-bolder"> ${
      cn.ServiceCharge
    }${cn.StationServiceFee ? "**" : ""}</span>`;
    if (cn.IsTouMeter && cn.ServiceChargeOnPeak && cn.ServiceChargeOffPeak) {
      conDetailContent = `
                    <table>
                        <tbody>
                            <tr>
                                <td class="ps-1">
                                    <small class="text-primary">On Peak: ${
                                      cn.ServiceChargeOnPeak
                                    }${
        cn.StationServiceFee ? "**" : ""
      }</small><br>
                                    <small class="text-primary">Off Peak: ${
                                      cn.ServiceChargeOffPeak
                                    }${cn.StationServiceFee ? "**" : ""}</small>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                `;
    }

    return `<div class="connector-info d-flex justify-content-between align-items-center p-2 mb-2 ${getStatusBgClass(
      cn.ConnectorStatus
    )}"><div class="small">${iconImg}${badgeStatus}</div><div class="flex-fill small ps-1"> ${
      cn.ConnectorTypeName
    } (${cn.ChargerType ? cn.ChargerType : "N/A"}) ${getOutputPowerDetail2(
      cn
    )} <br /> ${conDetailContent}</div><div class="">${btnReserve}</div></div>`;
  };

  var getWorkingHourDetail = (s) => {
    if (!s.IsAlldayOpen) {
      if (s.WorkingHour.length > 0) {
        const serviceInfo = s.WorkingHour.map(
          (wh) =>
            `<div class="row"><div class="col-6">${
              arrDay[wh.DayWeekId - 1]
            }</div><div class="col-6 text-primary text-end">${wh.OpenTime.substring(
              0,
              5
            )} - ${wh.CloseTime.substring(0, 5)}</div></div>`
        ).join("");
        return `<div class="info-content"><div class="small text-secondary">เวลาให้บริการ</div><div class="service-info p-3 small mb-3">${serviceInfo}</div></div>`;
      } else {
        return "";
      }
    } else {
      return `<div class="info-content"><div class="small text-secondary">เวลาให้บริการ</div><div class="service-info p-3 small text-primary text-center mb-3"><i class="fas fa-clock"></i> เปิดให้บริการ 24/7</div></div>`;
    }
  };

  var getOutputPowerDetail = (cp) => {
    if (cp.OutputPower) {
      //return ` : <span>${cp.OutputPower} kW</span>`;
      return ` : <span>${cp.OutputPowerFormat} kW</span>`;
    } else {
      return ` : <span>N/A kW</span>`;
    }
  };
  var getOutputPowerDetail2 = (cp) => {
    if (cp.OutputPower) {
      //return ` : <span>${cp.OutputPower} kW</span>`;
      return ` : <span>${cp.OutputPowerFormat} kW</span>`;
    } else {
      return `<span></span>`;
    }
  };

  var getAmenitiesDetail = (data) => {
    //let amntInfo = ' N/A';
    //if (data.Amenities.length > 0) {
    //    amntInfo = `<ul>${data.Amenities.map((a) => `<li><i class="${a.ICON}" style="min-width: 20px;"></i> ${a.AMENITY_NAME}</li>`).join("")}<ul>`;
    //}
    //return `<div class="info-content"><div class="text-center bg-primary bg-gradient text-white p-1 mt-2 mb-2" style="font-weight: 900;">Amenities</div><div class="amenity-info">${amntInfo}</div></div>`;

    let amntInfo = " N/A ";
    if (data.Amenities.length > 0) {
      amntInfo = `<div class="text-center">${data.Amenities.map(
        (a) =>
          `<i class="${a.Icon} text-primary ms-1 me-1" style="cursor: pointer;" data-bs-toggle="tooltip" data-bs-placement="top" title="${a.AmenityName}"></i> `
      ).join("")}<ul>`;
      return `<div class="info-content"><div class="small text-secondary">สิ่งอำนวยความสะดวก</div><div class="amenity-info p-3 pb-2 mb-3">${amntInfo}</div></div>`;
    }
    return "";
  };

  var getPaymentMethodsDetail = (data) => {
    let paymentMethodInfo = " N/A ";
    if (data.PaymentMethods.length > 0) {
      paymentMethodInfo = `<div class="text-center">${data.PaymentMethods.map(
        (a) => `<img src="${a.IconUrlPng}" height="30" class="ms-1 me-1" /> `
      ).join("")}<ul>`;
      return `<div class="info-content"><div class="small text-secondary">ช่องทางชำระค่าบริการ</div><div class="payment-info p-3 pb-2">${paymentMethodInfo}</div></div>`;
    }
    return "";
  };

  var getChargePointChargeAbilityDetail = (cp) => {
    //const plugAndChargeAbility = cp.HasPlugNCharge ? `<span class="badge rounded-pill bg-primary"><i class="fas fa-check"></i> Plug&Charge</span>` : "";
    const rfidChargeAbility = cp.HasRfidCharge
      ? `<span class="badge rounded-pill bg-primary"><i class="fas fa-check"></i> RFID</span>`
      : "";
    let abilityInfo = "";

    //if (plugAndChargeAbility.length > 0 || rfidChargeAbility.length > 0) {
    //    abilityInfo = `<div style="margin-bottom: 5px;">${plugAndChargeAbility}${plugAndChargeAbility.length > 0 ? " " : ""}${rfidChargeAbility}</div>`;
    //}
    abilityInfo = `<div style="margin-bottom: 5px;">${rfidChargeAbility}</div>`;

    return abilityInfo;
  };

  globalFunction.showLoading("stationDetail");
  $.ajax({
    url: `${serverUrl}/map/GetDetail`,
    type: "POST",
    data: {
      keyId,
    },
    dataType: "json",
    success: function (data) {
      globalFunction.hideLoading("stationDetail");

      const posLat = marker.getPosition().lat();
      const posLng = marker.getPosition().lng();
      const googleMapsUrl = `https://google.co.th/maps/place/${posLat},${posLng}`;

      const stationKeyId = data.KeyId;
      const checkInUrl = `/galvanic/Main/Index/${stationKeyId}`;

      const stationDesc = marker["stationDescription"]
        ? `<div class="info-content station-description small">${marker["stationDescription"]}</div>`
        : "";
      const description = data.Description
        ? `<div class="info-content station-description small"><i class="fas fa-info-circle text-primary"></i> ${data.Description}</div>`
        : "";

      const btnCall = data.Phone
        ? `<a href= "tel:${data.Phone}" style="margin-right: 5px;" class="btn btn-outline-primary btn-sm"><i class="fa fa-phone"></i> <span class="small">โทร</span></a>`
        : "";
      const btnWebsite = data.Website
        ? `<a href="${data.Website}" style="margin-right: 5px;" target="_blank" class="btn btn-outline-primary btn-sm" title="Website"><i class="fa fa-globe"></i> <span class="small"> <span></a>`
        : "";
      const btnIot = data.IotUrl
        ? `<a href="${data.IotUrl}" style="margin-right: 5px;" target="_blank" class="btn btn-outline-primary btn-sm" title="Information">AQI</a>`
        : "";
      const btnIssueReport = `<a href="/galvanic/ProblemReport/Form?s=${stationKeyId}" style="margin-right: 5px;" class="btn btn-outline-primary btn-sm" title="Information"><i class="fas fa-info-circle"></i> <span class="small">รายงานปัญหา<span></a><p class="d-md-none"></p>`;

      //const cpList = data.ChargePoints.map((cp) => `<div><i class="fas fa-charging-station"></i> ${cp.ChargePointName}${getOutputPowerDetail(cp)}</div>${cp.Connectors.map((cn) => getConnectorDetail(cn, cp, stationKeyId)).join("")}<hr />`).join("");
      const cpList = data.ChargePoints.map(
        (cp) =>
          `<div class="small">${
            cp.ChargePointName
          }${getChargePointChargeAbilityDetail(cp)}</div>${cp.Connectors.map(
            (cn) => getConnectorDetail(cn, cp, stationKeyId)
          ).join("")}<hr />`
      ).join("");
      const cpInfo =
        data.ChargePoints.length > 0
          ? `<div class="info-content"><div class="small text-secondary">จุดบริการ</div><div>${cpList}</div></div>`
          : "";

      const whInfo = getWorkingHourDetail(data);
      const amntInfo = getAmenitiesDetail(data);
      const paymentInfo = getPaymentMethodsDetail(data);
      const serviceFeeInfo = data.StationHasServiceFee
        ? `<div class="text-secondary small text-end">** ค่าธรรมเนียมสถานี : ${data.StationServiceFee}</div>`
        : "";

      const privateStationInfo =
        data.IsPrivateStation == "1"
          ? `<div style="margin-bottom: 5px;"><span class="badge rounded-pill bg-danger"><i class="fas fa-lock"></i> ${privateStationLabel}</span></div>`
          : "";

      const markerHeader = `
                <div class="info-header">
                    <div class="row">
                        <div class="col-12 small text-center">
                            <i class="fas fa-charging-station"></i> ${location.stationName} ${stationDesc} ${description} ${privateStationInfo}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 text-center">
                           ${btnWebsite}${btnIot}${btnCall}${btnIssueReport}
                            <a href="${googleMapsUrl}" target="_blank" class="btn btn-outline-primary btn-sm" title="นำทาง"><i class="fas fa-directions" style="color: #635bff;"></i> <span class="small">นำทาง<span></a>
                            <button type="button" class="btn btn-primary btn-sm btnCheckIn" data-url="${checkInUrl}"><i class="fa fa-qrcode"></i> <span class="small">เช็คอิน<span></button>
                        </div>
                    </div>
                    <hr/>
                </div>`;
      const markerConent = `<div class="map-info-window">${markerHeader}${cpInfo}${serviceFeeInfo}${whInfo}${amntInfo}${paymentInfo}</div>`;

      //infoWindow.addListener("domready", () => {
      //    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
      //    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
      //        return new bootstrap.Tooltip(tooltipTriggerEl)
      //    })
      //});

      //infoWindow.setContent(markerConent);
      //infoWindow.setOptions({
      //    minWidth: 400
      //});
      //infoWindow.open(map, marker);

      //map.panTo({ "lat": (posLat + 0.0009), "lng": posLng });
      //map.setZoom(18);

      // Show modal
      globalFunction.alert({
        title:
          '<i class="fa fa-info-circle" style="color:#1B95E0"></i> ข้อมูลสถานี',
        message: markerConent,
        fullCloseButton: false,
      });
    },
    error: function () {
      globalFunction.hideLoading("stationDetail");
    },
  });
}
