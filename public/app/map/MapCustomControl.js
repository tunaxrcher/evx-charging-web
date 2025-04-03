/**
 * The CenterControl adds a control to the map that recenters the map on
 * Chicago.
 * This constructor takes the control DIV as an argument.
 * @constructor
 */
function SearchControl(controlDiv, map, searchControlReady) {
  // Set CSS for the control border.
  //const controlUI = document.createElement("div");
  const controlUI = $(`<div></div>`)[0];

  controlUI.style.backgroundColor = "#1a2537";
  controlUI.style.border = "2px solid #1a2537";
  controlUI.style.borderRadius = "3px";
  controlUI.style.boxShadow = "0 2px 6px rgba(0,0,0,.3)";
  controlUI.style.cursor = "pointer";
  controlUI.style.marginBottom = "8px";
  //controlUI.style.marginBottom = "22px";
  controlUI.style.marginRight = "12px";
  controlUI.style.textAlign = "center";
  //controlUI.title = "Click to recenter the map";
  controlDiv.appendChild(controlUI);

  // Set CSS for the control interior.
  //const controlText = document.createElement("div");
  const controlText = $(`<a></a>`)[0];

  //controlText.style.color = "rgb(105, 105, 105)";
  controlText.style.fontSize = "22px";
  controlText.style.lineHeight = "38px";
  controlText.style.paddingLeft = "5px";
  controlText.style.paddingRight = "5px";
  controlText.style.marginBottom = "5px";
  controlText.innerHTML = `<i class="fas fa-tools"></i>`;
  controlText.classList.add("custom-map-control-button");
  controlUI.appendChild(controlText);
  // Setup the click event listeners: simply set the map to Chicago.
  controlUI.addEventListener("click", () => {
    $("#divSearch").toggle();
    $("#divResultTable").hide();
    $("#divLegend").hide();
  });

  if (searchControlReady) {
    searchControlReady();
  }
}

function ResultTableControl(controlDiv, map, searchControlReady) {
  // // Set CSS for the control border.
  // //const controlUI = document.createElement("div");
  // const controlUI = $(`<div></div>`)[0];

  // controlUI.style.backgroundColor = "#1a2537";
  // controlUI.style.border = "2px solid #1a2537";
  // controlUI.style.borderRadius = "3px";
  // controlUI.style.boxShadow = "0 2px 6px rgba(0,0,0,.3)";
  // controlUI.style.cursor = "pointer";
  // controlUI.style.marginBottom = "8px";
  // //controlUI.style.marginBottom = "22px";
  // controlUI.style.marginRight = "12px";
  // controlUI.style.textAlign = "center";
  // //controlUI.title = "Click to recenter the map";
  // controlDiv.appendChild(controlUI);

  // // Set CSS for the control interior.
  // //const controlText = document.createElement("div");
  // const controlText = $(`<a></a>`)[0];

  // //controlText.style.color = "rgb(105, 105, 105)";
  // controlText.style.fontSize = "22px";
  // controlText.style.lineHeight = "38px";
  // controlText.style.paddingLeft = "5px";
  // controlText.style.paddingRight = "5px";
  // controlText.style.marginBottom = "5px";
  // controlText.innerHTML = `<i class="fas fa-table"></i>`;
  // controlText.classList.add("custom-map-control-button");
  // controlUI.appendChild(controlText);
  // // Setup the click event listeners: simply set the map to Chicago.
  // controlUI.addEventListener("click", () => {
  //   $("#divSearch").hide();
  //   $("#divResultTable").toggle();
  //   $("#divLegend").hide();
  // });

  // if (searchControlReady) {
  //   searchControlReady();
  // }
}

function CurrentLocationControl(controlDiv, map, controlReady) {
  // Set CSS for the control border.
  //const controlUI = document.createElement("div");
  const controlUI = $(`<div></div>`)[0];

  controlUI.style.backgroundColor = "#1a2537";
  controlUI.style.border = "2px solid #1a2537";
  controlUI.style.borderRadius = "3px";
  controlUI.style.boxShadow = "0 2px 6px rgba(0,0,0,.3)";
  controlUI.style.cursor = "pointer";
  controlUI.style.marginBottom = "8px";
  //controlUI.style.marginBottom = "22px";
  controlUI.style.marginRight = "12px";
  controlUI.style.textAlign = "center";
  controlUI.style.width = "36px";
  //controlUI.title = "Click to recenter the map";
  controlDiv.appendChild(controlUI);

  // Set CSS for the control interior.
  //const controlText = document.createElement("div");
  const controlText = $(`<a></a>`)[0];

  controlText.style.color = "rgb(105, 105, 105)";
  controlText.style.fontSize = "22px";
  controlText.style.lineHeight = "38px";
  controlText.style.paddingLeft = "5px";
  controlText.style.paddingRight = "5px";
  controlText.style.marginBottom = "5px";
  //controlText.innerHTML = `<i class="far fa-compass"></i>`;
  controlText.innerHTML = `<i class="fa-solid fa-location-crosshairs" style="color: #ffffff;"></i>`;
  controlText.classList.add("custom-map-control-button");
  controlUI.appendChild(controlText);
  // Setup the click event listeners: simply set the map to Chicago.
  let currentLocMarker = null;
  controlUI.addEventListener("click", () => {
    $("#divSearch").hide();
    $("#divResultTable").hide();

    // Try HTML5 geolocation.
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(
        (position) => {
          const pos = {
            lat: position.coords.latitude,
            lng: position.coords.longitude,
          };

          if (currentLocMarker) {
            currentLocMarker.setMap(null);
          }
          currentLocMarker = new google.maps.Marker({
            animation: google.maps.Animation.BOUNCE,
            position: pos,

            icon: {
              //path: `M12 2c-4.97 0-9 4.03-9 9 0 4.17 2.84 7.67 6.69 8.69L12 22l2.31-2.31C18.16 18.67 21 15.17 21 11c0-4.97-4.03-9-9-9zm0 2c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.3c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z`
              //path: 'M10.453 14.016l6.563-6.609-1.406-1.406-5.156 5.203-2.063-2.109-1.406 1.406zM12 2.016q2.906 0 4.945 2.039t2.039 4.945q0 1.453-0.727 3.328t-1.758 3.516-2.039 3.070-1.711 2.273l-0.75 0.797q-0.281-0.328-0.75-0.867t-1.688-2.156-2.133-3.141-1.664-3.445-0.75-3.375q0-2.906 2.039-4.945t4.945-2.039z'
              path: "M12,2C8.14,2,5,5.14,5,9c0,5.25,7,13,7,13s7-7.75,7-13C19,5.14,15.86,2,12,2z M12,4c1.1,0,2,0.9,2,2c0,1.11-0.9,2-2,2 s-2-0.89-2-2C10,4.9,10.9,4,12,4z M12,14c-1.67,0-3.14-0.85-4-2.15c0.02-1.32,2.67-2.05,4-2.05s3.98,0.73,4,2.05 C15.14,13.15,13.67,14,12,14z",
              fillColor: "#ff4500",
              fillOpacity: 0.9,
              strokeWeight: 0.8,
              strokeColor: "#1a25371a2537",
              rotation: 0,
              scale: 2,
              anchor: new google.maps.Point(11, 22),
            },

            //icon: {
            //    path: google.maps.SymbolPath.CIRCLE
            //}
          });
          currentLocMarker.setMap(map);

          //const fixMarker = new google.maps.Marker({
          //    //animation: google.maps.Animation.BOUNCE,
          //    position: pos,
          //});
          //fixMarker.setMap(map);

          map.panTo(pos);
          map.setZoom(18);
        },
        () => {
          handleLocationError(true, map.getCenter());
        }
      );
    } else {
      // Browser doesn't support Geolocation
      handleLocationError(false, map.getCenter());
    }
  });

  if (controlReady) {
    controlReady();
  }

  var handleLocationError = function (browserHasGeolocation, pos) {
    //const errMsg = browserHasGeolocation
    //    ? "Error: The Geolocation service failed."
    //    : "Error: Your browser doesn't support geolocation."

    var dataLang =
      document.cookie
        .match("(^|;)\\s*" + "web_culture" + "\\s*=\\s*([^;]+)")
        ?.pop() || "";
    i18next.init({
      lng: dataLang, // if you're using a language detector, do not define the lng option
      debug: true,
      fallbackLng: "en",
      resources: {
        en: {
          translation: {
            geoLocationFailed:
              "Please allow access to your location for the use of current location search.",
            browserNotSupport:
              "Your web browser does not support access to current location information.",
          },
        },
        th: {
          translation: {
            geoLocationFailed:
              "กรุณาอนุญาตการเข้าถึงตำแหน่งของท่าน เพื่อการใช้งานการค้นหาตำแหน่งปัจจุบัน",
            browserNotSupport:
              "เว็บเบราเซอร์ของท่านไม่สนับสนันการเข้าถึงข้อมูลตำแหน่งปัจจุบัน",
          },
        },
        "zh-CN": {
          translation: {
            geoLocationFailed: "请允许访问您的位置，以便使用当前位置搜索",
            browserNotSupport: "您的网络浏览器无法访问当前位置信息",
          },
        },
        lo: {
          translation: {
            geoLocationFailed:
              "ກະລຸນາອະນຸຍາດໃຫ້ເຂົ້າເຖິງສະຖານທີ່ຂອງທ່ານສໍາລັບການນໍາໃຊ້ການຊອກຫາສະຖານທີ່ໃນປັດຈຸບັນ",
            browserNotSupport:
              "ເວັບໄຊທ໌ຂອງທ່ານບໍ່ສະຫນັບສະຫນູນການເຂົ້າເຖິງຂໍ້ມູນສະຖານທີ່ໃນປັດຈຸບັນ",
          },
        },
      },
    });

    //const errMsg = browserHasGeolocation
    //    ? "กรุณาอนุญาตการเข้าถึงตำแหน่งของท่าน เพื่อการใช้งานการค้นหาตำแหน่งปัจจุบัน"
    //    : "เว็บเบราเซอร์ของท่านไม่สนับสนันการเข้าถึงข้อมูลตำแหน่งปัจจุบัน"

    const errMsg = browserHasGeolocation
      ? i18next.t("geoLocationFailed")
      : i18next.t("browserNotSupport");

    // Show modal
    globalFunction.alert({
      message: errMsg,
      fullCloseButton: false,
    });
  };
}

function LegendControl(controlDiv, map, controlReady) {
  // Set CSS for the control border.
  //const controlUI = document.createElement("div");
  const controlUI = $(`<div></div>`)[0];

  controlUI.style.backgroundColor = "#1a2537";
  controlUI.style.border = "2px solid #1a2537";
  controlUI.style.borderRadius = "3px";
  controlUI.style.boxShadow = "0 2px 6px rgba(0,0,0,.3)";
  controlUI.style.cursor = "pointer";
  controlUI.style.marginBottom = "8px";
  //controlUI.style.marginBottom = "22px";
  controlUI.style.marginRight = "12px";
  controlUI.style.textAlign = "center";
  //controlUI.title = "Click to recenter the map";
  controlDiv.appendChild(controlUI);

  // Set CSS for the control interior.
  //const controlText = document.createElement("div");
  const controlText = $(`<a></a>`)[0];

  //controlText.style.color = "rgb(105, 105, 105)";
  controlText.style.fontSize = "20px";
  controlText.style.lineHeight = "38px";
  controlText.style.paddingLeft = "5px";
  controlText.style.paddingRight = "5px";
  controlText.style.marginBottom = "5px";
  controlText.innerHTML = `<i class="fas fa-layer-group"></i>`;
  controlText.classList.add("custom-map-control-button");
  controlUI.appendChild(controlText);
  // Setup the click event listeners: simply set the map to Chicago.
  controlUI.addEventListener("click", () => {
    $("#divSearch").hide();
    $("#divResultTable").hide();
    $("#divLegend").toggle();
  });

  if (controlReady) {
    controlReady();
  }
}

function ZoomToFullExtent(controlDiv, map, controlReady) {
  // Set CSS for the control border.
  //const controlUI = document.createElement("div");
  const controlUI = $(`<div></div>`)[0];

  controlUI.style.backgroundColor = "#1a2537";
  controlUI.style.border = "2px solid #1a2537";
  controlUI.style.borderRadius = "3px";
  controlUI.style.boxShadow = "0 2px 6px rgba(0,0,0,.3)";
  controlUI.style.cursor = "pointer";
  controlUI.style.marginBottom = "8px";
  //controlUI.style.marginBottom = "22px";
  controlUI.style.marginRight = "12px";
  controlUI.style.textAlign = "center";
  controlUI.title = "Zoom to full extent";
  controlDiv.appendChild(controlUI);

  // Set CSS for the control interior.
  //const controlText = document.createElement("div");
  const controlText = $(`<a></a>`)[0];

  //controlText.style.color = "rgb(105, 105, 105)";
  controlText.style.fontSize = "22px";
  controlText.style.lineHeight = "38px";
  controlText.style.paddingLeft = "5px";
  controlText.style.paddingRight = "5px";
  controlText.style.marginBottom = "5px";
  controlText.innerHTML = `<i class="fas fa-globe-americas"></i>`;
  controlText.classList.add("custom-map-control-button");
  controlUI.appendChild(controlText);
  // Setup the click event listeners: simply set the map to Chicago.
  controlUI.addEventListener("click", () => {
    //alert(typeof (mapExtent));
    console.log(mapExtent);
    if (mapExtent !== null) {
      if (infoWindow) {
        infoWindow.close();
      }

      map.fitBounds(mapExtent);
    }
  });

  if (controlReady) {
    controlReady();
  }
}
