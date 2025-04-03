$(document).ready(function () {
  let $tabs = $("#pills-tabContent");
  let $formPersonalDetail = $tabs.find("#formPersonalDetail");

  const PROFILE = {
    getUserData() {
      $.ajax({
        type: "GET",
        url: `${serverUrl}/profile/data`,
        processData: false,
        contentType: false,
      })
        .done(function (res) {
          //กรณี: บันทึกสำเร็จ
          if ((res.success = 1)) {
            let $data = res.data;
            $formPersonalDetail.find("input[name=phone]").val($data.phone);
            $formPersonalDetail.find("input[name=email]").val($data.email);
            $formPersonalDetail
              .find("input[name=fullname]")
              .val($data.fullname);
          }

          // กรณี: Server มีการตอบกลับ แต่ไม่สำเร็จ
          else {
            // Show error message.
            Swal.fire({
              text: res.message,
              icon: "error",
              buttonsStyling: false,
              confirmButtonText: "ตกลง",
              customClass: {
                confirmButton: "btn btn-primary",
              },
            }).then(function (result) {
              if (result.isConfirmed) {
                // LANDING_PROMOTION.reloadPage()
              }
            });

            $me.attr("disabled", false);
          }
        })
        .fail(function (context) {
          let messages =
            context.responseJSON?.messages ||
            "ไม่สามารถบันทึกได้ กรุณาลองใหม่อีกครั้ง หรือติดต่อผู้ให้บริการ";
          // Show error message.
          Swal.fire({
            text: messages,
            icon: "error",
            buttonsStyling: false,
            confirmButtonText: "ตกลง",
            customClass: {
              confirmButton: "btn btn-primary",
            },
          });

          $me.attr("disabled", false);
        });
    },
    handleTabPersonalDetail() {
      $formPersonalDetail
        // บันทึกข้อมูล
        .on("click", ".btnSave", function (e) {
          e.preventDefault();

          // เช็คข้อมูล
          if ($formPersonalDetail.find("input[name=fullname]").val() == "") {
            alert("กรุณาระบุชื่อ");
            return false;
          }

          // ผ่าน
          else {
            let $me = $(this);

            $me.attr("disabled", false);

            let formData = new FormData($formPersonalDetail[0]);

            $.ajax({
              type: "POST",
              url: `${serverUrl}/profile/update`,
              data: formData,
              processData: false,
              contentType: false,
            })
              .done(function (res) {
                //กรณี: บันทึกสำเร็จ
                if ((res.success = 1)) {
                  let $data = res.data;

                  Swal.fire({
                    text: "อัพเดทสำเร็จ",
                    icon: "success",
                    buttonsStyling: false,
                    confirmButtonText: "ตกลง",
                    timer: "1000",
                    customClass: {
                      confirmButton: "btn btn-primary",
                    },
                  }).then(function (result) {
                    if (result.isConfirmed) {
                    }
                  });

                  $formPersonalDetail
                    .find("input[name=phone]")
                    .val($data.phone);
                  $formPersonalDetail
                    .find("input[name=email]")
                    .val($data.email);
                  $formPersonalDetail
                    .find("input[name=fullname]")
                    .val($data.fullname);
                }

                // กรณี: Server มีการตอบกลับ แต่ไม่สำเร็จ
                else {
                  // Show error message.
                  Swal.fire({
                    text: res.message,
                    icon: "error",
                    buttonsStyling: false,
                    confirmButtonText: "ตกลง",
                    customClass: {
                      confirmButton: "btn btn-primary",
                    },
                  }).then(function (result) {
                    if (result.isConfirmed) {
                      // LANDING_PROMOTION.reloadPage()
                    }
                  });

                  $me.attr("disabled", false);
                }
              })
              .fail(function (context) {
                let messages =
                  context.responseJSON?.messages ||
                  "ไม่สามารถบันทึกได้ กรุณาลองใหม่อีกครั้ง หรือติดต่อผู้ให้บริการ";
                // Show error message.
                Swal.fire({
                  text: messages,
                  icon: "error",
                  buttonsStyling: false,
                  confirmButtonText: "ตกลง",
                  customClass: {
                    confirmButton: "btn btn-primary",
                  },
                });

                $me.attr("disabled", false);
              });
          }
        });
    },
    handleTabs() {
      $('button[role="tab"]').on("shown.bs.tab", function (e) {
        var selectedTabId = e.target.id;
        switch (selectedTabId) {
          case "personal-detail-tab":
            PROFILE.getUserData();
            break;
        }
      });
    },
    init() {
      var id = $(".tab-content .active").attr("id");
      if (id == "personal-detail") PROFILE.getUserData();

      PROFILE.handleTabs();
      PROFILE.handleTabPersonalDetail();
      // PROFILE.handleTabPersonalCars()
      // PROFILE.handleTabPersonalSecurity()
    },
  };

  PROFILE.init();

  $("#add-notes").on("click", function (event) {
    $("#addnotesmodal").modal("show");
    $("#btn-n-save").hide();
    $("#btn-n-add").show();
  });
});
