<div class="body-wrapper">
  <div class="container-fluid">

    <div class="card card-body py-3">
      <div class="row align-items-center">
        <div class="col-12">
          <div class="d-sm-flex align-items-center justify-space-between">
            <h4 class="mb-4 mb-md-0 card-title">ประวัติ</h4>
            <nav aria-label="breadcrumb" class="ms-auto">
              <ol class="breadcrumb">
                <li class="breadcrumb-item d-flex align-items-center">
                  <a class="text-muted text-decoration-none d-flex" href="<?php echo base_url(); ?>">
                    <iconify-icon icon="solar:home-2-line-duotone" class="fs-6"></iconify-icon>
                  </a>
                </li>
                <li class="breadcrumb-item" aria-current="page">
                  <span class="badge fw-medium fs-2 bg-primary-subtle text-primary">
                    ปวะรัติ
                  </span>
                </li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </div>

    <div class="card">
      <div class="card-body">
        <ul class="nav nav-tabs" role="tablist" style="justify-content: center;">
          <li class="nav-item" role="presentation">
            <a class="nav-link d-flex active" data-bs-toggle="tab" href="#menu1" role="tab" aria-selected="true">
              <span>
                <iconify-icon icon="material-symbols:ev-charger" width="1.2em" height="1.2em" style="color: white"></iconify-icon>
              </span>
              <span class="d-none d-md-block ms-2">ประวัติการใช้บริการ</span>
            </a>
          </li>
          <li class="nav-item" role="presentation">
            <a class="nav-link d-flex" data-bs-toggle="tab" href="#menu2" role="tab" aria-selected="false" tabindex="-1">
              <span>
                <iconify-icon icon="material-symbols:book" width="1.2em" height="1.2em" style="color: white"></iconify-icon>
              </span>
              <span class="d-none d-md-block ms-2">ประวัติการจอง</span>
            </a>
          </li>
          <li class="nav-item" role="presentation">
            <a class="nav-link d-flex" data-bs-toggle="tab" href="#menu3" role="tab" aria-selected="false" tabindex="-1">
              <span>
                <iconify-icon icon="la:coins" width="1.2em" height="1.2em" style="color: white"></iconify-icon>
              </span>
              <span class="d-none d-md-block ms-2">ประวัติการเติมเงิน</span>
            </a>
          </li>
        </ul>
      </div>
    </div>

    <div class="row">
      <div class="col-12">
        <!-- start Tab with dropdown -->
        <div class="tab-content">
          <div class="tab-pane active" id="menu1" role="tabpanel">
            <div class="card">
              <div class="card-body">
                <div class="datatables" style="overflow-x: auto;">
                  <div class="">
                    <table id="tableMenu1" class="table table-striped table-bordered text-nowrap align-middle">
                      <thead>
                        <!-- start row -->
                        <tr>
                          <th>สถานี</th>
                          <th>จุดบริการ</th>
                          <th>รายละเอียดหัวชาร์จ</th>
                          <th>วันที่</th>
                          <th>จำนวน (หน่วย)</th>
                          <th>ค่าบริการ</th>
                          <th>ค่าธรรมเนียมสถานี</th>
                          <th>ค่าบริการจอดรถหลังการชาร์จ</th>
                          <th>ส่วนลด</th>
                          <th>รวม</th>
                          <th>ระยะเวลาชาร์จ</th>
                          <th>ช่องทางชำระค่าบริการ</th>
                          <th>วันที่ชำระค่าบริการ</th>
                          <th>แสดงกราฟ</th>
                        </tr>
                        <!-- end row -->
                      </thead>
                      <tbody>
                        <!-- start row -->
                        <tr>
                          <td>
                            <div class="d-flex align-items-center gap-6">
                              <img src="../assets/images/profile/user-4.jpg" width="45" class="rounded-circle" />
                              <h6 class="mb-0"> Tiger Nixon</h6>
                            </div>
                          </td>
                          <td>-</td>
                          <td>-</td>
                          <td>-</td>
                          <td>-</td>
                          <td>-</td>
                          <td>-</td>
                          <td>-</td>
                          <td>-</td>
                          <td>-</td>
                          <td>-</td>
                          <td>-</td>
                          <td>-</td>
                          <td>-</td>
                        </tr>
                        <!-- end row -->
                        <!-- start row -->
                        <tr>
                          <td>
                            <div class="d-flex align-items-center gap-6">
                              <img src="../assets/images/profile/user-2.jpg" width="45" class="rounded-circle" />
                              <h6 class="mb-0"> Garrett Winters</h6>
                            </div>
                          </td>
                          <td>-</td>
                          <td>-</td>
                          <td>-</td>
                          <td>-</td>
                          <td>-</td>
                          <td>-</td>
                          <td>-</td>
                          <td>-</td>
                          <td>-</td>
                          <td>-</td>
                          <td>-</td>
                          <td>-</td>
                          <td>-</td>
                        </tr>
                        <!-- end row -->
                        <!-- start row -->
                        <tr>
                          <td>
                            <div class="d-flex align-items-center gap-6">
                              <img src="../assets/images/profile/user-3.jpg" width="45" class="rounded-circle" />
                              <h6 class="mb-0"> Ashton Cox</h6>
                            </div>
                          </td>
                          <td>-</td>
                          <td>-</td>
                          <td>-</td>
                          <td>-</td>
                          <td>-</td>
                          <td>-</td>
                          <td>-</td>
                          <td>-</td>
                          <td>-</td>
                          <td>-</td>
                          <td>-</td>
                          <td>-</td>
                          <td>-</td>
                        </tr>
                        <!-- end row -->
                      </tbody>
                      <tfoot>
                        <!-- start row -->
                        <tr>
                          <th>สถานี</th>
                          <th>จุดบริการ</th>
                          <th>รายละเอียดหัวชาร์จ</th>
                          <th>วันที่</th>
                          <th>จำนวน (หน่วย)</th>
                          <th>ค่าบริการ</th>
                          <th>ค่าธรรมเนียมสถานี</th>
                          <th>ค่าบริการจอดรถหลังการชาร์จ</th>
                          <th>ส่วนลด</th>
                          <th>รวม</th>
                          <th>ระยะเวลาชาร์จ</th>
                          <th>ช่องทางชำระค่าบริการ</th>
                          <th>วันที่ชำระค่าบริการ</th>
                          <th>แสดงกราฟ</th>
                        </tr>
                        <!-- end row -->
                      </tfoot>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="tab-pane" id="menu2" role="tabpanel">
            <div class="card">
              <div class="card-body">
                <div class="datatables" style="overflow-x: auto;">
                  <div class="">
                    <table id="tableMenu2" class="table table-striped table-bordered text-nowrap align-middle">
                      <thead>
                        <!-- start row -->
                        <tr>
                          <th>เวลาที่บันทึก</th>
                          <th>สถานี</th>
                          <th>จุดบริการ</th>
                          <th>หัวชาร์จ</th>
                          <th>รายละเอียดหัวชาร์จ</th>
                          <th>เวลาที่จอง</th>
                          <th>สถานะ</th>
                        </tr>
                        <!-- end row -->
                      </thead>
                      <tbody>
                        <!-- start row -->
                        <tr>
                          <td>-</td>
                          <td>-</td>
                          <td>-</td>
                          <td>-</td>
                          <td>-</td>
                          <td>-</td>
                          <td>-</td>
                        </tr>
                        <!-- end row -->
                        <!-- start row -->
                        <tr>
                          <td>-</td>
                          <td>-</td>
                          <td>-</td>
                          <td>-</td>
                          <td>-</td>
                          <td>-</td>
                          <td>-</td>
                        </tr>
                        <!-- end row -->
                        <!-- start row -->
                        <tr>
                          <td>-</td>
                          <td>-</td>
                          <td>-</td>
                          <td>-</td>
                          <td>-</td>
                          <td>-</td>
                          <td>-</td>
                        </tr>
                        <!-- end row -->
                      </tbody>
                      <tfoot>
                        <!-- start row -->
                        <tr>
                          <th>เวลาที่บันทึก</th>
                          <th>สถานี</th>
                          <th>จุดบริการ</th>
                          <th>หัวชาร์จ</th>
                          <th>รายละเอียดหัวชาร์จ</th>
                          <th>เวลาที่จอง</th>
                          <th>สถานะ</th>
                        </tr>
                        <!-- end row -->
                      </tfoot>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="tab-pane" id="menu3" role="tabpanel">
            <div class="card">
              <div class="card-body">
                <div class="datatables" style="overflow-x: auto;">
                  <div class="">
                    <table id="tableMenu3" class="table table-striped table-bordered text-nowrap align-middle">
                      <thead>
                        <!-- start row -->
                        <tr>
                          <th>วันที่ทำรายการ</th>
                          <th>จำนวน</th>
                          <th>ทำรายการโดย</th>
                        </tr>
                        <!-- end row -->
                      </thead>
                      <tbody>
                        <!-- start row -->
                        <tr>
                          <td>-</td>
                          <td>-</td>
                          <td>-</td>
                        </tr>
                        <!-- end row -->
                        <!-- start row -->
                        <tr>
                          <td>-</td>
                          <td>-</td>
                          <td>-</td>
                        </tr>
                        <!-- end row -->
                        <!-- start row -->
                        <tr>
                          <td>-</td>
                          <td>-</td>
                          <td>-</td>
                        </tr>
                        <!-- end row -->
                      </tbody>
                      <tfoot>
                        <!-- start row -->
                        <tr>
                          <th>วันที่ทำรายการ</th>
                          <th>จำนวน</th>
                          <th>ทำรายการโดย</th>
                        </tr>
                        <!-- end row -->
                      </tfoot>
                    </table>
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