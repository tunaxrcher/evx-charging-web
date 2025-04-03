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
    <?php if (isset($css_critical)) {
        echo $css_critical;
    } ?>
    <style>
        /** BASE **/
        * {
            font-family: 'Kanit', sans-serif;
        }
    </style>
    <script>
        var serverUrl = '<?php echo base_url(); ?>';
        var userId = '<?php echo session()->get('userID'); ?> ';
    </script>
</head>

<body>
    <!-- Toast -->
    <div class="toast toast-onload align-items-center text-bg-primary border-0" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-body hstack align-items-start gap-6">
            <i class="ti ti-alert-circle fs-6"></i>
            <div>
                <h5 class="text-white fs-3 mb-1">Welcome to EVX charging</h5>
                <h6 class="text-white fs-2 mb-0">Easy to charging your cars!!!</h6>
            </div>
            <button type="button" class="btn-close btn-close-white fs-2 m-0 ms-auto shadow-none" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
    <!-- Preloader -->
    <div class="preloader">
        <img src="<?php echo base_url('/assets/images/logos/logo.png'); ?>" alt="loader" class="lds-ripple img-fluid" />
    </div>
    <div id="main-wrapper">
        <!-- Sidebar Start -->
        <aside class="side-mini-panel with-vertical">
            <!-- ---------------------------------- -->
            <!-- Start Vertical Layout Sidebar -->
            <!-- ---------------------------------- -->
            <div class="iconbar">
                <div>
                    <div class="mini-nav">
                        <div class="brand-logo d-flex align-items-center justify-content-center">
                            <a class="nav-link sidebartoggler" id="headerCollapse" href="javascript:void(0)">
                                <iconify-icon icon="solar:hamburger-menu-line-duotone" class="fs-7"></iconify-icon>
                            </a>
                        </div>
                        <ul class="mini-nav-ul" data-simplebar>

                            <!-- --------------------------------------------------------------------------------------------------------- -->
                            <!-- Dashboards -->
                            <!-- --------------------------------------------------------------------------------------------------------- -->
                            <li class="mini-nav-item" id="mini-1">
                                <a href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" data-bs-placement="right" data-bs-title="Dashboards">
                                    <iconify-icon icon="solar:layers-line-duotone" class="fs-7"></iconify-icon>
                                </a>
                            </li>

                            <!-- --------------------------------------------------------------------------------------------------------- -->
                            <!-- Pages -->
                            <!-- --------------------------------------------------------------------------------------------------------- -->
                            <li class="mini-nav-item" id="mini-3">
                                <a href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" data-bs-placement="right" data-bs-title="feature coming soon">
                                    <iconify-icon icon="solar:notes-line-duotone" class="fs-7"></iconify-icon>
                                </a>
                            </li>
                            <!-- --------------------------------------------------------------------------------------------------------- -->
                            <!-- Forms  -->
                            <!-- --------------------------------------------------------------------------------------------------------- -->
                            <li class="mini-nav-item" id="mini-4">
                                <a href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" data-bs-placement="right" data-bs-title="feature coming soon">
                                    <iconify-icon icon="solar:palette-round-line-duotone" class="fs-7"></iconify-icon>
                                </a>
                            </li>

                            <li>
                                <span class="sidebar-divider lg"></span>
                            </li>
                            <!-- --------------------------------------------------------------------------------------------------------- -->
                            <!-- Tables -->
                            <!-- --------------------------------------------------------------------------------------------------------- -->
                            <li class="mini-nav-item" id="mini-5">
                                <a href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" data-bs-placement="right" data-bs-title="feature coming soon">
                                    <iconify-icon icon="solar:tuning-square-2-line-duotone" class="fs-7"></iconify-icon>
                                </a>
                            </li>
                        </ul>

                    </div>
                    <div class="sidebarmenu">
                        <div class="brand-logo d-flex align-items-center nav-logo">
                            <a href="<?php echo base_url('/charging/index'); ?>" class="text-nowrap logo-img">
                                <img src="<?php echo base_url('/assets/images/logos/logo.png'); ?>" alt="Logo" />
                            </a>
                        </div>
                        <!-- ---------------------------------- -->
                        <!-- Dashboard -->
                        <!-- ---------------------------------- -->
                        <nav class="sidebar-nav" id="menu-right-mini-1" data-simplebar>
                            <ul class="sidebar-menu" id="sidebarnav">
                                <!-- ---------------------------------- -->
                                <!-- Home -->
                                <!-- ---------------------------------- -->
                                <li class="nav-small-cap">
                                    <span class="hide-menu">ใช้บ่อย</span>
                                </li>
                                <!-- ---------------------------------- -->
                                <!-- Dashboard -->
                                <!-- ---------------------------------- -->

                                <li class="sidebar-item">
                                    <a class="sidebar-link" href="<?php echo base_url('/charging/index'); ?>" aria-expanded="false">
                                        <iconify-icon icon="solar:atom-line-duotone"></iconify-icon>
                                        <span class="hide-menu">เริ่มต้นการชาร์จ</span>
                                    </a>
                                </li>

                                <li class="sidebar-item">
                                    <a class="sidebar-link" href="<?php echo base_url('/map/index'); ?>" aria-expanded="false">
                                        <iconify-icon icon="pepicons-print:map"></iconify-icon>
                                        <span class="hide-menu">แผนที่</span>
                                    </a>
                                </li>

                                <li class="sidebar-item">
                                    <a class="sidebar-link" href="<?php echo base_url('/booking/index'); ?>" aria-expanded="false">
                                        <iconify-icon icon="tabler:brand-booking"></iconify-icon>
                                        <span class="hide-menu">การจอง</span>
                                    </a>
                                </li>

                                <li>
                                    <span class="sidebar-divider"></span>
                                </li>

                                <li class="nav-small-cap">
                                    <span class="hide-menu">Apps</span>
                                </li>
                                <li class="sidebar-item">
                                    <a class="sidebar-link" href="<?php echo base_url('/wallet/topup'); ?>" aria-expanded="false">
                                        <iconify-icon icon="solar:wallet-bold-duotone"></iconify-icon>
                                        เติมเงิน
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a class="sidebar-link" href="<?php echo base_url('/profile/history'); ?>" aria-expanded="false">
                                        <iconify-icon icon="uim:history-alt"></iconify-icon>
                                        ประวัติ
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a class="sidebar-link" href="<?php echo base_url('/profile/index'); ?>" aria-expanded="false">
                                        <iconify-icon icon="gg:profile"></iconify-icon>
                                        บัญชีผู้ใช้งาน
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a class="sidebar-link" href="<?php echo base_url('/charging/indexPriceSetting'); ?>" aria-expanded="false">
                                        <iconify-icon icon="solar:chat-round-money-broken"></iconify-icon>
                                        ตั้งค่าราคาบริการ
                                    </a>
                                </li>
                                <li>
                                    <span class="sidebar-divider"></span>
                                </li>

                                <li class="nav-small-cap">
                                    <span class="hide-menu">อื่น ๆ</span>
                                </li>
                                <li class="sidebar-item">
                                    <a class="sidebar-link" href="<?php echo base_url('/news'); ?>" aria-expanded="false">
                                        <iconify-icon icon="material-symbols:news"></iconify-icon>
                                        ข่าวสาร
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a class="sidebar-link" href="<?php echo base_url('/problem-report'); ?>" aria-expanded="false">
                                        <iconify-icon icon="ic:baseline-report"></iconify-icon>
                                        รายงานปัญหา
                                    </a>
                                </li>
                            </ul>
                        </nav>

                    </div>
                </div>
            </div>
        </aside>
        <!--  Sidebar End -->
        <div class="page-wrapper">
            <!--  Header Start -->
            <header class="topbar">
                <div class="with-vertical">
                    <!-- ---------------------------------- -->
                    <!-- Start Vertical Layout Header -->
                    <!-- ---------------------------------- -->
                    <nav class="navbar navbar-expand-lg p-0">
                        <ul class="navbar-nav">
                            <li class="nav-item d-flex d-xl-none">
                                <a class="nav-link nav-icon-hover-bg rounded-circle  sidebartoggler " id="headerCollapse" href="javascript:void(0)">
                                    <iconify-icon icon="solar:hamburger-menu-line-duotone" class="fs-6"></iconify-icon>
                                </a>
                            </li>
                        </ul>

                        <div class="d-block d-lg-none py-9 py-xl-0">
                            <img src="<?php echo base_url('assets/images/logos/logo.png'); ?>" alt="matdash-img" />
                        </div>
                        <a class="navbar-toggler p-0 border-0 nav-icon-hover-bg rounded-circle" href="javascript:void(0)" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                            <iconify-icon icon="solar:menu-dots-bold-duotone" class="fs-6"></iconify-icon>
                        </a>
                        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                            <div class="d-flex align-items-center justify-content-between">
                                <ul class="navbar-nav flex-row mx-auto ms-lg-auto align-items-center justify-content-center">

                                    <!-- ------------------------------- -->
                                    <!-- start notification Dropdown -->
                                    <!-- ------------------------------- -->
                                    <li class="nav-item dropdown nav-icon-hover-bg rounded-circle">
                                        <a class="nav-link position-relative" href="javascript:void(0)" id="drop2" aria-expanded="false">
                                            <iconify-icon icon="solar:bell-bing-line-duotone" class="fs-6"></iconify-icon>
                                        </a>
                                        <div class="dropdown-menu content-dd dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                                            <div class="d-flex align-items-center justify-content-between py-3 px-7">
                                                <h5 class="mb-0 fs-5 fw-semibold">Notifications</h5>
                                                <span class="badge text-bg-primary rounded-4 px-3 py-1 lh-sm">5 new</span>
                                            </div>
                                            <div class="message-body" data-simplebar>
                                                <a href="javascript:void(0)" class="py-6 px-7 d-flex align-items-center dropdown-item gap-3">
                                                    <span class="flex-shrink-0 bg-danger-subtle rounded-circle round d-flex align-items-center justify-content-center fs-6 text-danger">
                                                        <iconify-icon icon="solar:widget-3-line-duotone"></iconify-icon>
                                                    </span>
                                                    <div class="w-75">
                                                        <div class="d-flex align-items-center justify-content-between">
                                                            <h6 class="mb-1 fw-semibold">Launch Admin</h6>
                                                            <span class="d-block fs-2">9:30 AM</span>
                                                        </div>
                                                        <span class="d-block text-truncate text-truncate fs-11">Just see the my new admin!</span>
                                                    </div>
                                                </a>
                                                <a href="javascript:void(0)" class="py-6 px-7 d-flex align-items-center dropdown-item gap-3">
                                                    <span class="flex-shrink-0 bg-primary-subtle rounded-circle round d-flex align-items-center justify-content-center fs-6 text-primary">
                                                        <iconify-icon icon="solar:calendar-line-duotone"></iconify-icon>
                                                    </span>
                                                    <div class="w-75">
                                                        <div class="d-flex align-items-center justify-content-between">
                                                            <h6 class="mb-1 fw-semibold">Event today</h6>
                                                            <span class="d-block fs-2">9:15 AM</span>
                                                        </div>
                                                        <span class="d-block text-truncate text-truncate fs-11">Just a reminder that you have event</span>
                                                    </div>
                                                </a>
                                                <a href="javascript:void(0)" class="py-6 px-7 d-flex align-items-center dropdown-item gap-3">
                                                    <span class="flex-shrink-0 bg-secondary-subtle rounded-circle round d-flex align-items-center justify-content-center fs-6 text-secondary">
                                                        <iconify-icon icon="solar:settings-line-duotone"></iconify-icon>
                                                    </span>
                                                    <div class="w-75">
                                                        <div class="d-flex align-items-center justify-content-between">
                                                            <h6 class="mb-1 fw-semibold">Settings</h6>
                                                            <span class="d-block fs-2">4:36 PM</span>
                                                        </div>
                                                        <span class="d-block text-truncate text-truncate fs-11">You can customize this template as you want</span>
                                                    </div>
                                                </a>
                                                <a href="javascript:void(0)" class="py-6 px-7 d-flex align-items-center dropdown-item gap-3">
                                                    <span class="flex-shrink-0 bg-warning-subtle rounded-circle round d-flex align-items-center justify-content-center fs-6 text-warning">
                                                        <iconify-icon icon="solar:widget-4-line-duotone"></iconify-icon>
                                                    </span>
                                                    <div class="w-75">
                                                        <div class="d-flex align-items-center justify-content-between">
                                                            <h6 class="mb-1 fw-semibold">Launch Admin</h6>
                                                            <span class="d-block fs-2">9:30 AM</span>
                                                        </div>
                                                        <span class="d-block text-truncate text-truncate fs-11">Just see the my new admin!</span>
                                                    </div>
                                                </a>
                                                <a href="javascript:void(0)" class="py-6 px-7 d-flex align-items-center dropdown-item gap-3">
                                                    <span class="flex-shrink-0 bg-primary-subtle rounded-circle round d-flex align-items-center justify-content-center fs-6 text-primary">
                                                        <iconify-icon icon="solar:calendar-line-duotone"></iconify-icon>
                                                    </span>
                                                    <div class="w-75">
                                                        <div class="d-flex align-items-center justify-content-between">
                                                            <h6 class="mb-1 fw-semibold">Event today</h6>
                                                            <span class="d-block fs-2">9:15 AM</span>
                                                        </div>
                                                        <span class="d-block text-truncate text-truncate fs-11">Just a reminder that you have event</span>
                                                    </div>
                                                </a>
                                                <a href="javascript:void(0)" class="py-6 px-7 d-flex align-items-center dropdown-item gap-3">
                                                    <span class="flex-shrink-0 bg-secondary-subtle rounded-circle round d-flex align-items-center justify-content-center fs-6 text-secondary">
                                                        <iconify-icon icon="solar:settings-line-duotone"></iconify-icon>
                                                    </span>
                                                    <div class="w-75">
                                                        <div class="d-flex align-items-center justify-content-between">
                                                            <h6 class="mb-1 fw-semibold">Settings</h6>
                                                            <span class="d-block fs-2">4:36 PM</span>
                                                        </div>
                                                        <span class="d-block text-truncate text-truncate fs-11">You can customize this template as you want</span>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="py-6 px-7 mb-1">
                                                <button class="btn btn-primary w-100">See All Notifications</button>
                                            </div>

                                        </div>
                                    </li>
                                    <!-- ------------------------------- -->
                                    <!-- end notification Dropdown -->
                                    <!-- ------------------------------- -->

                                    <!-- ------------------------------- -->
                                    <!-- start language Dropdown -->
                                    <!-- ------------------------------- -->
                                    <li class="nav-item dropdown nav-icon-hover-bg rounded-circle">
                                        <a class="nav-link" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown" aria-expanded="false">
                                            <img src="https://cdn-icons-png.flaticon.com/512/13481/13481972.png" alt="matdash-img" width="20px" height="20px" class="rounded-circle object-fit-cover round-20" />
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                                            <div class="message-body">
                                                <a href="javascript:void(0)" class="d-flex align-items-center gap-2 py-3 px-4 dropdown-item">
                                                    <div class="position-relative">
                                                        <img src="https://cdn-icons-png.flaticon.com/512/13481/13481972.png" alt="matdash-img" width="20px" height="20px" class="rounded-circle object-fit-cover round-20" />
                                                    </div>
                                                    <p class="mb-0 fs-3">ไทย (TH)</p>
                                                </a>
                                                <a href="javascript:void(0)" class="d-flex align-items-center gap-2 py-3 px-4 dropdown-item">
                                                    <div class="position-relative">
                                                        <img src="https://cdn-icons-png.flaticon.com/512/197/197568.png" alt="matdash-img" width="20px" height="20px" class="rounded-circle object-fit-cover round-20" />
                                                    </div>
                                                    <p class="mb-0 fs-3">ລາວ (LA)</p>

                                                </a>
                                                <a href="javascript:void(0)" class="d-flex align-items-center gap-2 py-3 px-4 dropdown-item">
                                                    <div class="position-relative">
                                                        <img src="<?php echo base_url('assets/images/flag/icon-flag-en.svg'); ?>" alt="matdash-img" width="20px" height="20px" class="rounded-circle object-fit-cover round-20" />
                                                    </div>
                                                    <p class="mb-0 fs-3">English (UK)</p>
                                                </a>
                                            </div>
                                        </div>
                                    </li>
                                    <!-- ------------------------------- -->
                                    <!-- end language Dropdown -->
                                    <!-- ------------------------------- -->

                                    <!-- ------------------------------- -->
                                    <!-- start profile Dropdown -->
                                    <!-- ------------------------------- -->
                                    <li class="nav-item dropdown">
                                        <a class="nav-link" href="javascript:void(0)" id="drop1" aria-expanded="false">
                                            <div class="d-flex align-items-center gap-2 lh-base">
                                                <img src="<?php echo base_url('assets/images/profile/user-1.jpg'); ?>" class="rounded-circle" width="35" height="35" alt="matdash-img" />
                                                <iconify-icon icon="solar:alt-arrow-down-bold" class="fs-2"></iconify-icon>
                                            </div>
                                        </a>
                                        <div class="dropdown-menu profile-dropdown dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop1">
                                            <div class="position-relative px-4 pt-3 pb-2">
                                                <div class="d-flex align-items-center mb-3 pb-3 border-bottom gap-6">
                                                    <img src="<?php echo base_url('assets/images/profile/user-1.jpg'); ?>" class="rounded-circle" width="56" height="56" alt="matdash-img" />
                                                    <div>
                                                        <h5 class="mb-0 fs-12">Username <span class="text-success fs-11">รูปแบบยูส</span>
                                                        </h5>
                                                        <p class="mb-0 text-dark">
                                                            username@email.com
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="message-body">
                                                    <a href="<?php echo base_url('profile/index'); ?>" class="p-2 dropdown-item h6 rounded-1">
                                                        บัญชี
                                                    </a>
                                                    <a href="javascript:void(0)" class="p-2 dropdown-item h6 rounded-1 disabled">
                                                        My Subscription
                                                    </a>
                                                    <a href="javascript:void(0)" class="p-2 dropdown-item h6 rounded-1 disabled">
                                                        My Statements <span class="badge bg-danger-subtle text-danger rounded ms-8">4</span>
                                                    </a>
                                                    <hr>
                                                    <a href="<?php echo base_url('logout'); ?>" class="p-2 dropdown-item h6 rounded-1">
                                                        ออกจากระบบ
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <!-- ------------------------------- -->
                                    <!-- end profile Dropdown -->
                                    <!-- ------------------------------- -->
                                </ul>
                            </div>
                        </div>
                    </nav>
                    <!-- ---------------------------------- -->
                    <!-- End Vertical Layout Header -->
                    <!-- ---------------------------------- -->

                    <!-- ------------------------------- -->
                    <!-- apps Dropdown in Small screen -->
                    <!-- ------------------------------- -->
                    <!--  Mobilenavbar -->
                    <div class="offcanvas offcanvas-start pt-0" data-bs-scroll="true" tabindex="-1" id="mobilenavbar" aria-labelledby="offcanvasWithBothOptionsLabel">
                        <nav class="sidebar-nav scroll-sidebar">
                            <div class="offcanvas-header justify-content-between">
                                <a href="<?php echo base_url(); ?>" class="text-nowrap logo-img">
                                    <img src="<?php echo base_url('assets/images/logos/logo-icon.svg'); ?>" alt="Logo" />
                                </a>
                                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                            </div>
                            <div class="offcanvas-body pt-0" data-simplebar style="height: calc(100vh - 80px)">
                                <ul id="sidebarnav">
                                    <li class="sidebar-item">
                                        <a class="sidebar-link has-arrow ms-0" href="javascript:void(0)" aria-expanded="false">
                                            <span>
                                                <iconify-icon icon="solar:slider-vertical-line-duotone" class="fs-7"></iconify-icon>
                                            </span>
                                            <span class="hide-menu">Apps</span>
                                        </a>
                                        <ul aria-expanded="false" class="collapse first-level my-3 ps-3">
                                            <li class="sidebar-item py-2">
                                                <a href="../dark/app-chat.html" class="d-flex align-items-center">
                                                    <div class="bg-primary-subtle rounded round-48 me-3 d-flex align-items-center justify-content-center">
                                                        <iconify-icon icon="solar:chat-line-bold-duotone" class="fs-7 text-primary"></iconify-icon>
                                                    </div>
                                                    <div>
                                                        <h6 class="mb-0 bg-hover-primary">Chat Application</h6>
                                                        <span class="fs-11 d-block text-body-color">New messages arrived</span>
                                                    </div>
                                                </a>
                                            </li>
                                            <li class="sidebar-item py-2">
                                                <a href="../dark/app-invoice.html" class="d-flex align-items-center">
                                                    <div class="bg-secondary-subtle rounded round-48 me-3 d-flex align-items-center justify-content-center">
                                                        <iconify-icon icon="solar:bill-list-bold-duotone" class="fs-7 text-secondary"></iconify-icon>
                                                    </div>
                                                    <div>
                                                        <h6 class="mb-0 bg-hover-primary">Invoice App</h6>
                                                        <span class="fs-11 d-block text-body-color">Get latest invoice</span>
                                                    </div>
                                                </a>
                                            </li>
                                            <li class="sidebar-item py-2">
                                                <a href="../dark/app-contact2.html" class="d-flex align-items-center">
                                                    <div class="bg-warning-subtle rounded round-48 me-3 d-flex align-items-center justify-content-center">
                                                        <iconify-icon icon="solar:phone-calling-rounded-bold-duotone" class="fs-7 text-warning"></iconify-icon>
                                                    </div>
                                                    <div>
                                                        <h6 class="mb-0 bg-hover-primary">Contact Application</h6>
                                                        <span class="fs-11 d-block text-body-color">2 Unsaved Contacts</span>
                                                    </div>
                                                </a>
                                            </li>
                                            <li class="sidebar-item py-2">
                                                <a href="../dark/app-email.html" class="d-flex align-items-center">
                                                    <div class="bg-danger-subtle rounded round-48 me-3 d-flex align-items-center justify-content-center">
                                                        <iconify-icon icon="solar:letter-bold-duotone" class="fs-7 text-danger"></iconify-icon>
                                                    </div>
                                                    <div>
                                                        <h6 class="mb-0 bg-hover-primary">Email App</h6>
                                                        <span class="fs-11 d-block text-body-color">Get new emails</span>
                                                    </div>
                                                </a>
                                            </li>
                                            <li class="sidebar-item py-2">
                                                <a href="../dark/page-user-profile.html" class="d-flex align-items-center">
                                                    <div class="bg-success-subtle rounded round-48 me-3 d-flex align-items-center justify-content-center">
                                                        <iconify-icon icon="solar:user-bold-duotone" class="fs-7 text-success"></iconify-icon>
                                                    </div>
                                                    <div>
                                                        <h6 class="mb-0 bg-hover-primary">User Profile</h6>
                                                        <span class="fs-11 d-block text-body-color">learn more information</span>
                                                    </div>
                                                </a>
                                            </li>
                                            <li class="sidebar-item py-2">
                                                <a href="../dark/app-calendar.html" class="d-flex align-items-center">
                                                    <div class="bg-primary-subtle rounded round-48 me-3 d-flex align-items-center justify-content-center">
                                                        <iconify-icon icon="solar:calendar-minimalistic-bold-duotone" class="fs-7 text-primary"></iconify-icon>
                                                    </div>
                                                    <div>
                                                        <h6 class="mb-0 bg-hover-primary">Calendar App</h6>
                                                        <span class="fs-11 d-block text-body-color">Get dates</span>
                                                    </div>
                                                </a>
                                            </li>
                                            <li class="sidebar-item py-2">
                                                <a href="../dark/app-contact.html" class="d-flex align-items-center">
                                                    <div class="bg-secondary-subtle rounded round-48 me-3 d-flex align-items-center justify-content-center">
                                                        <iconify-icon icon="solar:smartphone-2-bold-duotone" class="fs-7 text-secondary"></iconify-icon>
                                                    </div>
                                                    <div>
                                                        <h6 class="mb-0 bg-hover-primary">Contact List Table</h6>
                                                        <span class="fs-11 d-block text-body-color">Add new contact</span>
                                                    </div>
                                                </a>
                                            </li>
                                            <li class="sidebar-item py-2">
                                                <a href="../dark/app-notes.html" class="d-flex align-items-center">
                                                    <div class="bg-warning-subtle rounded round-48 me-3 d-flex align-items-center justify-content-center">
                                                        <iconify-icon icon="solar:notes-bold-duotone" class="fs-7 text-warning"></iconify-icon>
                                                    </div>
                                                    <div>
                                                        <h6 class="mb-0 bg-hover-primary">Notes Application</h6>
                                                        <span class="fs-11 d-block text-body-color">To-do and Daily tasks</span>
                                                    </div>
                                                </a>
                                            </li>
                                    </li>
                                </ul>
                            </div>
                        </nav>
                    </div>

                </div>
            </header>
            <!--  Header End -->