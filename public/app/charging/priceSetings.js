$(document).ready(function () {
  loadPriceKWh();
});

var price_Kw = 0;
var monetary_unit;

function loadPriceKWh() {
  $.ajax({
    type: "GET",
    url: `${serverUrl}/charging/getActivePriceKw`,
    contentType: "application/json; charset=utf-8;",
    processData: false,
    success: function (res) {
      if (res.success === 1) {
        price_Kw = res.data.price_Kw;
        monetary_unit = res.data.monetary_unit;
        $("#oldPriceId").val(res.data.id);
        $("#oldPriceKWh").val(price_Kw * 1); 
        $("#oldPriceKUnit").val(monetary_unit);
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

$(".btnUpdatePrice").click(function () {
  let id_price = $("#oldPriceId").val();
  let price_Kw = $("#oldPriceKWh").val();
  let monetary_unit = $("#oldPriceKUnit").val();

  if ((price_Kw && monetary_unit) != "") {
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

    let obj_update = {
      id_price,
      price_Kw,
      monetary_unit,
    };

    $.ajax({
      type: "POST",
      url: `${serverUrl}/charging/updatePriceKw`,
      contentType: "application/json; charset=utf-8;",
      processData: false,
      data: JSON.stringify(obj_update),
      success: function (res) {
        if (res.success === 1) {
          loadPriceKWh();
          Swal.close();
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
  } else {
    if (price_Kw == "") {
      $("#update-danger").addClass("has-danger");
    } else if (monetary_unit == "") {
      $("#update-danger-unit").addClass("has-danger");
    }
  }
});

$(".btnSavePrice").click(function () {
  let price_Kw = $("#NewPriceKWh").val();
  let monetary_unit = $("#NewPriceKUnit").val();

  if ((price_Kw && monetary_unit) != "") {
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

    let obj_update = {
      price_Kw,
      monetary_unit,
    };

    $.ajax({
      type: "POST",
      url: `${serverUrl}/charging/insertPriceKw`,
      contentType: "application/json; charset=utf-8;",
      processData: false,
      data: JSON.stringify(obj_update),
      success: function (res) {
        if (res.success === 1) {
          loadPriceKWh();
          $("#NewPriceKWh").val('');
         $("#NewPriceKUnit").val('');
          Swal.close();
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
  } else {
    if (price_Kw == "") {
      $("#save-danger").addClass("has-danger");
    } else if (monetary_unit == "") {
      $("#save-danger-unit").addClass("has-danger");
    }
  }
});

function clearClassDanger(id)
{
  let id_ = "#" + id;
   $(id_).removeClass("has-danger");
}
