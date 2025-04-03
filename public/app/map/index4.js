var dtLangUrl =
  "https://geonine.io/galvanic/Scripts/Geo9/Datatables-1.11.5/dataTables.th.json";
var jsonMarker = {};
var jsonMarkerType = {};
var jsonMarkerMobile = {};
var jsonMarkerMobileType = {};
var privateStationLabel = "สถานีส่วนบุคคล";

$(function () {
  //   jsonMarker[40] =
  //     "https://geonine.io/evpublic/WebMapMarkerHandler.ashx?m=map-marker_gvn.svg" +
  //     "&a=GVN";
  //   jsonMarkerType[40] = "s";
  //   jsonMarker[41] =
  //     "https://geonine.io/evpublic/WebMapMarkerHandler.ashx?m=map-marker_active_bftz.svg" +
  //     "&a=GVN";
  //   jsonMarkerType[41] = "s";
  //   jsonMarker[49] =
  //     "https://geonine.io/evpublic/WebMapMarkerHandler.ashx?m=map-marker_active_ctms.svg" +
  //     "&a=GVN";
  //   jsonMarkerType[49] = "s";
  //   jsonMarker[76] =
  //     "https://geonine.io/evpublic/WebMapMarkerHandler.ashx?m=map-marker_bcharge.svg" +
  //     "&a=GVN";
  //   jsonMarkerType[76] = "s";
  //   jsonMarker[1088] =
  //     "https://geonine.io/evpublic/WebMapMarkerHandler.ashx?m=map-marker_plug_pay_gvn1.svg" +
  //     "&a=GVN";
  //   jsonMarkerType[1088] = "s";

  jsonMarker[40] = "https://cdn.discordapp.com/attachments/1265248054748119071/1268514664279703562/EVX_Icon2.webp?ex=66acb3d7&is=66ab6257&hm=739b97628c8e29397233183c1a7c916128dcc067e5166852918d1ac11239b341&";
  jsonMarkerType[40] = "s";
  jsonMarker[41] = "https://cdn.discordapp.com/attachments/1265248054748119071/1268514664279703562/EVX_Icon2.webp?ex=66acb3d7&is=66ab6257&hm=739b97628c8e29397233183c1a7c916128dcc067e5166852918d1ac11239b341&";
  jsonMarkerType[41] = "s";
  jsonMarker[49] = "https://cdn.discordapp.com/attachments/1265248054748119071/1268514664279703562/EVX_Icon2.webp?ex=66acb3d7&is=66ab6257&hm=739b97628c8e29397233183c1a7c916128dcc067e5166852918d1ac11239b341&";
  jsonMarkerType[49] = "s";
  jsonMarker[76] = "https://cdn.discordapp.com/attachments/1265248054748119071/1268514664279703562/EVX_Icon2.webp?ex=66acb3d7&is=66ab6257&hm=739b97628c8e29397233183c1a7c916128dcc067e5166852918d1ac11239b341&";
  jsonMarkerType[76] = "s";
  jsonMarker[1088] = "https://cdn.discordapp.com/attachments/1265248054748119071/1268514664279703562/EVX_Icon2.webp?ex=66acb3d7&is=66ab6257&hm=739b97628c8e29397233183c1a7c916128dcc067e5166852918d1ac11239b341&";
  jsonMarkerType[1088] = "s";

  $("#stationName").select2({
    //allowClear: true,
    //placeholder: '-- ทั้งหมด --',
    dropdownParent: $("#divCondStationName"),
  });

  $("#OwnerId").select2({
    allowClear: true,
    placeholder: "-- ทั้งหมด --",
  });

  $("#stationName").on("change", function (e) {
    $("#formSearch").submit();
  });

  $("#OwnerId").on("change", function (e) {
    $("#formSearch").submit();
  });

  $(
    'input[type="checkbox"][name="stationStatus"], input[type="checkbox"][name="stationType"], input[type="checkbox"][name="connectorType"], input[type="checkbox"][name="online"], input[type="checkbox"][name="isPublicStation"]'
  ).change(function () {
    $("#formSearch").submit();
  });

  $(document).on("click", ".btn-close-popup", function () {
    const popupTarget = $(this).data("popupTarget");
    $("#" + popupTarget).hide();
  });

  $(document).on("click", ".btn-close-infowindow", function () {
    if (infoWindow) {
      infoWindow.close();
    }
  });

  //$("#stationStatus, #stationType").select2();

  $("#clearBtn").click(function () {
    location.href = location.href;
  });

  $("#formSearch").validate({
    // initialize the plugin
    rules: {},
    submitHandler: function () {
      var cond = getQueryLocationCond();

      queryLocation(cond);

      return;
    },
    invalidHandler: function () {
      return;
    },
  });

  $.each($(".div-icons .status-container"), (idx, el) => {
    const statusId = parseInt($(el).data("status"));
    const iconUrl = icons[statusId].icon;

    $(el).prepend(
      `<img src="${iconUrl}" class="me-2 img-map-icon${
        $(el).hasClass("mini") ? "-mini" : ""
      }" />`
    );
  });

  // Tooltip in modal
  $(document).on("shown.bs.modal", "div.bootbox", function () {
    var tooltipTriggerList = [].slice.call(
      document.querySelectorAll('.modal-content [data-bs-toggle="tooltip"]')
    );
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl);
    });
  });

  // Check-in button
  $(document).on("click", ".btnCheckIn", function () {
    const url = $(this).data("url");

    $.ajax({
      url: "/galvanic/Map/ValidateCheckIn",
      type: "POST",
      success: function (result) {
        if (result.success) {
          window.location.href = url;
        } else {
          globalFunction.alert({
            type: "warning",
            message:
              "ท่านไม่สามารถ check-in ได้เนื่องท่านกำลังใช้งานการชาร์จอยู่",
          });
        }
      },
      error: function (result) {
        console.log(result);
        globalFunction.alert({
          type: "warning",
          message: "เกิดข้อผิดพลาด",
        });
      },
    });
  });
});
