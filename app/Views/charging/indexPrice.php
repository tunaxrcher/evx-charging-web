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
                                        ตั้งค่าราคาบริการ
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
                        <iconify-icon icon="solar:chat-round-money-broken" class="me-2 fs-6"></iconify-icon>
                        <span class="d-none d-md-block">ข้อมูลค่าบริการ</span>
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
                                        <h4 class="card-title">ข้อมูลค่าบริการปัจจุบัน</h4>                 
                                        
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="mb-3" id="update-danger">
                                                        <label class="form-label">ราคา (/h)</label>
                                                        <input type="hidden" class="form-control" id="oldPriceId" placeholder="" name="oldPriceId" >
                                                        <input type="number" class="form-control" id="oldPriceKWh" placeholder="" name="oldPriceKWh"  pattern="/^-?\d+\.?\d*$/" onkeypress="clearClassDanger('update-danger');">
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="mb-3" id="update-danger-unit">
                                                        <label for="" class="form-label">หน่วยเงิน</label>
                                                        <input type="text" class="form-control" id="oldPriceKUnit" placeholder="" name="oldPriceKUnit" onkeypress="clearClassDanger('update-danger-unit');">
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="d-flex align-items-center justify-content-end mt-4">
                                                        <button class="btn btn-primary btnUpdatePrice w-100" >แก้ไข</button>
                                                    </div>
                                                </div>
                                            </div>
                                       
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 d-flex align-items-stretch">
                                <div class="card w-100 border position-relative overflow-hidden">
                                    <div class="card-body p-4">
                                        <h4 class="card-title">ข้อมูลค่าบริการใหม่</h4>                    
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="mb-3" id="save-danger">
                                                        <label class="form-label">ราคา (/h)</label>
                                                        <input type="number" class="form-control" id="NewPriceKWh" placeholder="" name="NewPriceKWh"  pattern="/^-?\d+\.?\d*$/" onkeypress="clearClassDanger('save-danger');">
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="mb-3" id="save-danger-unit">
                                                        <label for="" class="form-label">หน่วยเงิน</label>
                                                        <input type="text" class="form-control" id="NewPriceKUnit" placeholder="" name="NewPriceKUnit" onkeypress="clearClassDanger('save-danger-unit');">
                                                    </div>
                                                </div>
                                                <div class="col-12" >
                                                    <div class="d-flex align-items-center justify-content-end mt-4">
                                                        <button class="btn btn-primary btnSavePrice w-100">ยืนยัน</button>
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