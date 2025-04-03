const connectorIcon = {
  cn_1: "https://geonine.io/evpublic/connector/1.png",
  cn_2: "https://geonine.io/evpublic/connector/2.png",
  cn_3: "https://geonine.io/evpublic/connector/3.png",
  cn_4: "https://geonine.io/evpublic/connector/4.png",
  cn_5: "https://geonine.io/evpublic/connector/5.png",
};

globalFunction = {
  alert: function (settings) {
    //default parameter
    var defaultParam = {
      title:
        '<i class="fa fa-info-circle" style="color:#1B95E0"></i> ' +
        "ข้อความจากระบบ",
      message: "",
      callback: null,
      size: "",
      //closeButton: true,
      closeButton: true,
      okLabel: "ตกลง",
      cancelLabel: "ยกเลิก",
      okClassName: "btn-primary",
    };
    if (settings.type == "warning") {
      settings.title =
        '<i class="fa fa-exclamation-triangle" style="color:#F0AC4D"></i> ' +
        "ข้อความแจ้งเตือน";
    } else if (settings.type == "error") {
      settings.title =
        '<i class="fa fa-exclamation-triangle" style="color:#D9524E"></i> ' +
        "แจ้งเตือนข้อผิดพลาด";
    }

    $.extend(defaultParam, settings);

    //show dialog
    if (
      typeof settings.fullCloseButton === "undefined" ||
      settings.fullCloseButton == true
    ) {
      bootbox.dialog({
        title: defaultParam.title,
        message: defaultParam.message,
        size: defaultParam.size,
        closeButton: defaultParam.closeButton,
        buttons: {
          cancel: {
            label: "ปิด",
            className: "btn-outline-secondary",
            callback: function () {
              if ($.isFunction(defaultParam.callback)) {
                defaultParam.callback();
              }
            },
          },
        },
      });
    } else {
      bootbox.dialog({
        title: defaultParam.title,
        message: defaultParam.message,
        size: defaultParam.size,
        closeButton: defaultParam.closeButton,
      });
    }
  },
  confirm: function (settings) {
    //default parameter
    var defaultParam = {
      title:
        '<i class="fa fa-question-circle" style="color:#1B95E0"></i> ' +
        "ยืนยัน",
      message: "",
      okLabel: "ตกลง",
      cancelLabel: "ยกเลิก",
      okCallback: null,
      cancelCallBack: null,
    };
    if (settings.type == "warning") {
      settings.title =
        '<i class="fa fa-exclamation-triangle" style="color:#F0AC4D"></i> ' +
        "ยืนยัน";
    } else if (settings.type == "error") {
      settings.title =
        '<i class="fa fa-exclamation-triangle" style="color:#D9524E"></i> ' +
        "ยืนยัน";
    }

    $.extend(defaultParam, settings);

    var dialog = bootbox.dialog({
      title: defaultParam.title,
      message: defaultParam.message,
      closeButton: defaultParam.closeButton,
      buttons: {
        ok: {
          label: defaultParam.okLabel,
          className: defaultParam.okClassName,
          callback: function () {
            if ($.isFunction(defaultParam.okCallback)) {
              defaultParam.okCallback();
            }
          },
        },
        cancel: {
          label: defaultParam.cancelLabel,
          className: "btn-outline-secondary",
          callback: function () {
            if ($.isFunction(defaultParam.cancelCallBack)) {
              defaultParam.cancelCallBack();
            }
          },
        },
      },
    });

    return dialog;
  },
  hideDialog: function () {
    bootbox.hideAll();
  },
  showLoading: function (processname, msg) {
    //require geoloading
    $.fn.GeoLoading.showLoading(processname, msg);
  },
  hideLoading: function (processname) {
    //require geoloading
    $.fn.GeoLoading.hideLoading(processname);
  },
  logLoading: function () {
    $.fn.GeoLoading.logProcess();
  },
  serializeObject: function ($form) {
    var form = {};
    $.each($form.serializeArray(), function (i, field) {
      form[field.name] = field.value || "";
    });

    return form;
  },
  objectToFormInput: function (obj, $form) {
    //แปลงค่า จาก object เป็น form input
    //<object> json : obj ที่จะแปลงค่า
    //<jQueryObject> $form : form ที่จะใส่ tag input
    for (var prop in obj) {
      CreateInput(prop, obj[prop], $form);
    }

    function CreateInput(name, obj) {
      var type = $.type(obj);

      switch (type) {
        case "number":
        case "boolean":
        case "string":
          $("<input>")
            .attr({
              type: "hidden",
              name: name,
            })
            .val(obj)
            .appendTo($form);
          break;
        default:
          for (var item in obj) {
            CreateInput(name + "[" + item + "]", obj[item]);
          }
          break;
      }
    }
  },

  validateSessionError: function (result) {
    let isJson = true;
    let resultJson;
    try {
      resultJson = $.parseJSON(result);
    } catch (err) {
      isJson = false;
    }

    if (isJson) {
      if (resultJson.code == -1) {
        // Session error redirect to sign in page
        window.location.href = "https://geonine.io/galvanic/Home/Login";
      } else if (resultJson.code == -2) {
        // 2FA error redirect to 2FA page
        window.location.href = resultJson.redirectUrl;
      }

      return false;
    }

    return true;
  },

  getConnectorIcon: function (typeId) {
    return connectorIcon[`cn_${typeId}`];
  },
};
