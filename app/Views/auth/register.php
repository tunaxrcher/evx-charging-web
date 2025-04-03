<!DOCTYPE html>
<html lang="en" dir="ltr" data-bs-theme="dark" data-color-theme="Blue_Theme" data-layout="vertical">

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


        /* .auth-bg {
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
                                <div class="col-md-9 d-flex flex-column justify-content-center">
                                    <div class="card mb-0 bg-body auth-login m-auto w-100">
                                        <div class="row gx-0">
                                            <!-- ------------------------------------------------- -->
                                            <!-- Part 1 -->
                                            <!-- ------------------------------------------------- -->
                                            <div class="col-xl-6 border-end">
                                                <div class="row justify-content-center py-4">
                                                    <div class="col-lg-11">
                                                        <div class="card-body">
                                                            <a href="<?php echo base_url(); ?>" class="text-nowrap logo-img d-block mb-4 w-100">
                                                                <img src="<?php echo base_url('assets/images/logos/logo.png'); ?>" class="dark-logo" alt="Logo-Dark" />
                                                            </a>
                                                            <h2 class="lh-base mb-4">สมัครใช้งาน EVX Charging</h2>
                                                            <div class="row">
                                                                <div class="col-6 mb-2 mb-sm-0">
                                                                    <a class="disabled btn btn-white shadow-sm text-dark link-primary border fw-semibold d-flex align-items-center justify-content-center rounded-1 py-6" href="javascript:void(0)" role="button">
                                                                        <img src="../assets/images/svgs/facebook-icon.svg" alt="matdash-img" class="img-fluid me-2" width="18" height="18">
                                                                        <span class="d-none d-xxl-inline-flex "> Sign in with </span>&nbsp; Facebook
                                                                    </a>
                                                                </div>
                                                                <div class="col-6">
                                                                    <a class="disabled btn btn-white shadow-sm text-dark link-primary border fw-semibold d-flex align-items-center justify-content-center rounded-1 py-6" href="javascript:void(0)" role="button">
                                                                        <img src="../assets/images/svgs/google-icon.svg" alt="matdash-img" class="img-fluid me-2" width="18" height="18">
                                                                        <span class="d-none d-xxl-inline-flex"> Sign in with </span>&nbsp; Google
                                                                    </a>

                                                                </div>
                                                            </div>
                                                            <div class="position-relative text-center my-4">
                                                                <p class="mb-0 fs-12 px-3 d-inline-block bg-body z-index-5 position-relative">Or sign up with
                                                                    email
                                                                </p>
                                                                <span class="border-top w-100 position-absolute top-50 start-50 translate-middle"></span>
                                                            </div>
                                                            <form novalidate>

                                                                <div class="mb-3">
                                                                    <label for="" class="form-label">อีเมล <span class="text-danger">*</span></label>
                                                                    <input name="txtEmail" type="email" class="form-control" placeholder="Enter your email" aria-describedby="emailHelp" required>
                                                                </div>

                                                                <div class="mb-3 form-group">
                                                                    <label class="form-label">รหัสผ่าน
                                                                        <span class="text-danger">*</span>
                                                                    </label>
                                                                    <div class="controls">
                                                                        <input type="password" name="password1" class="form-control" required data-validation-required-message="This field is required" />
                                                                    </div>
                                                                </div>
                                                                <hr>
                                                                <div class="mb-3 form-group">
                                                                    <label class="form-label">ยืนยันรหัสผ่าน
                                                                        <span class="text-danger">*</span>
                                                                    </label>
                                                                    <div class="controls">
                                                                        <input type="password" name="password2" data-validation-match-match="password1" class="form-control" required />
                                                                    </div>
                                                                </div>

                                                                <div class="d-flex align-items-center justify-content-between mb-4">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input primary cbCondition" type="checkbox">
                                                                        <label class="form-check-label text-dark" for="flexCheckChecked">
                                                                            ฉันได้อ่านและยอมรับ <a href="#" onclick="showTermModal(); return false;">ข้อตกลงและเงื่อนไขการให้บริการ</a>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <button disabled id="btn-register" class="btn btn-dark w-100 py-8 mb-4 rounded-1">ลงทะเบียน</button>
                                                                <div class="d-flex align-items-center">
                                                                    <p class="fs-12 mb-0 fw-medium">Already have an Account?</p>
                                                                    <a class="text-primary fw-semibold ms-2" href="<?php echo base_url(); ?>">เข้าสู่ระบบ</a>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <!-- ------------------------------------------------- -->
                                            <!-- Part 2 -->
                                            <!-- ------------------------------------------------- -->
                                            <div class="col-xl-6 d-none d-xl-block">
                                                <div class="row justify-content-center align-items-center h-100">
                                                    <div class="col-lg-9">
                                                        <div id="auth-login" class="carousel slide auth-carousel" data-bs-ride="carousel">
                                                            <div class="carousel-indicators">
                                                                <button type="button" data-bs-target="#auth-login" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                                                <button type="button" data-bs-target="#auth-login" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                                                <button type="button" data-bs-target="#auth-login" data-bs-slide-to="2" aria-label="Slide 3"></button>
                                                                <button type="button" data-bs-target="#auth-login" data-bs-slide-to="3" aria-label="Slide 3"></button>
                                                            </div>
                                                            <div class="carousel-inner">
                                                                <div class="carousel-item active">
                                                                    <div class="d-flex align-items-center justify-content-center w-100 h-100 flex-column gap-9 text-center">
                                                                        <img src="<?php echo base_url('assets/images/logos/logo.png'); ?>" alt="login-side-img" width="300" class="img-fluid" />
                                                                        <h4 class="mb-0">3 ขั้นตอนง่าย ๆ ใช้ EVX Charging</h4>
                                                                        <p class="fs-12 mb-0">Donec justo tortor, malesuada vitae faucibus ac, tristique sit amet
                                                                            massa.
                                                                            Aliquam dignissim nec felis quis imperdiet.</p>
                                                                        <a href="javascript:void(0)" class="btn btn-primary rounded-1">Learn More</a>
                                                                    </div>
                                                                </div>
                                                                <div class="carousel-item">
                                                                    <div class="d-flex align-items-center justify-content-center w-100 h-100 flex-column gap-9 text-center">
                                                                        <img src="<?php echo base_url('assets/images/logos/logo.png'); ?>" alt="login-side-img" width="300" class="img-fluid" />
                                                                        <h4 class="mb-0">1. สมัครสมาชิก</h4>
                                                                        <p class="fs-12 mb-0">Donec justo tortor, malesuada vitae faucibus ac, tristique sit amet
                                                                            massa.
                                                                            Aliquam dignissim nec felis quis imperdiet.</p>
                                                                        <a href="javascript:void(0)" class="btn btn-primary rounded-1">Learn More</a>
                                                                    </div>
                                                                </div>
                                                                <div class="carousel-item">
                                                                    <div class="d-flex align-items-center justify-content-center w-100 h-100 flex-column gap-9 text-center">
                                                                        <img src="<?php echo base_url('assets/images/logos/logo.png'); ?>" alt="login-side-img" width="300" class="img-fluid" />
                                                                        <h4 class="mb-0">2. เติมเครดิต</h4>
                                                                        <p class="fs-12 mb-0">Donec justo tortor, malesuada vitae faucibus ac, tristique sit amet
                                                                            massa.
                                                                            Aliquam dignissim nec felis quis imperdiet.</p>
                                                                        <a href="javascript:void(0)" class="btn btn-primary rounded-1">Learn More</a>
                                                                    </div>
                                                                </div>
                                                                <div class="carousel-item">
                                                                    <div class="d-flex align-items-center justify-content-center w-100 h-100 flex-column gap-9 text-center">
                                                                        <img src="<?php echo base_url('assets/images/logos/logo.png'); ?>" alt="login-side-img" width="300" class="img-fluid" />
                                                                        <h4 class="mb-0">3. เริ่มชารจ</h4>
                                                                        <p class="fs-12 mb-0">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Facilis veritatis earum repudiandae.</p>
                                                                        <a href="javascript:void(0)" class="btn btn-primary rounded-1">Learn More</a>
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="dark-transparent sidebartoggler"></div>
    <script src="<?php echo base_url('assets/js/vendor.min.js'); ?>"></script>
    <!-- Import Js Files -->
    <script src="<?php echo base_url('/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js'); ?>"></script>
    <script src="<?php echo base_url('/assets/libs/simplebar/dist/simplebar.min.js'); ?>"></script>
    <script src="<?php echo base_url('/assets/js/theme/app.dark.init.js'); ?>"></script>
    <script src="<?php echo base_url('/assets/js/theme/theme.js'); ?>"></script>
    <script src="<?php echo base_url('/assets/js/theme/app.min.js'); ?>"></script>

    <!-- solar icons -->
    <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
    <script src="<?php echo base_url('/assets/js/extra-libs/jqbootstrapvalidation/validation.js'); ?>"></script>
    <script src="<?php echo base_url('/assets/js/forms/custom-validation-init.js'); ?>"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.17/dist/sweetalert2.all.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script> -->


    <script>
        let $btnRegister = $('#btn-register')
        let $cbCondition = $(".cbCondition")

        function checkForm() {

            let $email = $('input[name="txtEmail"]').val()
            let $password = $('input[name="password1"]').val()
            let $confirmPasword = $('input[name="password2"]').val()

            // Input
            if ($email != '' && $password != '' && $confirmPasword != '') {
                if ($cbCondition.is(":checked"))
                    $btnRegister.prop('disabled', false)
                else
                    $btnRegister.prop('disabled', true)

            } else
                $btnRegister.prop('disabled', true)
        }

        $('input').on('change', function() {
            checkForm()
        })

        $cbCondition.on('change', function() {
            checkForm()
        })

        $btnRegister.on('click', function(e) {
            e.preventDefault()
            $btnRegister.prop('disabled', true)

            let $email = $('input[name="txtEmail"]').val()
            let $password = $('input[name="password1"]').val()
            let $confirmPasword = $('input[name="password2"]').val()

            if ($email == '') {
                alert('กรุณา ระบุอีเมล')
                return false;
            } else if ($password == '') {
                alert('กรุณา ระบุรหัสผ่าน')
                return false;
            } else if ($confirmPasword == '') {
                alert('กรุณา ระบุยืนยันรหัสผ่าน')
                return false;
            }

            if ($password != $confirmPasword) {
                alert('รหัสผ่านไม่ตรงกัน')
                return false;
            }

            let dataObj = {
                email: $email,
                password: $password
            }

            $.ajax({
                type: 'POST',
                url: `${serverUrl}/register`,
                contentType: 'application/json; charset=utf-8;',
                processData: false,
                data: JSON.stringify(dataObj),
                success: function(res) {
                    if (res.success === 1) {

                        $btnRegister.prop('disabled', false)

                        Swal.fire({
                            icon: 'success',
                            text: `${res.message}`,
                            timer: '2000',
                            heightAuto: false
                        });

                        $.ajax({
                            type: 'POST',
                            url: `${serverUrl}/login`,
                            contentType: 'application/json; charset=utf-8;',
                            processData: false,
                            data: JSON.stringify({
                                username: $email,
                                password: $password
                            }),
                            success: function(res) {
                                if (res.success === 1) {
                                    window.location.href = res.redirect_to;
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

                        window.location.href = res.redirect_to;
                    } else {

                        Swal.fire({
                            icon: 'warning',
                            text: `${res.message}`,
                            timer: '2000',
                            heightAuto: false
                        });

                        $btnRegister.prop('disabled', false)
                    }
                },
                error: function(res) {

                    $btnRegister.prop('disabled', false)

                    Swal.fire({
                        icon: 'error',
                        title: '',
                        text: `${res.responseJSON.message}`,
                        timer: '2000',
                        heightAuto: false
                    });
                }
            })

        });
    </script>
</body>

</html>