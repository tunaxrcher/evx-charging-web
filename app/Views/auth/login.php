<!DOCTYPE html>
<html lang="en" dir="ltr" data-bs-theme="dark" data-color-theme="Cyan_Theme" data-layout="vertical">

<head>
  <!-- Required meta tags -->
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <!-- Favicon icon-->
  <link rel="shortcut icon" type="image/png" href="<?php echo base_url('/assets/images/logos/favicon.ico'); ?>" />

  <!-- Core Css -->
  <link rel="stylesheet" href="<?php echo base_url('/assets/css/styles.css'); ?>" />
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">
  <title>EVX</title>
  <style>
    /** BASE **/
    * {
      font-family: 'Kanit', sans-serif;
    }

    .bg-primary {
      background-color: #01c0c8 !important;
      color: #000 !important;
    }

    /* 
    .auth-bg {
      background: url('https://cdn.whichcar.com.au/assets/p_4x3/13f31229/evx-kerbside-charger-nsw-3.png');
      background-size: cover;
      background-repeat: no-repeat;
    } */

    .bg-svg {
      position: relative;
      overflow-x: hidden;
    }

    .bg-svg::before {
      content: "";
      position: absolute;
      background: url(https://cdn.whichcar.com.au/assets/p_4x3/13f31229/evx-kerbside-charger-nsw-3.png);
      background-position: center;
      background-repeat: no-repeat;
      background-size: cover;
      width: 100%;
      height: 100%;
      opacity: 0.35;
    }

    .z-index-10 {
      z-index: 10;
    }

    .page {
      overflow: clip;
    }

    .page {
      display: flex;
      flex-direction: column;
      min-height: 100vh;
      justify-content: center;
      border-radius: 0;
      box-shadow: 0 0 5px var(--primary-bg-color);
      background-position: center 64px;
      background-repeat: no-repeat;
      content: "";
      inset-inline-start: 0;
      inset-inline-end: 0;
      top: 0;
      width: 100%;
    }
  </style>
  <script>
    var serverUrl = '<?php echo base_url(); ?>'
  </script>
</head>

<body class="bg-primary">
  <!-- Preloader -->
  <div class="preloader">
    <img src="<?php echo base_url('assets/images/logos/logo.png'); ?>" alt="loader" class="lds-ripple img-fluid" />
  </div>
  <div class="bg-svg">
    <div class="page">
      <div class="z-index-10">
        <div id="main-wrapper">
          <div class="position-relative overflow-hidden min-vh-100 w-100 d-flex align-items-center justify-content-center">
            <div class="d-flex align-items-center justify-content-center w-100">
              <div class="row justify-content-center w-100 my-5 my-xl-0">
                <div class="col-md-4 d-flex flex-column justify-content-center">
                  <div class="card mb-0 bg-body auth-login m-auto w-100">
                    <div class="row gx-0">
                      <!-- ------------------------------------------------- -->
                      <!-- Part 1 -->
                      <!-- ------------------------------------------------- -->
                      <div class="col-xl-12 border-end">
                        <div class="row justify-content-center py-4">
                          <div class="col-lg-11">
                            <div class="card-body">
                              <a href="<?php echo base_url(); ?>" class="text-nowrap logo-img d-block mb-4 w-100">
                                <img src="<?php echo base_url('assets/images/logos/logo.png'); ?>" class="dark-logo" alt="Logo-Dark" />
                              </a>
                              <h2 class="lh-base mb-4">เข้าสู่ระบบ EVX Charging</h2>
                              <div class="position-relative text-center my-4">
                                <p class="mb-0 fs-12 px-3 d-inline-block bg-body z-index-5 position-relative">sign in with
                                  email
                                </p>
                                <span class="border-top w-100 position-absolute top-50 start-50 translate-middle"></span>
                              </div>
                              <form id="loginForm" method="post">
                                <div class="mb-3">
                                  <label for="exampleInputEmail1" class="form-label">อีเมล</label>
                                  <input name="username" type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter your email" aria-describedby="emailHelp">
                                </div>
                                <div class="mb-4">
                                  <div class="d-flex align-items-center justify-content-between">
                                    <label for="exampleInputPassword1" class="form-label">รหัสผ่าน</label>
                                    <a class="text-primary link-dark fs-2" href="">Forgot
                                      Password ?</a>
                                  </div>
                                  <input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Enter your password">
                                </div>
                                <div class="d-flex align-items-center justify-content-between mb-4">
                                  <div class="form-check">
                                    <input class="form-check-input primary" type="checkbox" value="" id="flexCheckChecked" checked>
                                    <label class="form-check-label text-dark" for="flexCheckChecked">
                                      Keep me logged in
                                    </label>
                                  </div>
                                </div>
                                <button id="btn-login" class="btn btn-info w-100 py-8 mb-2 rounded-1">เข้าสู่ระบบ</button>
                                <a href="<?php echo base_url('/register'); ?>" class="btn btn-dark w-100 py-8 mb-4 rounded-1">สมัครสมาชิก</a>
                                <footer class="text-center text-lg-start bg-light text-muted">
                                  <!-- Copyright -->
                                  <div class="text-center small pt-3 pb-3 footer-container">
                                    <a href="<?php echo base_url(); ?>" target="_blank" class="no-style"><i class="fa fa-book"></i> คู่มือการใช้งาน</a>
                                    <!-- <br><a href="https://geonine.io/evpublic/instruction/deactivate_account_th.png" target="_blank" class="no-style"><i class="fa fa-book"></i> การลบบัญชีผู้ใช้งาน</a> -->
                                    <hr>
                                    © 2024 -
                                    <a class="text-reset fw-bold" href="#">EVX</a>
                                    <br>
                                    <a href="#" class="no-style me-2 small" onclick="showTermModal(); return false;">ข้อตกลงและเงื่อนไขการให้บริการ</a>
                                    <span>|</span>
                                    <a href="#" class="no-style small" onclick="showPrivacyModal(); return false;">นโยบายความเป็นส่วนตัว</a>
                                    <br>
                                    <small>Last Update : 01/08/2024 00:00</small>
                                  </div>
                                  <!-- Copyright -->
                                </footer>
                              </form>
                            </div>
                          </div>
                        </div>

                      </div>
                      <!-- ------------------------------------------------- -->
                      <!-- Part 2 -->
                      <!-- ------------------------------------------------- -->
                    </div>

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="dark-transparent sidebartoggler"></div>
  <!-- Import Js Files -->
  <script src="<?php echo base_url('/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js'); ?>"></script>
  <script src="<?php echo base_url('/assets/libs/simplebar/dist/simplebar.min.js'); ?>"></script>
  <script src="<?php echo base_url('/assets/js/theme/app.dark.init.js'); ?>"></script>
  <script src="<?php echo base_url('/assets/js/theme/theme.js'); ?>"></script>
  <script src="<?php echo base_url('/assets/js/theme/app.min.js'); ?>"></script>

  <!-- solar icons -->
  <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.17/dist/sweetalert2.all.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
  <script>
    $(document).ready(function() {
      $('#btn-login').on('click', function(e) {
        e.preventDefault()
        const $btnLogin = $(this)

        $btnLogin.prop('disabled', true)

        let username = $('input[name="username"]').val()
        let password = $('input[name="password"]').val()

        let dataObj = {
          username,
          password
        }

        $.ajax({
          type: 'POST',
          url: `${serverUrl}/login`,
          contentType: 'application/json; charset=utf-8;',
          processData: false,
          data: JSON.stringify(dataObj),
          success: function(res) {
            if (res.success === 1) {

              $btnLogin.prop('disabled', false)

              Swal.fire({
                icon: 'success',
                text: `${res.message}`,
                timer: '2000',
                heightAuto: false
              });

              window.location.href = res.redirect_to;
            } else {
              $btnLogin.prop('disabled', false)
            }
          },
          error: function(res) {

            $btnLogin.prop('disabled', false)

            Swal.fire({
              icon: 'error',
              title: 'ไม่สามารถเข้าสู่ระบบได้',
              text: `${res.responseJSON.message}`,
              timer: '2000',
              heightAuto: false
            });
          }
        })

      });
      $(".toggle-password").click(function() {
        $(this).toggleClass("fa-eye fa-eye-slash");
        var input = $($(this).attr("toggle"));
        if (input.attr("type") == "password") {
          input.attr("type", "text");
        } else {
          input.attr("type", "password");
        }
      });
    });
  </script>
</body>

</html>