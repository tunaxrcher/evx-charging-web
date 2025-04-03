var popoverContent = "อัพเดทล่าสุด: 22/07/2024 14:46:40";
$(function () {
  initCreditPopover();

  $(document).on("change", ".sel-lang", function () {
    const _lang = $(".sel-lang option").filter(":selected").val();
    $("#_frmLang input[type=hidden][name=_lang]").val(_lang);
    $("#_frmLang").submit();
  });

  //$(document).on("mouseover", ".credit-update", function () {
  //    $(this).popover("show");
  //});

  //$(document).on("mouseout", ".credit-update", function () {
  //        $(".credit-update").popover("hide");
  //});

  //--------------for session timeout popup------------------//

  var sessionCoutdownTimeoutId;

  var fnTimeOut = function () {
    jQuery.timeoutDialog.setupDialogTimer({
      timeout: "360", //minute
      countdown: 3, //minute
      logout_redirect_url: "/galvanic/Home/Logout",
      keep_alive_url: "/galvanic/Home/Keepalive",
    });

    sessionCoutdownTimeoutId = jQuery.timeoutDialog.alertSetTimeoutHandle;
  };

  jQuery.timeoutDialog.startCheckSessionExpireInterval(); // เมื่อเปิดหน้าเว็บครั้งแรกจะเริ่ม Check Session Expire

  // เมื่อ Active ที่หน้าต่าง Browser
  $(window).focus(function () {
    if (!jQuery.timeoutDialog.checkSessionExpireIntervalId) {
      // เริ่มเช็ค Session Expire ใหม่
      jQuery.timeoutDialog.startCheckSessionExpireInterval();
    }

    if (!jQuery.timeoutDialog.isCountdownActive) {
      // หาก Modal Countdown ไม่ได้เปิดอยู่ให้หยุดการนับ Coutdown
      clearTimeout(sessionCoutdownTimeoutId);
    }
  });

  // เมื่อ Unactive หน้าต่าง Browser
  $(window).blur(function () {
    fnTimeOut(); // เริ่มนับเวลา Coutdown
    jQuery.timeoutDialog.stopCheckSessionExpireInterval(); // หยุดการเช็ค Session Expire
  });

  //--------------for session timeout popup------------------//

  mainColor = ["#1AB394", "#ED5565", "#F8AC59", "#23C6C8"];

  $(".col-form-label.require").append(" <i class='fa fa-asterisk'></i>");

  /*start : แก้เรื่อง clear แล้วเปิด select list*/
  $("select:not([multiple])").on("select2:unselecting", function (e) {
    $(this).val(null).trigger("change");
    e.preventDefault();
  });
  /*end : แก้เรื่อง clear แล้วเปิด select list*/

  $("#btnLogout").on("click", function () {
    globalFunction.confirm({
      message: "ต้องการออกจากระบบ ?",
      okCallback: function () {
        window.location.href = "/galvanic/Home/Logout";
      },
    });
  });

  $("#menu-toggle").click(function (e) {
    e.preventDefault();
    $("#wrapper").toggleClass("toggled");
  });

  //Active menu
  var href = window.location.href;
  var a = href.split("/");
  var hrefChk = a[3];
  if (a.length > 5) hrefChk = a[4];

  $(".list-group a").each(function (e, i) {
    let url = $(this).attr("href").split("/");

    let replace = url[1];

    if (url.length > 3) replace = url[2];

    //let reg = new RegExp(`\\b${replace}\\b`, "i");

    if (hrefChk === replace) {
      //Expand menu
      if ($(this).hasClass("dropdown-item")) {
        $(this).parent().addClass("show");
      }

      //Set active menu
      $(this).addClass("active");
    }
  });

  $(document).on("click", "a[name='btnRefreshCreditBalance']", function () {
    globalFunction.showLoading("Credit");
    $.ajax({
      url: "/galvanic/Profile/GetCredit",
      type: "POST",
      data: {},
      success: function (result) {
        $("span[name='creditDisplayLayout']").text(result.credit);

        popoverContent = "อัพเดทล่าสุด: " + result.refreshDate;
        $(".credit-update").popover("dispose"); //hide and destroy
        initCreditPopover();
      },
    });

    globalFunction.hideLoading("Credit");
  });

  chargebattery();
  setInterval(chargebattery, 2500);
});

function initCreditPopover() {
  $(".credit-update").popover({
    content: popoverContent,
    html: true,
  });
}

function showTermModal() {
  $("#modalTerm").modal("show");
  return false;
}

function showPrivacyModal() {
  $("#modalPrivacy").modal("show");
  return false;
}

function chargebattery() {
  var a;
  a = document.getElementById("carIsCharging");
  if (a != null) {
    a.innerHTML = "&#xf244;";
    setTimeout(function () {
      a.innerHTML = "&#xf243;";
    }, 500);
    setTimeout(function () {
      a.innerHTML = "&#xf242;";
    }, 1000);
    setTimeout(function () {
      a.innerHTML = "&#xf241;";
    }, 1500);
    setTimeout(function () {
      a.innerHTML = "&#xf240;";
    }, 2000);
  }
}

function vwLogin() {
  if (messageHandler) {
    messageHandler.postMessage("navigate_to_login");
  } else {
    alert("NO messageHandler");
  }
}
