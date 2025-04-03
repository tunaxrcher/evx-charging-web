<style>
    .position-relative {
        position: relative !important;
    }

    #map {
        width: 100%;
        /*height: 80%;*/
        /*450px;*/
        height: 100%;
        border: 0px;
    }

    .map-info-window {
        font-family: "Prompt-Regular";
        text-align: left;
    }

    .info-header {
        font-size: 1.2em;
    }

    .info-header .btn-circle {
        border-radius: 50%;
    }

    .info-content {
        font-size: 1em;
        /*max-width: 400px;*/
    }

    .info-content.station-description {
        font-size: 0.8rem;
    }

    .form-check-input,
    .form-check-label {
        cursor: pointer;
    }

    .noselect {
        -webkit-touch-callout: none;
        /* iOS Safari */
        -webkit-user-select: none;
        /* Safari */
        -khtml-user-select: none;
        /* Konqueror HTML */
        -moz-user-select: none;
        /* Old versions of Firefox */
        -ms-user-select: none;
        /* Internet Explorer/Edge */
        user-select: none;
        /* Non-prefixed version, currently
                          supported by Chrome, Edge, Opera and Firefox */
    }

    .connector-info,
    .service-info,
    .amenity-info,
    .payment-info {
        border: solid 1px #b2b2b2;
        border-radius: 0.3rem;
    }

    .amenity-info ul,
    .payment-info ul {
        margin-top: 0.5rem;
        margin-bottom: 0.5rem;
        list-style-type: none;
        padding-left: 0.8rem;
    }

    .img-map-icon {
        width: 30px;
        height: 40px;
    }

    .img-map-icon-mini {
        width: 25px;
        height: 33px;
    }

    .status-container.mini {
        font-size: smaller;
    }

    .status-container-owner-marker.mini {
        font-size: smaller;
    }

    .img-connector-icon {
        width: 2rem;
        height: 2rem;
    }

    .pac-card {
        background-color: #1a2537;
        border: 0;
        border-radius: 2px;
        box-shadow: 0 1px 4px -1px rgba(0, 0, 0, 0.3);
        margin: 10px;
        padding: 0 0.5em;
        /*font: 400 18px Roboto, Arial, sans-serif;*/
        font: 400 18px;
        overflow: hidden;
        font-family: var(--main-font-family);
        padding: 0;
    }

    #pac-container {
        padding-bottom: 12px;
        margin-right: 12px;
        font-family: var(--main-font-family);
    }

    .pac-container {
        font-family: var(--main-font-family);
    }

    .pac-controls {
        display: inline-block;
        padding: 5px 11px;
    }

    .pac-controls label {
        font-family: var(--main-font-family);
        font-size: 13px;
        font-weight: 300;
    }

    #pac-input {
        background-color: #1f2a3d;
        font-family: var(--main-font-family);
        font-size: 15px;
        font-weight: 300;
        margin-left: 12px;
        padding: 0 11px 0 13px;
        text-overflow: ellipsis;
        border-color: rgba(0, 0, 0, 0.125);
        margin-top: 10px !important;
    }

    #pac-input:focus {
        /*border-color: #4d90fe;*/
        border-color: rgba(0, 0, 0, 0.125);
    }

    .popup-form {
        border: solid 1px #1a2537;
        border-radius: 3px;
        background-color: #1a2537;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
    }

    .carousel {
        height: 200px;
    }

    .carousel-inner {
        height: inherit;
    }

    .carousel-item {
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
    }

    .carousel-item img {
        position: inherit;
        top: inherit;
        bottom: inherit;
        left: inherit;
        right: inherit;
        margin: auto;
    }

    .carousel-control-prev-icon,
    .carousel-control-next-icon {
        height: 100px;
        width: 100px;
        background-size: 100%, 100%;
        background-image: none;
    }

    .carousel-control-next-icon:after {
        content: "›";
        font-size: 55px;
        color: white;
        text-shadow: 1px 1px 2px black, 0 0 25px blue, 0 0 5px darkblue;
    }

    .carousel-control-prev-icon:after {
        content: "‹";
        font-size: 55px;
        color: white;
        text-shadow: 1px 1px 2px black, 0 0 25px blue, 0 0 5px darkblue;
    }

    .carousel-indicators [data-bs-target] {
        box-sizing: content-box;
        flex: 0 1 auto;
        width: 12px;
        /* change width */
        height: 12px;
        /* change height */
        padding: 0;
        margin-bottom: 1px;
        margin-right: 3px;
        margin-left: 3px;
        text-indent: -999px;
        cursor: pointer;
        background-color: #1a2537fff;
        background-clip: padding-box;
        border: 0;
        border-top: 10px solid transparent;
        border-bottom: 10px solid transparent;
        /*opacity: .5;*/
        transition: opacity 0.6s ease;
        border-radius: 100%;
        /*box-shadow: 12px 12px 15px black,12px 12px 15px blue, 12px 12px 15px darkblue */
    }

    .marker-label-gps {
        margin-top: 60px;
    }
</style>
<style>
    .map-info-window {
        color: #01c0c8 !important;
    }
</style>
<div class="body-wrapper">
    <div class="position-relative">
        <div class="position-relative" style="border: none; height: calc(100vh - 129px) !important;">
            <input id="location-input" class="controls mt-1 p-2 h-95 ml-1" type="text" placeholder="Search places" />
            <div id="map"></div>
        </div>

        <!-- <div id="divSearch" class="position-absolute bottom-0 end-0 popup-form" style="display: none; margin-bottom: 23px; margin-right: 52px;">
            <div class="text-end">
                <button class="btn btn-sm btn-close-popup" data-popup-target="divSearch" type="button"><i class="fas fa-times"></i></button>
            </div>
            <div class="p-1">
                <form id="formSearch" class="p-2">
                    <p>ค้นหาจากประเภทหัวชาร์จ</p>
                    <div>
                        <label>AC</label>
                        <div class="form-check form-switch ms-4">
                            <input class="form-check-input" type="checkbox" id="chk_4" name="connectorType" value="4" checked>
                            <label class="form-check-label" for="chk_4"><img src="https://geonine.io/evpublic/connector/4.png" style="width: 30px;" /> Type 2</label>
                        </div>
                        <div class="form-check form-switch ms-4">
                            <input class="form-check-input" type="checkbox" id="chk_6" name="connectorType" value="6" checked>
                            <label class="form-check-label" for="chk_6"><img src="https://geonine.io/evpublic/connector/6.png" style="width: 30px;" /> GB/T</label>
                        </div>
                        <hr />
                        <label>DC</label>
                        <div class="form-check form-switch ms-4">
                            <input class="form-check-input" type="checkbox" id="chk_2" name="connectorType" value="2" checked>
                            <label class="form-check-label" for="chk_2"><img src="https://geonine.io/evpublic/connector/2.png" style="width: 30px;" /> CHAdeMO</label>
                        </div>
                        <div class="form-check form-switch ms-4">
                            <input class="form-check-input" type="checkbox" id="chk_5" name="connectorType" value="5" checked>
                            <label class="form-check-label" for="chk_5"><img src="https://geonine.io/evpublic/connector/5.png" style="width: 30px;" /> CCS Type2</label>
                        </div>
                        <div class="form-check form-switch ms-4">
                            <input class="form-check-input" type="checkbox" id="chk_7" name="connectorType" value="7" checked>
                            <label class="form-check-label" for="chk_7"><img src="https://geonine.io/evpublic/connector/7.png" style="width: 30px;" /> GB/T</label>
                        </div>
                    </div>
                    <hr />
                    <div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="chk_avaiableonly" name="online">
                            <label class="form-check-label" for="chk_avaiableonly">หัวชาร์จที่พร้อมใช้งาน</label>
                        </div>
                    </div>
                    <div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="chk_publicStation" name="isPublicStation" value="true">
                            <label class="form-check-label" for="chk_publicStation">สถานีที่ให้บริการสาธารณะ</label>
                        </div>
                    </div>

                </form>
            </div>
        </div>
        <div id="divResultTable" class="position-absolute bottom-0 end-0 popup-form p-1 pt-2 pb-0" style="display: none; margin-bottom: 122px; margin-right: 52px; max-width: 300px;">
            <div class="text-end">
                <button class="btn btn-sm btn-close-popup" data-popup-target="divResultTable" type="button"><i class="fas fa-times"></i></button>
            </div>
            <div class="table-responsive">
                <table class="table table-striped dataTables-result">
                    <thead>
                        <tr>
                            <th>สถานี</th>
                            <th>จำนวนหัวชาร์จ</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>

        </div>
        <div id="divLegend" class="position-absolute bottom-0 end-0 popup-form p-1 pt-2 pb-0" style="display: none; margin-bottom: 72px; margin-right: 52px; min-width: 100px; max-width: 200px;">
            <div class="text-end">
                <button class="btn btn-sm btn-close-popup" data-popup-target="divLegend" type="button"><i class="fas fa-times"></i></button>
            </div>
            <div id="divMini" class="row div-icons ms-1 mt-0 mb-2">
                <div class="col-12 pb-1 status-container-owner-marker mini" data-status="">
                    <img src="https://geonine.io/evpublic/map_marker/map-marker_gvn.svg" class="me-2 img-map-icon-mini">
                    Galvanic
                </div>
                <div class="col-12 pb-1 status-container-owner-marker mini" data-status="">
                    <img src="https://geonine.io/evpublic/map_marker/map-marker_active_bftz.svg" class="me-2 img-map-icon-mini">
                    Bangkok Free Trade Zone
                </div>
                <div class="col-12 pb-1 status-container-owner-marker mini" data-status="">
                    <img src="https://geonine.io/evpublic/map_marker/map-marker_active_ctms.svg" class="me-2 img-map-icon-mini">
                    Chargemotion by CTMS
                </div>
                <div class="col-12 pb-1 status-container-owner-marker mini" data-status="">
                    <img src="https://geonine.io/evpublic/map_marker/map-marker_bcharge.svg" class="me-2 img-map-icon-mini">
                    EV Station
                </div>
                <div class="col-12 pb-1 status-container-owner-marker mini" data-status="">
                    <img src="https://geonine.io/evpublic/map_marker/map-marker_plug_pay_gvn1.svg" class="me-2 img-map-icon-mini">
                    EV Station
                </div>
                <div class="col-12 pb-1 status-container mini" data-status="2">อยู่ระหว่างติดตั้ง</div>
                <div class="col-12 pb-1 status-container mini" data-status="3">อยู่ระหว่างบำรุงรักษา</div>
                <div class="col-12 pb-1 status-container mini" data-status="4">ปิด</div>
            </div>

        </div> -->

    </div>
</div>