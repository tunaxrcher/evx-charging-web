<div class="body-wrapper">
    <div class="container-fluid">
        <div class="card card-body py-3">
            <div class="row align-items-center">
                <div class="col-12">
                    <div class="d-sm-flex align-items-center justify-space-between">
                        <h4 class="mb-4 mb-md-0 card-title">บัญชีผู้ใช้งาน</h4>
                        <nav aria-label="breadcrumb" class="ms-auto">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item d-flex align-items-center">
                                    <a class="text-muted text-decoration-none d-flex" href="<?php echo base_url(); ?>">
                                        <iconify-icon icon="solar:home-2-line-duotone" class="fs-6"></iconify-icon>
                                    </a>
                                </li>
                                <li class="breadcrumb-item" aria-current="page">
                                    <span class="badge fw-medium fs-2 bg-primary-subtle text-primary">
                                        บัญชีผู้ใช้งาน
                                    </span>
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <ul class="nav nav-pills user-profile-tab" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link position-relative rounded-0 active d-flex align-items-center justify-content-center bg-transparent fs-3 py-3" id="personal-detail-tab" data-bs-toggle="pill" data-bs-target="#personal-detail" type="button" role="tab" aria-controls="personal-detail" aria-selected="true">
                        <i class="ti ti-user-circle me-2 fs-6"></i>
                        <span class="d-none d-md-block">ข้อมูลส่วนตัว</span>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link position-relative rounded-0 d-flex align-items-center justify-content-center bg-transparent fs-3 py-3" id="pills-bills-tab" data-bs-toggle="pill" data-bs-target="#pills-bills" type="button" role="tab" aria-controls="pills-bills" aria-selected="false">
                        <i class="ti ti-article me-2 fs-6"></i>
                        <span class="d-none d-md-block">ข้อมูลรถ</span>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link position-relative rounded-0 d-flex align-items-center justify-content-center bg-transparent fs-3 py-3" id="pills-security-tab" data-bs-toggle="pill" data-bs-target="#pills-security" type="button" role="tab" aria-controls="pills-security" aria-selected="false">
                        <i class="ti ti-lock me-2 fs-6"></i>
                        <span class="d-none d-md-block">Security</span>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="disabled nav-link position-relative rounded-0 d-flex align-items-center justify-content-center bg-transparent fs-3 py-3" id="pills-notifications-tab" data-bs-toggle="pill" data-bs-target="#pills-notifications" type="button" role="tab" aria-controls="pills-notifications" aria-selected="false">
                        <i class="ti ti-bell me-2 fs-6"></i>
                        <span class="d-none d-md-block">บัตร RFID</span>
                    </button>
                </li>
            </ul>
            <div class="card-body">
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="personal-detail" role="tabpanel" aria-labelledby="personal-detail-tab" tabindex="0">
                        <div class="row">
                            <div class="col-lg-6 d-flex align-items-stretch">
                                <div class="card w-100 border position-relative overflow-hidden">
                                    <div class="card-body p-4">
                                        <h4 class="card-title">Change Profile</h4>
                                        <p class="card-subtitle mb-4">Change your profile picture from here</p>
                                        <div class="text-center">
                                            <img src="../assets/images/profile/user-1.jpg" alt="matdash-img" class="img-fluid rounded-circle" width="120" height="120">
                                            <div class="d-flex align-items-center justify-content-center my-4 gap-6">
                                                <button class="btn btn-warning">เลือกรูป ...</button>
                                                <button class="btn bg-success-subtle text-success">บันทึก</button>
                                            </div>
                                            <p class="mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 d-flex align-items-stretch">
                                <div class="card w-100 border position-relative overflow-hidden">
                                    <div class="card-body p-4">
                                    <h4 class="card-title">ข้อมูลส่วนบุคคล</h4>
                                        <p class="card-subtitle mb-4">To change your personal detail , edit and save from here</p>
                                        <form id="formPersonalDetail">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="mb-3">
                                                        <label class="form-label">เบอร์โทรศัพท์</label>
                                                        <input type="text" class="form-control" id="" placeholder="" name="phone" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="mb-3">
                                                        <label for="" class="form-label">อีเมล</label>
                                                        <input type="text" class="form-control" id="" placeholder="" name="email" disabled>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="col-lg-12">
                                                <div class="mb-3">
                                                        <label for="" class="form-label">ชื่อ - นามสกุล</label>
                                                        <input type="text" class="form-control" id="" placeholder="" name="fullname">
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="d-flex align-items-center justify-content-end mt-4">
                                                        <button class="btn btn-primary btnSave w-100">ยืนยัน</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-notifications" role="tabpanel" aria-labelledby="pills-notifications-tab" tabindex="0">
                        <div class="row justify-content-center">
                            <div class="col-lg-9">
                                <div class="card border shadow-none">
                                    <div class="card-body p-4">
                                        <h4 class="card-title">Notification Preferences</h4>
                                        <p class="card-subtitle mb-4">
                                            Select the notificaitons ou would like to receive via email. Please note that you cannot opt
                                            out of receving service
                                            messages, such as payment, security or legal notifications.
                                        </p>
                                        <form class="mb-7">
                                            <label for="exampleInputtext5" class="form-label">Email Address*</label>
                                            <input type="text" class="form-control" id="exampleInputtext5" placeholder="" required>
                                            <p class="mb-0">Required for notificaitons.</p>
                                        </form>
                                        <div>
                                            <div class="d-flex align-items-center justify-content-between mb-4">
                                                <div class="d-flex align-items-center gap-3">
                                                    <div class="text-bg-light rounded-1 p-6 d-flex align-items-center justify-content-center">
                                                        <i class="ti ti-article text-dark d-block fs-7" width="22" height="22"></i>
                                                    </div>
                                                    <div>
                                                        <h5 class="fs-4 fw-semibold">Our newsletter</h5>
                                                        <p class="mb-0">We'll always let you know about important changes</p>
                                                    </div>
                                                </div>
                                                <div class="form-check form-switch mb-0">
                                                    <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked">
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between mb-4">
                                                <div class="d-flex align-items-center gap-3">
                                                    <div class="text-bg-light rounded-1 p-6 d-flex align-items-center justify-content-center">
                                                        <i class="ti ti-checkbox text-dark d-block fs-7" width="22" height="22"></i>
                                                    </div>
                                                    <div>
                                                        <h5 class="fs-4 fw-semibold">Order Confirmation</h5>
                                                        <p class="mb-0">You will be notified when customer order any product</p>
                                                    </div>
                                                </div>
                                                <div class="form-check form-switch mb-0">
                                                    <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked1" checked>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between mb-4">
                                                <div class="d-flex align-items-center gap-3">
                                                    <div class="text-bg-light rounded-1 p-6 d-flex align-items-center justify-content-center">
                                                        <i class="ti ti-clock-hour-4 text-dark d-block fs-7" width="22" height="22"></i>
                                                    </div>
                                                    <div>
                                                        <h5 class="fs-4 fw-semibold">Order Status Changed</h5>
                                                        <p class="mb-0">You will be notified when customer make changes to the order</p>
                                                    </div>
                                                </div>
                                                <div class="form-check form-switch mb-0">
                                                    <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked2" checked>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between mb-4">
                                                <div class="d-flex align-items-center gap-3">
                                                    <div class="text-bg-light rounded-1 p-6 d-flex align-items-center justify-content-center">
                                                        <i class="ti ti-truck-delivery text-dark d-block fs-7" width="22" height="22"></i>
                                                    </div>
                                                    <div>
                                                        <h5 class="fs-4 fw-semibold">Order Delivered</h5>
                                                        <p class="mb-0">You will be notified once the order is delivered</p>
                                                    </div>
                                                </div>
                                                <div class="form-check form-switch mb-0">
                                                    <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked3">
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div class="d-flex align-items-center gap-3">
                                                    <div class="text-bg-light rounded-1 p-6 d-flex align-items-center justify-content-center">
                                                        <i class="ti ti-mail text-dark d-block fs-7" width="22" height="22"></i>
                                                    </div>
                                                    <div>
                                                        <h5 class="fs-4 fw-semibold">Email Notification</h5>
                                                        <p class="mb-0">Turn on email notificaiton to get updates through email</p>
                                                    </div>
                                                </div>
                                                <div class="form-check form-switch mb-0">
                                                    <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked4" checked>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-9">
                                <div class="card border shadow-none">
                                    <div class="card-body p-4">
                                        <h4 class="card-title">Date & Time</h4>
                                        <p class="card-subtitle">Time zones and calendar display settings.</p>
                                        <div class="d-flex align-items-center justify-content-between mt-7">
                                            <div class="d-flex align-items-center gap-3">
                                                <div class="text-bg-light rounded-1 p-6 d-flex align-items-center justify-content-center">
                                                    <i class="ti ti-clock-hour-4 text-dark d-block fs-7" width="22" height="22"></i>
                                                </div>
                                                <div>
                                                    <p class="mb-0">Time zone</p>
                                                    <h5 class="fs-4 fw-semibold">(UTC + 02:00) Athens, Bucharet</h5>
                                                </div>
                                            </div>
                                            <a class="text-dark fs-6 d-flex align-items-center justify-content-center bg-transparent p-2 fs-4 rounded-circle" href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Download">
                                                <i class="ti ti-download"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-9">
                                <div class="card border shadow-none">
                                    <div class="card-body p-4">
                                        <h4 class="card-title">Ignore Tracking</h4>
                                        <div class="d-flex align-items-center justify-content-between mt-7">
                                            <div class="d-flex align-items-center gap-3">
                                                <div class="text-bg-light rounded-1 p-6 d-flex align-items-center justify-content-center">
                                                    <i class="ti ti-player-pause text-dark d-block fs-7" width="22" height="22"></i>
                                                </div>
                                                <div>
                                                    <h5 class="fs-4 fw-semibold">Ignore Browser Tracking</h5>
                                                    <p class="mb-0">Browser Cookie</p>
                                                </div>
                                            </div>
                                            <div class="form-check form-switch mb-0">
                                                <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked5">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="d-flex align-items-center justify-content-end gap-6">
                                    <button class="btn btn-primary">Save</button>
                                    <button class="btn bg-danger-subtle text-danger">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-bills" role="tabpanel" aria-labelledby="pills-bills-tab" tabindex="0">
                        <div class="">
                            <ul class="nav nav-pills p-3 mb-3 rounded align-items-center card flex-row">
                                <li class="nav-item ms-auto">
                                    <a href="javascript:void(0)" class="btn btn-primary d-flex align-items-center px-3 gap-6" id="add-notes">
                                        <i class="ti ti-file fs-4"></i>
                                        <span class="d-none d-md-block fw-medium fs-3">เพิ่มรถ</span>
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div id="note-full-container" class="note-has-grid row">
                                    <div class="col-md-4 single-note-item all-category" style="">
                                        <div class="card card-body mb-0">
                                            <span class="side-stick"></span>
                                            <h6 class="note-title text-truncate w-75 mb-0" data-noteheading="Book a Ticket for Movie"> NETA X500 </h6>
                                            <p class="note-date fs-2">00 March 0000</p>
                                            <img class="rounded mb-2" src="https://evxspst.sgp1.cdn.digitaloceanspaces.com/uploads/stock_img/CTX000405_1721279445_4166449f6a24861be7d7.jpeg" alt="">
                                            <div class="note-content">Blandit tempus porttitor aasfs. Integer posuere erat a ante venenatis.</div>
                                            <div class="d-flex align-items-center">
                                                <a href="javascript:void(0)" class="link me-1">
                                                    <i class="ti ti-star fs-4 favourite-note"></i>
                                                </a>
                                                <a href="javascript:void(0)" class="link text-danger ms-2">
                                                    <i class="ti ti-trash fs-4 remove-note"></i>
                                                </a>
                                                <div class="ms-auto">
                                                    <div class="category-selector btn-group">
                                                        <a class="nav-link category-dropdown label-group p-0" data-bs-toggle="dropdown" href="javascript:void(0)" role="button" aria-haspopup="true" aria-expanded="true">
                                                            <div class="category">
                                                                <div class="category-business"></div>
                                                                <div class="category-social"></div>
                                                                <div class="category-important"></div>
                                                                <span class="more-options text-dark">
                                                                    <i class="ti ti-dots-vertical fs-5"></i>
                                                                </span>
                                                            </div>
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-right category-menu">
                                                            <a class="note-business badge-group-item badge-business dropdown-item position-relative category-business d-flex align-items-center" href="javascript:void(0);">Business</a>
                                                            <a class="note-social badge-group-item badge-social dropdown-item position-relative category-social d-flex align-items-center" href="javascript:void(0);"> Social</a>
                                                            <a class="note-important badge-group-item badge-important dropdown-item position-relative category-important d-flex align-items-center" href="javascript:void(0);"> Important</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4 single-note-item all-category note-important" style="">
                                        <div class="card card-body mb-0">
                                            <span class="side-stick"></span>
                                            <h6 class="note-title text-truncate w-75 mb-0" data-noteheading="Book a Ticket for Movie"> NETA X500 </h6>
                                            <p class="note-date fs-2">00 March 0000</p>
                                            <img class="rounded mb-2" src="https://evxspst.sgp1.cdn.digitaloceanspaces.com/uploads/stock_img/CTX000405_1721279445_4166449f6a24861be7d7.jpeg" alt="">
                                            <div class="note-content">Blandit tempus porttitor aasfs. Integer posuere erat a ante venenatis.</div>
                                            <div class="d-flex align-items-center">
                                                <a href="javascript:void(0)" class="link me-1">
                                                    <i class="ti ti-star fs-4 favourite-note"></i>
                                                </a>
                                                <a href="javascript:void(0)" class="link text-danger ms-2">
                                                    <i class="ti ti-trash fs-4 remove-note"></i>
                                                </a>
                                                <div class="ms-auto">
                                                    <div class="category-selector btn-group">
                                                        <a class="nav-link category-dropdown label-group p-0" data-bs-toggle="dropdown" href="javascript:void(0)" role="button" aria-haspopup="true" aria-expanded="true">
                                                            <div class="category">
                                                                <div class="category-business"></div>
                                                                <div class="category-social"></div>
                                                                <div class="category-important"></div>
                                                                <span class="more-options text-dark">
                                                                    <i class="ti ti-dots-vertical fs-5"></i>
                                                                </span>
                                                            </div>
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-right category-menu">
                                                            <a class="note-business badge-group-item badge-business dropdown-item position-relative category-business d-flex align-items-center" href="javascript:void(0);">Business</a>
                                                            <a class="note-social badge-group-item badge-social dropdown-item position-relative category-social d-flex align-items-center" href="javascript:void(0);"> Social</a>
                                                            <a class="note-important badge-group-item badge-important dropdown-item position-relative category-important d-flex align-items-center" href="javascript:void(0);"> Important</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 single-note-item all-category note-social" style="">
                                        <div class="card card-body mb-0">
                                            <span class="side-stick"></span>
                                            <h6 class="note-title text-truncate w-75 mb-0" data-noteheading="Book a Ticket for Movie"> NETA X500 </h6>
                                            <p class="note-date fs-2">00 March 0000</p>
                                            <img class="rounded mb-2" src="https://evxspst.sgp1.cdn.digitaloceanspaces.com/uploads/stock_img/CTX000405_1721279445_4166449f6a24861be7d7.jpeg" alt="">
                                            <div class="note-content">Blandit tempus porttitor aasfs. Integer posuere erat a ante venenatis.</div>
                                            <div class="d-flex align-items-center">
                                                <a href="javascript:void(0)" class="link me-1">
                                                    <i class="ti ti-star fs-4 favourite-note"></i>
                                                </a>
                                                <a href="javascript:void(0)" class="link text-danger ms-2">
                                                    <i class="ti ti-trash fs-4 remove-note"></i>
                                                </a>
                                                <div class="ms-auto">
                                                    <div class="category-selector btn-group">
                                                        <a class="nav-link category-dropdown label-group p-0" data-bs-toggle="dropdown" href="javascript:void(0)" role="button" aria-haspopup="true" aria-expanded="true">
                                                            <div class="category">
                                                                <div class="category-business"></div>
                                                                <div class="category-social"></div>
                                                                <div class="category-important"></div>
                                                                <span class="more-options text-dark">
                                                                    <i class="ti ti-dots-vertical fs-5"></i>
                                                                </span>
                                                            </div>
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-right category-menu">
                                                            <a class="note-business badge-group-item badge-business dropdown-item position-relative category-business d-flex align-items-center" href="javascript:void(0);">Business</a>
                                                            <a class="note-social badge-group-item badge-social dropdown-item position-relative category-social d-flex align-items-center" href="javascript:void(0);"> Social</a>
                                                            <a class="note-important badge-group-item badge-important dropdown-item position-relative category-important d-flex align-items-center" href="javascript:void(0);"> Important</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 single-note-item all-category note-business" style="">
                                        <div class="card card-body mb-0">
                                            <span class="side-stick"></span>
                                            <h6 class="note-title text-truncate w-75 mb-0" data-noteheading="Book a Ticket for Movie"> NETA X500 </h6>
                                            <p class="note-date fs-2">00 March 0000</p>
                                            <img class="rounded mb-2" src="https://evxspst.sgp1.cdn.digitaloceanspaces.com/uploads/stock_img/CTX000405_1721279445_4166449f6a24861be7d7.jpeg" alt="">
                                            <div class="note-content">Blandit tempus porttitor aasfs. Integer posuere erat a ante venenatis.</div>
                                            <div class="d-flex align-items-center">
                                                <a href="javascript:void(0)" class="link me-1">
                                                    <i class="ti ti-star fs-4 favourite-note"></i>
                                                </a>
                                                <a href="javascript:void(0)" class="link text-danger ms-2">
                                                    <i class="ti ti-trash fs-4 remove-note"></i>
                                                </a>
                                                <div class="ms-auto">
                                                    <div class="category-selector btn-group">
                                                        <a class="nav-link category-dropdown label-group p-0" data-bs-toggle="dropdown" href="javascript:void(0)" role="button" aria-haspopup="true" aria-expanded="true">
                                                            <div class="category">
                                                                <div class="category-business"></div>
                                                                <div class="category-social"></div>
                                                                <div class="category-important"></div>
                                                                <span class="more-options text-dark">
                                                                    <i class="ti ti-dots-vertical fs-5"></i>
                                                                </span>
                                                            </div>
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-right category-menu">
                                                            <a class="note-business badge-group-item badge-business dropdown-item position-relative category-business d-flex align-items-center" href="javascript:void(0);">Business</a>
                                                            <a class="note-social badge-group-item badge-social dropdown-item position-relative category-social d-flex align-items-center" href="javascript:void(0);"> Social</a>
                                                            <a class="note-important badge-group-item badge-important dropdown-item position-relative category-important d-flex align-items-center" href="javascript:void(0);"> Important</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 single-note-item all-category note-social" style="">
                                        <div class="card card-body mb-0">
                                            <span class="side-stick"></span>
                                            <h6 class="note-title text-truncate w-75 mb-0" data-noteheading="Book a Ticket for Movie"> NETA X500 </h6>
                                            <p class="note-date fs-2">00 March 0000</p>
                                            <img class="rounded mb-2" src="https://evxspst.sgp1.cdn.digitaloceanspaces.com/uploads/stock_img/CTX000405_1721279445_4166449f6a24861be7d7.jpeg" alt="">
                                            <div class="note-content">Blandit tempus porttitor aasfs. Integer posuere erat a ante venenatis.</div>
                                            <div class="d-flex align-items-center">
                                                <a href="javascript:void(0)" class="link me-1">
                                                    <i class="ti ti-star fs-4 favourite-note"></i>
                                                </a>
                                                <a href="javascript:void(0)" class="link text-danger ms-2">
                                                    <i class="ti ti-trash fs-4 remove-note"></i>
                                                </a>
                                                <div class="ms-auto">
                                                    <div class="category-selector btn-group">
                                                        <a class="nav-link category-dropdown label-group p-0" data-bs-toggle="dropdown" href="javascript:void(0)" role="button" aria-haspopup="true" aria-expanded="true">
                                                            <div class="category">
                                                                <div class="category-business"></div>
                                                                <div class="category-social"></div>
                                                                <div class="category-important"></div>
                                                                <span class="more-options text-dark">
                                                                    <i class="ti ti-dots-vertical fs-5"></i>
                                                                </span>
                                                            </div>
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-right category-menu">
                                                            <a class="note-business badge-group-item badge-business dropdown-item position-relative category-business d-flex align-items-center" href="javascript:void(0);">Business</a>
                                                            <a class="note-social badge-group-item badge-social dropdown-item position-relative category-social d-flex align-items-center" href="javascript:void(0);"> Social</a>
                                                            <a class="note-important badge-group-item badge-important dropdown-item position-relative category-important d-flex align-items-center" href="javascript:void(0);"> Important</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 single-note-item all-category note-important" style="">
                                        <div class="card card-body mb-0">
                                            <span class="side-stick"></span>
                                            <h6 class="note-title text-truncate w-75 mb-0" data-noteheading="Book a Ticket for Movie"> NETA X500 </h6>
                                            <p class="note-date fs-2">00 March 0000</p>
                                            <img class="rounded mb-2" src="https://evxspst.sgp1.cdn.digitaloceanspaces.com/uploads/stock_img/CTX000405_1721279445_4166449f6a24861be7d7.jpeg" alt="">
                                            <div class="note-content">Blandit tempus porttitor aasfs. Integer posuere erat a ante venenatis.</div>
                                            <div class="d-flex align-items-center">
                                                <a href="javascript:void(0)" class="link me-1">
                                                    <i class="ti ti-star fs-4 favourite-note"></i>
                                                </a>
                                                <a href="javascript:void(0)" class="link text-danger ms-2">
                                                    <i class="ti ti-trash fs-4 remove-note"></i>
                                                </a>
                                                <div class="ms-auto">
                                                    <div class="category-selector btn-group">
                                                        <a class="nav-link category-dropdown label-group p-0" data-bs-toggle="dropdown" href="javascript:void(0)" role="button" aria-haspopup="true" aria-expanded="true">
                                                            <div class="category">
                                                                <div class="category-business"></div>
                                                                <div class="category-social"></div>
                                                                <div class="category-important"></div>
                                                                <span class="more-options text-dark">
                                                                    <i class="ti ti-dots-vertical fs-5"></i>
                                                                </span>
                                                            </div>
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-right category-menu">
                                                            <a class="note-business badge-group-item badge-business dropdown-item position-relative category-business d-flex align-items-center" href="javascript:void(0);">Business</a>
                                                            <a class="note-social badge-group-item badge-social dropdown-item position-relative category-social d-flex align-items-center" href="javascript:void(0);"> Social</a>
                                                            <a class="note-important badge-group-item badge-important dropdown-item position-relative category-important d-flex align-items-center" href="javascript:void(0);"> Important</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            <!-- Modal Add notes -->
                            <div class="modal fade" id="addnotesmodal" tabindex="-1" aria-labelledby="addnotesmodalTitle" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content border-0">
                                        <div class="modal-header bg-primary rounded-top">
                                            <h6 class="modal-title text-white">Add Notes</h6>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="notes-box">
                                                <div class="notes-content">
                                                    <form action="javascript:void(0);" id="addnotesmodalTitle">
                                                        <div class="row">
                                                            <div class="col-md-12 mb-3">
                                                                <div class="note-title">
                                                                    <label class="form-label">Note Title</label>
                                                                    <input type="text" id="note-has-title" class="form-control" minlength="25" placeholder="Title">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="note-description">
                                                                    <label class="form-label">Note Description</label>
                                                                    <textarea id="note-has-description" class="form-control" minlength="60" placeholder="Description" rows="3"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <div class="d-flex gap-6">
                                                <button class="btn bg-danger-subtle text-danger" data-bs-dismiss="modal">Discard</button>
                                                <button id="btn-n-add" class="btn btn-primary" disabled="disabled">Add</button>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-security" role="tabpanel" aria-labelledby="pills-security-tab" tabindex="0">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="card border shadow-none">
                                    <div class="card-body p-4">
                                        <h4 class="card-title mb-3">Two-factor Authentication</h4>
                                        <div class="d-flex align-items-center justify-content-between pb-7">
                                            <p class="card-subtitle mb-0">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Corporis sapiente
                                                sunt earum officiis laboriosam ut.</p>
                                            <button class="btn btn-primary">Enable</button>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between py-3 border-top">
                                            <div>
                                                <h5 class="fs-4 fw-semibold mb-0">Authentication App</h5>
                                                <p class="mb-0">Google auth app</p>
                                            </div>
                                            <button class="btn bg-primary-subtle text-primary">Setup</button>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between py-3 border-top">
                                            <div>
                                                <h5 class="fs-4 fw-semibold mb-0">Another e-mail</h5>
                                                <p class="mb-0">E-mail to send verification link</p>
                                            </div>
                                            <button class="btn bg-primary-subtle text-primary">Setup</button>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between py-3 border-top">
                                            <div>
                                                <h5 class="fs-4 fw-semibold mb-0">SMS Recovery</h5>
                                                <p class="mb-0">Your phone number or something</p>
                                            </div>
                                            <button class="btn bg-primary-subtle text-primary">Setup</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="card">
                                    <div class="card-body p-4">
                                        <div class="text-bg-light rounded-1 p-6 d-inline-flex align-items-center justify-content-center mb-3">
                                            <i class="ti ti-device-laptop text-primary d-block fs-7" width="22" height="22"></i>
                                        </div>
                                        <h4 class="card-title mb-0">Devices</h4>
                                        <p class="mb-3">Lorem ipsum dolor sit amet consectetur adipisicing elit Rem.</p>
                                        <button class="btn btn-primary mb-4">Sign out from all devices</button>
                                        <div class="d-flex align-items-center justify-content-between py-3 border-bottom">
                                            <div class="d-flex align-items-center gap-3">
                                                <i class="ti ti-device-mobile text-dark d-block fs-7" width="26" height="26"></i>
                                                <div>
                                                    <h5 class="fs-4 fw-semibold mb-0">iPhone 14</h5>
                                                    <p class="mb-0">London UK, Oct 23 at 1:15 AM</p>
                                                </div>
                                            </div>
                                            <a class="text-dark fs-6 d-flex align-items-center justify-content-center bg-transparent p-2 fs-4 rounded-circle" href="javascript:void(0)">
                                                <i class="ti ti-dots-vertical"></i>
                                            </a>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between py-3">
                                            <div class="d-flex align-items-center gap-3">
                                                <i class="ti ti-device-laptop text-dark d-block fs-7" width="26" height="26"></i>
                                                <div>
                                                    <h5 class="fs-4 fw-semibold mb-0">Macbook Air</h5>
                                                    <p class="mb-0">Gujarat India, Oct 24 at 3:15 AM</p>
                                                </div>
                                            </div>
                                            <a class="text-dark fs-6 d-flex align-items-center justify-content-center bg-transparent p-2 fs-4 rounded-circle" href="javascript:void(0)">
                                                <i class="ti ti-dots-vertical"></i>
                                            </a>
                                        </div>
                                        <button class="btn bg-primary-subtle text-primary w-100 py-1">Need Help ?</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="d-flex align-items-center justify-content-end gap-6">
                                    <button class="btn btn-primary">Save</button>
                                    <button class="btn bg-danger-subtle text-danger">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>