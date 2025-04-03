$(".tab-wizard-custom").steps({
  headerTag: "h6",
  bodyTag: "section",
  transitionEffect: "fade",
  titleTemplate:
    '<span class="step"><iconify-icon icon="flat-color-icons:next"></iconify-icon></span> #title#',
  labels: {
    finish: "Submit",
  },
  onFinished: function (event, currentIndex) {
    swal(
      "Form Submitted!",
      "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed lorem erat eleifend ex semper, lobortis purus sed."
    );
  },
  labels: {
    finish: "ยืนยัน",
    next: "ถัดไป",
    previous: "ย้อนกลับ",
  },
  onInit: function (event, current) {
    $(".actions > ul > li:first-child").attr("style", "display:none");
  },
  onStepChanged: function (event, current, next) {
    if (current > 0) {
      $(".actions > ul > li:first-child").attr("style", "");
    } else {
      $(".actions > ul > li:first-child").attr("style", "display:none");
    }
  },
});

var langCheck = "";
var couponTopupMin;
$(function () {
  var fixPriceVal = "";
  var sourceId = null;

  $(".remain-price-div").show();
  $(".fix-price-btn-list").show();
  $(".fix-price-div").show();

  //$(document).on('click', '.fix-price-custom-btn', function () {
  //    fixPriceVal = '';
  //    $('.fix-price-input').val(fixPriceVal)
  //});

  $(document).on("click", ".fix-price-btn", function () {
    //$('.fix-price-div').hide()

    //fixPriceVal = $(this).data('price');

    //$('.fix-price-input').val(fixPriceVal)

    $(".fix-price-input").val($(this).data("price"));
    $(".fix-price-display-input").val($(this).data("price"));
    $(".fix-price-display-input").trigger("keyup");
  });

  $(document).on("change", ".fix-price-input", function () {
    //fixPriceVal = formatNumber("" + Number($(this).val()).toFixed(2));
    //$(this).val(formatNumber("" + Number(fixPriceVal).toFixed(2)))

    $(this).val(Number($(this).val()).toFixed(2));
  });

  //#region Check Promotion

  $(document).on("keyup", "#couponCode", function () {
    $("#applyCodeBtn").prop("disabled", true);
    if ($(this).val()) $("#applyCodeBtn").prop("disabled", false);
  });

  $("#applyCodeBtn").click(function () {
    if (!$("#appKey").val()) {
      globalFunction.alert({
        type: "warning",
        message: "กรุณาเลือก Network เพื่อตรวจสอบยอดเงินคงเหลือ",
      });
      return false;
    } else if (!$("#price").val()) {
      globalFunction.alert({
        type: "warning",
        message: "กรุณาระบุจำนวนเงินที่ต้องการเติม",
      });
      return false;
    } else if (!$("#couponCode").val()) {
      globalFunction.alert({ type: "warning", message: "กรุณากรอกรหัสคูปอง" });
      return false;
    }

    globalFunction.showLoading("checkCoupon");
    let datas = globalFunction.serializeObject($("#form"));
    $.ajax({
      url: "/evportal/Payment/CheckCoupon",
      type: "POST",
      data: datas,
      success: function (result) {
        if (result.success == true) {
          $("#couponCodeFormDiv").hide();
          $("#couponCodeDescDiv").show();
          $("#couponBonusCode").text(result.data.PromotionCode);
          $("#couponDesc").text(result.data.PromotionDesc);
          $("#couponBonusAmount").text("+" + result.data.ReceiveCredit);
          couponTopupMin = result.data.TopupMin;

          $("#activeCouponCode").val(result.data.PromotionCode);

          updatePromotionView($("#price").val());
          globalFunction.hideLoading("checkCoupon");
        } else {
          globalFunction.hideLoading("checkCoupon");
          if (result.url) {
            window.location.href = result.url;
          } else if (result.message) {
            globalFunction.alert({ type: "warning", message: result.message });
          } else {
            globalFunction.alert({
              type: "warning",
              message: "กรุณาลองใหม่อีกครั้ง",
            });
          }
        }
      },
      error: function (e) {
        globalFunction.hideLoading("checkCoupon");
        globalFunction.alert({
          type: "warning",
          message: "กรุณาลองใหม่อีกครั้ง",
        });
      },
    });
  });

  $("#removeCouponCodeBtn").click(function () {
    globalFunction.showLoading("removeCouponCode");
    $.ajax({
      url: "/evportal/Payment/RemoveCouponCode",
      type: "POST",
      success: function (result) {
        globalFunction.hideLoading("removeCouponCode");
        if (result.success == true) {
          $("#couponCodeFormDiv").show();
          $("#couponCodeDescDiv").hide();
          $("#couponBonusCode").text("");
          $("#couponDesc").text("");
          $("#couponBonusAmount").text("");
          couponTopupMin = null;

          $("#activeCouponCode").val("");
          $("#couponCode").val("");
        }
      },
      error: function (e) {
        globalFunction.hideLoading("removeCouponCode");
        globalFunction.alert({
          type: "warning",
          message: "กรุณาลองใหม่อีกครั้ง",
        });
      },
    });
  });

  function updatePromotionView(price) {
    //check mintopup promotion
    if (couponTopupMin != null) {
      if (price >= couponTopupMin) {
        $("#NotMeetConditionText").hide();
        $("#couponCodeDescDiv")
          .removeClass("alert-danger")
          .addClass("alert-success");
      } else {
        $("#NotMeetConditionText").show();
        $("#couponCodeDescDiv")
          .removeClass("alert-success")
          .addClass("alert-danger");
      }
    }
  }

  function updateTextView(_obj) {
    var num = getNumber(_obj.val());
    if (num == 0) {
      _obj.val("");
    } else {
      langCheck = "th";
      if (langCheck == "lo") {
        var _tempvalue = num.toLocaleString("de-DE"); //same format as German
        _obj.val(_tempvalue);
      } else {
        _obj.val(num.toLocaleString());
      }
    }
  }

  function getNumber(_str) {
    var arr = _str.split("");
    var out = new Array();
    for (var cnt = 0; cnt < arr.length; cnt++) {
      if (isNaN(arr[cnt]) == false) {
        out.push(arr[cnt]);
      }
    }
    return Number(out.join(""));
  }

  //#endregion Check Promotion

  $(document).on("click", "#btnWebViewCancel", function () {
    if (messageHandler) {
      messageHandler.postMessage("navigate_to_setting");
    } else {
      alert("NO messageHandler");
    }
  });

  $("#verifyBtn").click(function () {
    if (!$("#appKey").val()) {
      globalFunction.alert({
        type: "warning",
        message: "กรุณาเลือก Network เพื่อตรวจสอบยอดเงินคงเหลือ",
      });
    } else if (!$("#price").val()) {
      globalFunction.alert({
        type: "warning",
        message: "กรุณาระบุจำนวนเงินที่ต้องการเติม",
      });
    } else if ($("#form").valid()) {
      //create source promptpay

      $("#form").submit();
    }
  });

  $("#form").validate({
    rules: {
      appKey: { required: true },
      price: { required: true, min: 100, max: 3000 },
      priceDisplay: {
        required: true,
        priceRangeCheckWithCommasMin: true,
        priceRangeCheckWithCommasMax: true,
      },
    },
    messages: {
      price: {
        min: "กรุณาเติมเงินขั้นต่ำ 100 บาท",
        max: "เติมเงินได้ไม่เกิน 3,000 บาท",
      },
      priceDisplay: {
        priceRangeCheckWithCommasMin: "กรุณาเติมเงินขั้นต่ำ 100 บาท",
        priceRangeCheckWithCommasMax: "เติมเงินได้ไม่เกิน 3,000 บาท",
      },
    },
    submitHandler: function (form) {
      let datas = globalFunction.serializeObject($("#form"));
      //datas.price = fixPriceVal;
      //datas.sourceId = sourceId;

      // Post to form
      globalFunction.showLoading("submit");
      $.ajax({
        url: "/evportal/Payment/VerifyTopup",
        type: "POST",
        data: datas,
        success: function (result) {
          if (result.success == true) {
            window.location.href = result.url;
          } else {
            globalFunction.hideLoading("submit");
            if (result.url) {
              window.location.href = result.url;
            } else if (result.message) {
              globalFunction.alert({
                type: "warning",
                message: result.message,
              });
            } else {
              globalFunction.alert({
                type: "warning",
                message: "กรุณาลองใหม่อีกครั้ง",
              });
            }
          }
        },
        error: function (e) {
          globalFunction.hideLoading("submit");
          globalFunction.alert({
            type: "warning",
            message: "กรุณาลองใหม่อีกครั้ง",
          });
        },
      });

      return false;
    },
  });

  $.validator.addMethod(
    "priceRangeCheckWithCommasMin",
    function (value, element, param) {
      var numNoComma = 0;
      langCheck = "th";
      if (langCheck == "lo") {
        numNoComma = parseFloat(value.replaceAll(".", ""));
      } else {
        numNoComma = parseFloat(value.replace(/,/g, ""));
      }

      return numNoComma >= 100;
    }
  );

  $.validator.addMethod(
    "priceRangeCheckWithCommasMax",
    function (value, element, param) {
      var numNoComma = 0;
      langCheck = "th";
      if (langCheck == "lo") {
        numNoComma = parseFloat(value.replaceAll(".", ""));
      } else {
        numNoComma = parseFloat(value.replace(/,/g, ""));
      }
      return numNoComma <= 3000;
    }
  );

  $(document).on("keyup", "#priceDisplay", function () {
    //update hidden price
    var removedCommaPrice = $(this).val().replace(/\D/g, "");
    $("#price").val(removedCommaPrice);

    updateTextView($(this));
    updatePromotionView($("#price").val());
  });
});
