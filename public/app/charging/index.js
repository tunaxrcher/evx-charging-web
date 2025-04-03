var html5QrcodeScanner;
var stepsFormGoNext;

$(document).ready(function () {
  loadTransectionStatus();
});

var i = 0;
function move() {
  if (i == 0) {
    i = 1;
    var elem = document.getElementById("myBar");
    var width = 1;
    var id = setInterval(frame, 15);
    function frame() {
      if (width >= 100) {
        clearInterval(id);
        i = 0;
      } else {
        width++;
        elem.style.width = width + "%";
      }
    }
  }
}

function wait(ms) {
  var start = new Date().getTime();
  var end = start;
  while (end < start + ms) {
    end = new Date().getTime();
  }
}

var totalSeconds = 0;
var dateDiffMinPub = 0;
var dateDiffHoursPub = 0;
var price_Kw = 0;
var monetary_unit;
var sum_price = 0;
var sum_Kw = 0;
var sum_min;
var blink;
var blinkStart;
var getActive;
var timer_count_start_charge;
var checkFinishStatus;
var ev_chargepoint_name;
var connectorId;
var obj_status;
var callStatusCharge;
var chargePointSelectList;
var idTag;
var connector_pk_pub;
var transactionId;

//Custom design form example
stepsFormGoNext = $(".tab-charger").steps({
  headerTag: "h6",
  bodyTag: "section",
  transitionEffect: "fade",
  titleTemplate: '<span class="step">#index#</span> #title#',
  // labels: {
  //   finish: "Submit",
  // },
  onInit: function (event, current) {
    $(".actions > ul > li:first-child").attr("style", "display:none");
    $(".actions > ul > li:nth-child(2)").attr("style", "display:none");
  },
  onStepChanged: function (event, current, next) {
    if (current > 1 && current < 3) {
      $(".actions > ul > li:first-child").attr("style", "");
      $(".actions > ul > li:nth-child(2)").attr("style", "display:none");
    } else {
      $(".actions > ul > li:first-child").attr("style", "display:none");
      // $(".actions > ul > li:nth-child(2)").attr("style", "display:none");
    }
  },
  onFinished: function (event, currentIndex) {},
});

$("#click-scan").click(function () {
  document.getElementById("scan_station").style.display = "none";
  document.getElementById("scan_page").style.display = "block";
  document.getElementById("step_station").style.display = "none";

  html5QrcodeScanner = new Html5QrcodeScanner("reader", {
    fps: 10,
    qrbox: 350,
  });
  html5QrcodeScanner.render(onScanSuccess);
});

function searchStation(eve) {
  if (event.key === "Enter") {
    let evxstation = eve.value;

    let dataObj = {
      evxstation,
    };

    $.ajax({
      type: "POST",
      url: `${serverUrl}/charging/GetStation`,
      contentType: "application/json; charset=utf-8;",
      processData: false,
      data: JSON.stringify(dataObj),
      success: function (res) {
        if (res.success === 1) {
          document.getElementById("scan_station").style.display = "none";
          document.getElementById("scan_page").style.display = "none";
          document.getElementById("step_station").style.display = "block";

          $("#cp").html(
            "<span class='float-end fw-bold text-primary' >" +
              res.data.charge_box_id +
              "</span></p>"
          );

          setInterval(function () {
            $(".blinkConnect").fadeToggle();
          }, 100);

          getConnectByChargePoint(res.data.charge_box_id);
        } else {
        }
      },
      error: function (res) {},
    });
  }
}

function searchStationScan(eve) {
  let evxstation = eve;

  let dataObj = {
    evxstation,
  };

  $.ajax({
    type: "POST",
    url: `${serverUrl}/charging/GetStation`,
    contentType: "application/json; charset=utf-8;",
    processData: false,
    data: JSON.stringify(dataObj),
    success: function (res) {
      if (res.success === 1) {
        html5QrcodeScanner.clear();
        document.getElementById("scan_station").style.display = "none";
        document.getElementById("scan_page").style.display = "none";
        document.getElementById("step_station").style.display = "block";

        $("#cp").html(
          "<span class='float-end fw-bold text-primary' >" +
            res.data.charge_box_id +
            "</span></p>"
        );

        setInterval(function () {
          $(".blinkConnect").fadeToggle();
        }, 100);

        blink = setInterval(function () {
          $(".blink").fadeToggle();
        }, 100);

        getConnectByChargePoint(res.data.charge_box_id);
      } else {
        Swal.fire({
          icon: "warning",
          text: `ไม่พบหัวชาร์จ`,
          timer: "2000",
          heightAuto: false,
        });
      }
    },
    error: function (res) {},
  });
}

function getConnectByChargePoint(ev_cp) {
  let dataObj = {
    ev_cp,
  };

  ev_chargepoint_name = ev_cp;

  $.ajax({
    type: "POST",
    url: `${serverUrl}/charging/getConnecter`,
    contentType: "application/json; charset=utf-8;",
    processData: false,
    data: JSON.stringify(dataObj),
    success: function (res) {
      if (res.success === 1) {
        var html_box_connector = "";

        for (let index = 0; index < res.data.length; index++) {
          html_box_connector +=
            '<div class="col-sm-12 text-center mb-2 border">' +
            '<a href="javascript:void(0)" onclick="clickSelectConnector(' +
            res.data[index].connector_pk.toString() +
            ');" class="bg-hover-a-link">' +
            '<div class="card">' +
            '<div class="card-body py-2 small" style="padding-left: 5px;padding-right: 5px;">' +
            '<p class="mb-2">' +
            res.data[index].charge_box_id +
            " #" +
            res.data[index].connector_id +
            "</p>" +
            '<p class="mb-1">AC Type ' +
            "2" +
            "   (11.0 kW)</p>" +
            '<img src="https://geonine.io/evpublic/connector/4.png" style="width: 100%; max-width: 80px;">' +
            '<p class="m-0">' +
            "Service Charge: " +
            price_Kw +
            " " +
            monetary_unit +
            "/kWh" +
            "</p>" +
            "</div>" +
            "</div>" +
            "</a>" +
            "</div>";
        }

        $(".connectors_by_cp").html(html_box_connector);
      } else {
      }
    },
    error: function (res) {
      console.log(res);
    },
  });
}

function onScanSuccess(decodedText, decodedResult) {
  // console.log(`Scan result: ${decodedText}`, decodedResult);
  searchStationScan(decodedText);
  // document.getElementById("scan_station").style.display = "none";
  // document.getElementById("scan_page").style.display = "none";
  // document.getElementById("step_station").style.display = "block";
  // html5QrcodeScanner.clear();
}

function clickSelectConnector(connector_pk) {
  let dataObj = {
    connector_pk,
    ev_chargepoint_name,
  };

  obj_status = {
    connector_pk,
    ev_chargepoint_name,
  };

  connector_pk_pub = connector_pk;

  $.ajax({
    type: "POST",
    url: `${serverUrl}/charging/getStatusConnecter`,
    contentType: "application/json; charset=utf-8;",
    processData: false,
    data: JSON.stringify(dataObj),
    success: function (res) {
      if (res.success === 1) {
        if (
          res.data.status != "Charging" &&
          res.data.status != "Unavailable" &&
          res.data.status != "Available"
        ) {
          $("#ev_description").html(
            '<span class="float-end text-primary fw-bold" id="">' +
              res.data.description +
              "</span></p>"
          );

          $("#ev_description_charge").html(
            '<span class="float-end text-primary fw-bold" id="">' +
              res.data.description +
              "</span></p>"
          );

          $("#ev_description_sum").html(
            '<span class="float-end text-primary fw-bold" id="">' +
              res.data.description +
              "</span></p>"
          );

          $("#ev_cp").html(
            '<span class="float-end text-primary fw-bold" id="">' +
              ev_chargepoint_name +
              " #" +
              res.data.connector_id +
              "</span></p>"
          );

          $("#ev_cp_charge").html(
            '<span class="float-end text-primary fw-bold" id="">' +
              ev_chargepoint_name +
              " #" +
              res.data.connector_id +
              "</span></p>"
          );

          $("#ev_cp_sum").html(
            '<span class="float-end text-primary fw-bold" id="">' +
              ev_chargepoint_name +
              " #" +
              res.data.connector_id +
              "</span></p>"
          );

          $("#ev_service_price_chaging").html(
            '<span class="float-end text-primary fw-bold" id="">' +
              price_Kw +
              " " +
              monetary_unit +
              "/h" +
              "</span></p>"
          );

          blink = setInterval(function () {
            $(".blink").fadeToggle();
          }, 100);

          connectorId = res.data.connector_id;
          stepsFormGoNext.steps("next");
          getStartConnect();
          setInterval(move, 1000);
          callStatusCharge = setInterval(getStartConnect, 1000);
        } else {
          Swal.fire({
            icon: "warning",
            text: `หัวชาร์จไม่พร้อมใช้งาน`,
            timer: "2000",
            heightAuto: false,
          });
        }
      } else {
        Swal.fire({
          icon: "warning",
          text: `${res.message}`,
          timer: "2000",
          heightAuto: false,
        });
      }
    },
    error: function (res) {
      console.log(res);
    },
  });
  // stepsFormGoNext.steps("next");
}

function getStartConnect() {
  $.ajax({
    type: "POST",
    url: `${serverUrl}/charging/getStatusConnecter`,
    contentType: "application/json; charset=utf-8;",
    processData: false,
    data: JSON.stringify(obj_status),
    success: function (res) {
      if (res.success === 1) {
        if (
          res.data.status == "Finishing" ||
          res.data.status == "Preparing"
          // || res.data.status == "Available"
        ) {
          $("#startChargeBtn").prop("disabled", false);
          clearInterval(callStatusCharge);
        } else {
          $("#startChargeBtn").prop("disabled", true);
        }
      } else {
        Swal.fire({
          icon: "warning",
          text: `${res.message}`,
          timer: "2000",
          heightAuto: false,
        });
      }
    },
    error: function (res) {
      console.log(res);
    },
  });
}

$("#startChargeBtn").click(function () {
  swal.fire({
    title: "",
    text: "Loading...",
    onBeforeOpen() {
      Swal.showLoading();
    },
    onAfterClose() {
      Swal.hideLoading();
    },
    // timer: 7500,
    showConfirmButton: false,
    showCancelButton: false,
    //icon: "success",
    allowOutsideClick: false,
    allowEscapeKey: false,
    allowEnterKey: false,
  });

  chargePointSelectList = "JSON;" + ev_chargepoint_name + ";-";
  idTag = ev_chargepoint_name + "_" + connectorId;

  let dataObj = {
    chargePointSelectList,
    connectorId,
    idTag,
  };

  $.ajax({
    url: `${serverUrl}/charging/startCharger`,
    type: "POST",
    data: JSON.stringify(dataObj),
    contentType: "application/json; charset=utf-8;",
    processData: false,
    success: function (response) {
      if (response) {
        if (response) {
          // afterRemoteStart();
          checkStartStatus();
        }
      }
    },
    error: function () {
      // alert("error");
    },
  });

  // $("#startChargeBtn").hide();
  // $("#stopChargeBtn").show();
});

function afterRemoteStart() {
  $.ajax({
    type: "POST",
    url: `${serverUrl}/charging/getStatusConnecter`,
    contentType: "application/json; charset=utf-8;",
    processData: false,
    data: JSON.stringify(obj_status),
    success: function (res) {
      if (res.success === 1) {
        if (res.data.status == "Charging" || res.data.status == "SuspendedEV") {
          $("#startChargeBtn").prop("disabled", true);
          $("#startChargeBtn").hide();
          $("#stopChargeBtn").show();

          clearInterval(blink);

          $(".blink").stop(true, true).fadeToggle(0);
          $(".blink").hide();

          blinkStart = setInterval(function () {
            $(".blinkStart").fadeToggle();
          }, 100);

          checkFinishStatus = setInterval(function () {
            checkFinish();
          }, 600000);

          let dataObj = {
            connector_pk_pub,
            idTag,
          };

          $.ajax({
            type: "POST",
            url: `${serverUrl}/charging/getTransectionStartLast`,
            contentType: "application/json; charset=utf-8;",
            processData: false,
            data: JSON.stringify(dataObj),
            success: function (res) {
              if (res.success === 1) {
                transactionId = res.data.transaction_pk;
                let state = "START";
                transection_state(state);

                getActiveChargeData(transactionId);
                //  เรียกทุกๆ 4 นาที
                getActive = setInterval(function () {
                  getActiveChargeData(transactionId);
                }, 180000);

                timer_count_start_charge = setInterval(setTime, 1000);
                stepsFormGoNext.steps("next");
              } else {
                Swal.fire({
                  icon: "warning",
                  text: `${res.message}`,
                  timer: "2000",
                  heightAuto: false,
                });
              }
            },
            error: function (res) {
              console.log(res);
            },
          });
        } else {
          $("#startChargeBtn").prop("disabled", false);
          $("#startChargeBtn").show();
          $("#stopChargeBtn").hide();
          Swal.fire({
            icon: "warning",
            text: `ชาร์จไม่สำเร็จ`,
            timer: "2000",
            heightAuto: false,
          });
        }
      } else {
        Swal.fire({
          icon: "warning",
          text: ``,
          timer: "2000",
          heightAuto: false,
        });
      }
    },
    error: function (res) {
      console.log(res);
    },
  });
}

$("#stopChargeBtn").click(function () {
  swal.fire({
    title: "",
    text: "Loading...",
    onBeforeOpen() {
      Swal.showLoading();
    },
    onAfterClose() {
      Swal.hideLoading();
    },
    // timer: 7500,
    showConfirmButton: false,
    showCancelButton: false,
    //icon: "success",
    allowOutsideClick: false,
    allowEscapeKey: false,
    allowEnterKey: false,
  });

  beforeRemoteStop(transactionId);
});

function beforeRemoteStop(id_transection_pk) {
  chargePointSelectList = "JSON;" + ev_chargepoint_name + ";-";
  transactionId = id_transection_pk;

  let objStop = {
    chargePointSelectList,
    transactionId,
  };

  $.ajax({
    url: `${serverUrl}/charging/stopCharger`,
    type: "POST",
    data: JSON.stringify(objStop),
    contentType: "application/json; charset=utf-8;",
    processData: false,
    success: function (response) {
      if (response) {
        if (response) {
          checkStopStatus();
          let state = "STOP";
          transection_state(state);
        }
      }
    },
    error: function () {
      // alert("error");
    },
  });
}

function afterRemoteStop() {
  $("#startChargeBtn").prop("disabled", false);
  $("#startChargeBtn").show();
  $("#stopChargeBtn").hide();

  clearInterval(blinkStart);
  clearInterval(getActive);
  clearInterval(timer_count_start_charge);
  $(".blinkStart").stop(true, true).fadeToggle(0);
  $(".blinkStart").hide();

  blink = setInterval(function () {
    $(".blink").fadeToggle();
  }, 100);

  clearInterval(checkFinishStatus);
  summaryCharger(transactionId);
}

function transection_state(state) {
  let transectionstate = state;
  let credit = 0.0;
  let type = null;

  let obj_status = {
    type,
    userId,
    credit,
    transectionstate,
    ev_chargepoint_name,
    connectorId,
    idTag,
    transactionId,
    connector_pk_pub,
  };

  $.ajax({
    type: "POST",
    url: `${serverUrl}/charging/addTransection`,
    contentType: "application/json; charset=utf-8;",
    processData: false,
    data: JSON.stringify(obj_status),
    success: function (res) {
      if (res.success === 1) {
      } else {
        Swal.fire({
          icon: "warning",
          text: `ERROR`,
          timer: "2000",
          heightAuto: false,
        });
      }
    },
    error: function (res) {
      console.log(res);
    },
  });
}

function getActiveChargeData(transaction_pk) {
  transactionId = transaction_pk;
  let obj_status = {
    transaction_pk: transactionId,
  };

  $.ajax({
    type: "POST",
    url: `${serverUrl}/charging/getActiveChecgerData`,
    contentType: "application/json; charset=utf-8;",
    processData: false,
    data: JSON.stringify(obj_status),
    success: function (res) {
      if (res.success === 1) {
        for (index_ = 0; index_ < res.data.length; index_++) {
          let dataPowerActive;
          let dataEnergyActive;
          if (res.data[index_].measurand == "Power.Active.Import") {
            dataPowerActive = res.data[index_].value;
            if (dataPowerActive == null) {
              dataPowerActive = 0;
            }
            $("#powerActive_id").html(
              '<h4 class="fs-7" id="powerActive_id">' +
                parseFloat(dataPowerActive).toFixed(2) +
                "</h4>"
            );
          } else {
            dataEnergyActive = parseInt(res.data[index_].value) / 1000;
            if (dataEnergyActive == null) {
              dataEnergyActive = 0;
            }

            sum_price =
              parseFloat(dataEnergyActive).toFixed(2) *
              parseFloat(price_Kw).toFixed(2);
            sum_Kw = parseFloat(dataEnergyActive).toFixed(2);

            $("#energyActive_id").html(
              '<h4 class="fs-7" id="energyActive_id">' +
                parseFloat(dataEnergyActive).toFixed(2) +
                "</h4>"
            );

            $("#ev_sumUnit").html(
              '<span class="float-end text-primary fw-bold" id="ev_sumUnit">' +
                parseFloat(dataEnergyActive).toFixed(2) +
                " kWh" +
                "</span>"
            );

            $("#ev_sumPrice").html(
              '<span class="float-end text-primary fw-bold" id="ev_sumPrice">' +
                (dataEnergyActive * price_Kw).toFixed(2) +
                " " +
                monetary_unit +
                "</span></p>"
            );

            $("#serviceActive_id").html(
              '<h4 class="fs-7" id="serviceActive_id">' +
                (dataEnergyActive * price_Kw).toFixed(2) +
                "</h4>"
            );

            $("#serviceActive_monetary_unit_id").html(
              '<h6 class="fw-medium text-info mb-0" id="serviceActive_monetary_unit_id">Service  ' +
                price_Kw +
                "" +
                monetary_unit +
                "/kWh</h6>"
            );

            $("#ev_service_price_chaging").html(
              '<span class="float-end text-primary fw-bold" id="">' +
                price_Kw +
                " " +
                monetary_unit +
                "/h" +
                "</span></p>"
            );

            $("#ev_service_price_chaging").html(
              '<span class="float-end text-primary fw-bold" id="">' +
                price_Kw +
                " " +
                monetary_unit +
                "/h" +
                "</span></p>"
            );

            $("#ev_service_price_sum").html(
              '<span class="float-end text-primary fw-bold" id="">' +
                price_Kw +
                " " +
                monetary_unit +
                "/h" +
                "</span></p>"
            );
          }
        }
      } else {
        Swal.fire({
          icon: "warning",
          text: `ERROR`,
          timer: "2000",
          heightAuto: false,
        });
      }
    },
    error: function (res) {
      console.log(res);
    },
  });
}

var minutesLabel = document.getElementById("minutes");
var hoursLabel = document.getElementById("hours");

function pad(val) {
  var valString = val + "";
  if (valString.length < 2) {
    return "0" + valString;
  } else {
    return valString;
  }
}

function setTime() {
  ++totalSeconds;
  // secondsLabel.innerHTML = pad(totalSeconds % 60);
  if (totalSeconds % 60 === 0) {
    dateDiffMinPub = parseInt(dateDiffMinPub) + 1;
    minutesLabel.innerHTML = pad(parseInt(dateDiffMinPub));
  } else if (totalSeconds % 3600 === 0) {
    dateDiffHoursPub = parseInt(dateDiffHoursPub) + 1;
    hoursLabel.innerHTML = pad(parseInt(dateDiffHoursPub));
  }
}

function loadTransectionStatus() {
  let user_id = userId;
  let obj_user_id = { user_id };

  $.ajax({
    type: "POST",
    url: `${serverUrl}/charging/getActiveTransections`,
    contentType: "application/json; charset=utf-8;",
    processData: false,
    data: JSON.stringify(obj_user_id),
    success: function (res) {
      if (res.success === 1) {
        let state = res.data.transectionstate;
        if (state == "START") {
          let timeStart = new Date(res.data.created_at)
            .toISOString()
            .slice(0, 19)
            .replace("T", " ");
          timeStart = new Date(timeStart);
          let dateNow = new Date();
          let diff = dateNow.getTime() - timeStart.getTime();
          let dateDiffSec = diff / 1000;
          let dateDiffMin = diff / 60 / 1000;
          let dateDiffHours = diff / 3600 / 1000;

          dateDiffMinPub =
            Math.floor(dateDiffMin) - 60 * Math.floor(dateDiffHours);
          dateDiffHoursPub = Math.floor(dateDiffHours);

          hoursLabel.innerHTML = pad(dateDiffHoursPub);
          minutesLabel.innerHTML = pad(dateDiffMinPub);

          //for public var //
          ev_chargepoint_name = res.data.cp_id;
          connectorId = res.data.connecter_id;
          idTag = res.data.id_tag;
          connector_pk_pub = res.data.connecter_pk;
          transactionId = res.data.transection_pk;

          document.getElementById("scan_station").style.display = "none";
          document.getElementById("scan_page").style.display = "none";
          document.getElementById("step_station").style.display = "block";

          move();
          setInterval(move, 1000);

          calltransectionLoadState(connector_pk_pub);

          checkFinish();
          blinkStart = setInterval(function () {
            checkFinish();
          }, 600000);

          $("#startChargeBtn").prop("disabled", true);
          $("#startChargeBtn").hide();
          $("#stopChargeBtn").show();

          clearInterval(blink);

          $(".blink").stop(true, true).fadeToggle(0);
          $(".blink").hide();

          blinkStart = setInterval(function () {
            $(".blinkStart").fadeToggle();
          }, 100);

          getActiveChargeData(transactionId);
          //  เรียกทุกๆ 3 นาที
          getActive = setInterval(function () {
            getActiveChargeData(transactionId);
          }, 180000);

          timer_count_start_charge = setInterval(setTime, 1000);

          var indx = 2;
          for (i = 0; i < indx; i++) {
            stepsFormGoNext.steps("next");
          }
        }
      } else {
        Swal.fire({
          icon: "warning",
          text: `ERROR`,
          timer: "2000",
          heightAuto: false,
        });
      }
    },
    error: function (res) {
      console.log(res);
    },
  });

  $.ajax({
    type: "GET",
    url: `${serverUrl}/charging/getActivePriceKw`,
    contentType: "application/json; charset=utf-8;",
    processData: false,
    success: function (res) {
      if (res.success === 1) {
        price_Kw = parseFloat(res.data.price_Kw).toFixed(2);
        monetary_unit = res.data.monetary_unit;
      } else {
        Swal.fire({
          icon: "warning",
          text: `ERROR`,
          timer: "2000",
          heightAuto: false,
        });
      }
    },
    error: function (res) {
      console.log(res);
    },
  });
}

function calltransectionLoadState(connector_pk) {
  let dataObj = {
    connector_pk,
    ev_chargepoint_name,
  };

  obj_status = {
    connector_pk,
    ev_chargepoint_name,
  };

  $.ajax({
    type: "POST",
    url: `${serverUrl}/charging/getStatusConnecter`,
    contentType: "application/json; charset=utf-8;",
    processData: false,
    data: JSON.stringify(dataObj),
    success: function (res) {
      if (res.success === 1) {
        $("#ev_description").html(
          '<span class="float-end text-primary fw-bold" id="">' +
            res.data.description +
            "</span></p>"
        );

        $("#ev_description_charge").html(
          '<span class="float-end text-primary fw-bold" id="">' +
            res.data.description +
            "</span></p>"
        );

        $("#ev_description_sum").html(
          '<span class="float-end text-primary fw-bold" id="">' +
            res.data.description +
            "</span></p>"
        );

        $("#ev_cp").html(
          '<span class="float-end text-primary fw-bold" id="">' +
            ev_chargepoint_name +
            " #" +
            res.data.connector_id +
            "</span></p>"
        );

        $("#ev_cp_charge").html(
          '<span class="float-end text-primary fw-bold" id="">' +
            ev_chargepoint_name +
            " #" +
            res.data.connector_id +
            "</span></p>"
        );

        $("#ev_cp_sum").html(
          '<span class="float-end text-primary fw-bold" id="">' +
            ev_chargepoint_name +
            " #" +
            res.data.connector_id +
            "</span></p>"
        );
      } else {
        Swal.fire({
          icon: "warning",
          text: `${res.message}`,
          timer: "2000",
          heightAuto: false,
        });
      }
    },
    error: function (res) {
      console.log(res);
    },
  });
  // stepsFormGoNext.steps("next");
}

function summaryCharger(transactionId) {
  let state_start = "START";

  obj_finish = {
    transactionId,
    state_start,
  };

  $.ajax({
    type: "POST",
    url: `${serverUrl}/charging/getTransectionsFinish`,
    contentType: "application/json; charset=utf-8;",
    processData: false,
    data: JSON.stringify(obj_finish),
    success: function (res) {
      if (res.success === 1) {
        let timeStart;
        let timeStop;
        for (let index = 0; index < res.data.length; index++) {
          let state = res.data[index].transectionstate;
          if (state == "START") {
            timeStart = new Date(res.data[index].created_at)
              .toISOString()
              .slice(0, 19)
              .replace("T", " ");
            timeStart = new Date(timeStart);
          } else {
            timeStop = new Date(res.data[index].created_at)
              .toISOString()
              .slice(0, 19)
              .replace("T", " ");
            timeStop = new Date(timeStop);
          }
        }

        let diff = timeStop.getTime() - timeStart.getTime();
        // let dateDiffSec = diff / 1000;
        let dateDiffMin = diff / 60 / 1000;
        // let dateDiffHours = diff / 3600 / 1000;

        // dateDiffMinPub =
        //   Math.floor(dateDiffMin) - 60 * Math.floor(dateDiffHours);
        // dateDiffHoursPub = Math.floor(dateDiffHours);

        $("#ev_sumtime").html(
          '<span class="float-end text-primary fw-bold" id="ev_sumtime">' +
            Math.floor(dateDiffMin) +
            "  Minute" +
            "</span></p>"
        );

        sum_min =  Math.floor(dateDiffMin);

        $("#ev_date_start").html(
          '<span class="float-end text-primary fw-bold" id="ev_date_start">' +
            new Date(timeStart).toLocaleString() +
            " " +
            "</span></p>"
        );

        getActiveChargeData(transactionId);
        
        setTimeout(function () {
          summaryChargerUser();
        }, 2000);

        var indx = 3;
        for (i = 0; i < indx; i++) {
          stepsFormGoNext.steps("next");
        }
      } else {
        Swal.fire({
          icon: "warning",
          text: `ERROR NOT NETWORK`,
          timer: "2000",
          heightAuto: false,
        });
      }
    },
    error: function (res) {
      console.log(res);
    },
  });
}

function checkFinish() {
  let obj_status_check = {
    connector_pk_pub,
  };
  $.ajax({
    type: "POST",
    url: `${serverUrl}/charging/getStatusConnecterFinish`,
    contentType: "application/json; charset=utf-8;",
    processData: false,
    data: JSON.stringify(obj_status_check),
    success: function (res) {
      if (res.success === 1) {
        if (
          res.data.status == "Finishing" ||
          res.data.status == "SuspendedEV"
        ) {
          clearInterval(checkFinishStatus);
          transection_state("STOP");
          summaryCharger(transactionId);
        } else {
          console.log("null");
        }
      } else {
        Swal.fire({
          icon: "warning",
          text: `${res.message}`,
          timer: "2000",
          heightAuto: false,
        });
      }
    },
    error: function (res) {
      console.log(res);
    },
  });
}

function checkStartStatus() {
  $.ajax({
    type: "POST",
    url: `${serverUrl}/charging/getStatusConnecter`,
    contentType: "application/json; charset=utf-8;",
    processData: false,
    data: JSON.stringify(obj_status),
    success: function (res) {
      if (res.success === 1) {
        if (res.data.status == "Charging" || res.data.status == "SuspendedEV") {
          afterRemoteStart();
          Swal.close();
        } else {
          checkStartStatus();
        }
      } else {
        Swal.fire({
          icon: "warning",
          text: ``,
          timer: "2000",
          heightAuto: false,
        });
      }
    },
    error: function (res) {
      console.log(res);
    },
  });
}

function checkStopStatus() {
  $.ajax({
    type: "POST",
    url: `${serverUrl}/charging/getStatusConnecter`,
    contentType: "application/json; charset=utf-8;",
    processData: false,
    data: JSON.stringify(obj_status),
    success: function (res) {
      if (res.success === 1) {
        if (res.data.status == "Finishing" || res.data.status == "Available") {
          afterRemoteStop();
          Swal.close();
        } else {
          checkStopStatus();
        }
      } else {
        Swal.fire({
          icon: "warning",
          text: ``,
          timer: "2000",
          heightAuto: false,
        });
      }
    },
    error: function (res) {
      console.log(res);
    },
  });
}

function summaryChargerUser() {
  let credit = 0.0;
  let obj_status = {
    userId,
    sum_price,
    sum_Kw,
    credit,
    ev_chargepoint_name,
    connectorId,
    idTag,
    transactionId,
    connector_pk_pub,
    monetary_unit,
    sum_min,
  };

  $.ajax({
    type: "POST",
    url: `${serverUrl}/charging/summaryChargerUser`,
    contentType: "application/json; charset=utf-8;",
    processData: false,
    data: JSON.stringify(obj_status),
    success: function (res) {
      if (res.success === 1) {
      } else {
        Swal.fire({
          icon: "warning",
          text: `ERROR`,
          timer: "2000",
          heightAuto: false,
        });
      }
    },
    error: function (res) {
      console.log(res);
    },
  });
}
