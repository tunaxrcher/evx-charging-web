$(function () {
  initUpdateChargingStatus();
});

function initUpdateChargingStatus(delaySec) {
  delaySec = delaySec ?? 10;

  const fncUpdateChargingStatus = (chargePointId, connectorId) => {
    $.ajax({
      type: "POST",
      url: "/galvanic/Main/GetChargingStatus",
      data: {
        chargePointId: chargePointId,
        connectorId: connectorId,
      },
      success: function (result) {
        if (result.success == true) {
          // Display charging icon
          if (result.data.IsCharging) {
            $(".is-charging-icon").css("display", "inline-block");
          } else {
            $(".is-charging-icon").css("display", "none");
          }
        } else {
          if (result.code == -1) {
            globalFunction.alert({
              message: "Session หมดอายุ กรุณาเข้าสู่ระบบอีกครั้ง",
              callback: function () {
                window.location.href = "/galvanic/";
              },
            });
          } else {
            $(".is-charging-icon").css("display", "none");
          }
        }
      },
      error: function (e) {
        console.log(e.message);
      },
    });
  };

  $.ajax({
    type: "POST",
    url: `${serverUrl}/map/GetUserChargingStatusByTag`,
    success: function (result) {
      if (result.success == true) {
        if (result.isCharging) {
          let chargePointId = result.chargingStatus.ChargePointId;
          let connectorId = result.chargingStatus.ConnectorId;

          fncUpdateChargingStatus(chargePointId, connectorId);

          //อัพเดืสถานะ ชาร์จทุก 3 วินาที
          setInterval(function () {
            fncUpdateChargingStatus(chargePointId, connectorId);
          }, delaySec * 1000);
        }
      } else {
        if (result.code == -1) {
          globalFunction.alert({
            message: "Session หมดอายุ กรุณาเข้าสู่ระบบอีกครั้ง",
            callback: function () {
              window.location.href = "/galvanic/";
            },
          });
        } else {
          $(".is-charging-icon").css("display", "none");
        }
      }
    },
    error: function (e) {
      console.log(e.message);
    },
  });
}
