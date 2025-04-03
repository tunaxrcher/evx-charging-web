<div class="body-wrapper">
    <div class="container-fluid">
        <div class="card" id="scan_station">
            <div class="card-body">
                <div class="justify-content-between align-items-center gap-6 mb-9">
                    <div class="position-relative">
                        <input type="text" class="form-control search-chat py-2 ps-5" id="text-srh-charger-station" placeholder="Enter charge point no." onkeydown="searchStation(this)">
                        <i class="ti ti-search position-absolute top-50 start-0 translate-middle-y fs-6 text-dark ms-3"></i>
                    </div>
                </div>
                <div class="text-center">
                    <p class="text-center badge fw-medium fs-2 bg-primary-subtle text-primary">Or</p>
                </div>
                <div class="col-12">
                    <div class="card w-100 border position-relative overflow-hidden mb-0 text-center">
                        <div class="card-body p-4">
                            <!-- <form> -->
                            <div class="text-center">
                                <a href="#" onclick="showVideo(); return false;">
                                    <img src="<?php echo base_url('assets/images/backgrounds/BG.jpg'); ?>" style="border-radius: 25px;" class="img-fluid mb-3">
                                </a>
                                <div class="col-12 text-center">
                                    <div class="align-items-center justify-content-end mt-4 gap-6">
                                        <button class="btn btn-primary" id="click-scan">Click here to scan QR Code</button>
                                    </div>
                                </div>
                            </div>
                            <!-- </form> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="checkout" id="step_station" style="display:none">
            <div class="card">
                <div class="card-body p-4">
                    <div class="wizard-content">
                        <form action="#" class="tab-charger wizard wizard-circle">
                            <!-- Step 1 -->
                            <h6>1. SELECT CONNECTOR</h6>
                            <section>

                                <div class="col-md-8 col-lg-4 offset-md-2 offset-lg-4  ">
                                    <div class="card mb-3">
                                        <div class="card-body border">
                                            <p class="text-center mb-1 mb-md-3  bi-medium ">Station information</p>
                                            <p class="m-0 bi-medium">Charge point : <span class="float-end fw-bold text-primary" id='cp'> EVX#XX</span></p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 text-center blinkConnect">
                                            <h3 class="text-secondary">Please select connector</h3>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="connectors_by_cp"></div>
                                        <!-- <div class="col-sm-12 text-center mb-2 border ">
                                            <a href="/galvanic/Main/ConnectorStatus/THCTMEX000051?connectorId=1" class="connectorItem" data-charge-point-id="THCTMEX000051" data-connector-id="1">
                                                <div class="card">
                                                    <div class="card-body py-2 small" style="padding-left: 5px;padding-right: 5px;">
                                                        <p class="mb-1">XXXX #X</p>
                                                        <p class="mb-1">AC Type 2 (30.0 kW)</p>
                                                        <img src="https://geonine.io/evpublic/connector/4.png" style="width: 100%; max-width: 80px;">
                                                        <p class="m-0 mt-1 mb-2">
                                                            Service Charge: XX THB/kWh
                                                        </p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div> -->
                                        <!-- <div class="col-sm-12 text-center mb-2 border ">
                                            <a href="/galvanic/Main/ConnectorStatus/THCTMEX000051?connectorId=1" class="connectorItem" data-charge-point-id="THCTMEX000051" data-connector-id="1">
                                                <div class="card">
                                                    <div class="card-body py-2 small" style="padding-left: 5px;padding-right: 5px;">
                                                        <p class="mb-1">XXXX #X</p>
                                                        <p class="mb-1">AC Type 2 (30.0 kW)</p>
                                                        <img src="https://geonine.io/evpublic/connector/4.png" style="width: 100%; max-width: 80px;">
                                                        <p class="m-0 mt-1 mb-2">
                                                            Service Charge: XX THB/kWh
                                                        </p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div> -->
                                    </div>
                                </div>


                            </section>
                            <!-- Step 2 -->
                            <h6>2. PLUG IN CONNECTOR</h6>
                            <section>
                                <div class="col-md-12 col-lg-8 offset-md-2 offset-lg-2">
                                    <div class="card mb-2" id="information_station">
                                        <div class="card-body border">
                                            <p class="text-center mb-1 mb-md-3 small ">Station information</p>
                                            <div id="infoDiv">
                                                <p class="m-0 small">Station : <span class="float-end text-primary fw-bold" id="ev_description"> XXXX</span></p>
                                                <p class="m-0 small">Charge point : <span class="float-end text-primary fw-bold" id="ev_cp"> XXXXX #XX</span></p>
                                                <p class="m-0 small mt-1 mb-1">Connector : <span class="float-end text-primary fw-bold"><img src="https://geonine.io/evpublic/connector/4.png" style="width: 1.5rem; padding: 0px; margin-top: -0.2rem;"> AC Type 2 (11.0 kW)</span></p>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="card mb-2">
                                        <div class="card-body border">
                                            <div class="row">
                                                <div class="col-3 text-end">
                                                    <span class="icon-item-icon"><svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="currentColor" class="icon icon-tabler icons-tabler-filled icon-tabler-charging-pile">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                            <path d="M12 3a3 3 0 0 1 3 3v4a3 3 0 0 1 3 3v3a.5 .5 0 1 0 1 0v-6.585l-1 -1l-.293 .292a1 1 0 0 1 -1.414 -1.414l.292 -.293l-.292 -.293a1 1 0 0 1 -.083 -1.32l.083 -.094a1 1 0 0 1 1.414 0l3 3a1 1 0 0 1 .293 .707v7a2.5 2.5 0 1 1 -5 0v-3a1 1 0 0 0 -1 -1v7a1 1 0 0 1 0 2h-12a1 1 0 0 1 0 -2v-13a3 3 0 0 1 3 -3zm-2.486 7.643a1 1 0 0 0 -1.371 .343l-1.5 2.5l-.054 .1a1 1 0 0 0 .911 1.414h1.233l-.59 .986a1 1 0 0 0 1.714 1.028l1.5 -2.5l.054 -.1a1 1 0 0 0 -.911 -1.414h-1.235l.592 -.986a1 1 0 0 0 -.343 -1.371m2.486 -5.643h-6a1 1 0 0 0 -1 1v1h8v-1a1 1 0 0 0 -1 -1"></path>
                                                        </svg></span>
                                                </div>
                                                <div class="col-6" style="margin: auto;">
                                                    <div id="myProgress">
                                                        <div id="myBar"></div>
                                                    </div>
                                                </div>
                                                <div class="col-3" style="align-items: start;">
                                                    <span class="icon-item-icon"><svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="currentColor" class="icon icon-tabler icons-tabler-filled icon-tabler-car">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                            <path d="M17 14a3 3 0 0 1 2.685 4.34l-.067 .126l-.1 .165l-.141 .2l-.116 .141l-.116 .126a3 3 0 0 1 -.388 .334l-.149 .1l-.089 .055q -.052 .032 -.107 .06l-.17 .085l-.175 .073l-.104 .037l-.17 .052l-.172 .042l-.183 .032l-.075 .01q -.09 .011 -.18 .016l-.183 .006l-.183 -.006l-.18 -.016l-.192 -.03l-.17 -.036l-.18 -.051l-.058 -.019a3 3 0 0 1 -.174 -.065l-.161 -.072l-.168 -.087l-.053 -.03q -.122 -.072 -.237 -.156l-.16 -.124l-.15 -.134l-.129 -.129l-.066 -.073l-.1 -.12l-.12 -.165l-.074 -.113l-.063 -.108l-.067 -.126a3 3 0 0 1 -.315 -1.34a3 3 0 0 1 3 -3m-10 0a3 3 0 0 1 2.685 4.34l-.067 .126l-.1 .165l-.141 .2l-.116 .141l-.116 .126a3 3 0 0 1 -.388 .334l-.149 .1l-.089 .055q -.052 .032 -.107 .06l-.17 .085l-.175 .073l-.104 .037l-.17 .052l-.172 .042l-.183 .032l-.075 .01q -.09 .011 -.18 .016l-.183 .006l-.183 -.006l-.18 -.016l-.192 -.03l-.17 -.036l-.18 -.051l-.058 -.019a3 3 0 0 1 -.174 -.065l-.161 -.072l-.168 -.087l-.053 -.03q -.122 -.072 -.237 -.156l-.16 -.124l-.15 -.134l-.129 -.129l-.066 -.073l-.1 -.12l-.12 -.165l-.074 -.113l-.063 -.108l-.067 -.126a3 3 0 0 1 -.315 -1.34a3 3 0 0 1 3 -3m7 -9a1 1 0 0 1 .694 .28l.087 .095l3.699 4.625h.52a3 3 0 0 1 2.995 2.824l.005 .176v4a1 1 0 0 1 -1 1h-.126q .125 -.48 .126 -1a4 4 0 1 0 -7.874 1h-2.252q .124 -.48 .126 -1a4 4 0 1 0 -7.874 1h-.126a1 1 0 0 1 -1 -1v-6l.007 -.117l.008 -.056l.017 -.078l.012 -.036l.014 -.05l2.014 -5.034a1 1 0 0 1 .928 -.629zm-7 11a1 1 0 1 0 0 2a1 1 0 0 0 0 -2m10 0a1 1 0 1 0 0 2a1 1 0 0 0 0 -2m-3.48 -9h-.52v3h2.92z"></path>
                                                        </svg></span>
                                                </div>

                                            </div>
                                            <h3 class="text-center mt-3 text-warning blink" id="showConnectorPlugText">Please plug the connector into your car !!</h3>
                                            <h3 class="text-center mt-3  text-success blinkStart" id="showConnectorPlugTextStart" style="display: none;">Your car is charge !!</h3>
                                        </div>
                                        <div class="card-footer text-center">
                                            <button type="button" class="btn btn-secondary btn-lg" id="startChargeBtn" style="" disabled="">Start charging</button>
                                            <button type="button" class="btn btn-warning btn-lg" id="stopChargeBtn" style="display:none">Stop charging</button>
                                        </div>
                                    </div>
                                </div>

                            </section>
                            <!-- Step 3 -->
                            <h6>3. CHARGING</h6>
                            <section>
                                <div class="col-md-12 col-lg-8 offset-md-2 offset-lg-2">
                                    <div class="card-body border mb-2">
                                        <p class="text-center mb-1 mb-md-3 small ">Station information</p>
                                        <div id="infoDiv">
                                            <p class="m-0 small">Station : <span class="float-end text-primary fw-bold" id="ev_description_charge"> XXXX</span></p>
                                            <p class="m-0 small">Charge point : <span class="float-end text-primary fw-bold" id="ev_cp_charge"> XXXXX #XX</span></p>
                                            <p class="m-0 small mt-1 mb-1">Connector : <span class="float-end text-primary fw-bold"><img src="https://geonine.io/evpublic/connector/4.png" style="width: 1.5rem; padding: 0px; margin-top: -0.2rem;"> AC Type 2 (11.0 kW)</span></p>
                                            <p class="m-0 small mt-1 mb-1">Service Charge : <span class="float-end text-primary fw-bold" id='ev_service_price_chaging'>XX THB/h</span></p>
                                        </div>
                                    </div>
                                    <div class="card-body border mb-2">
                                        <div class="row col-lg-12 col-md-12 text-center">
                                            <div class="card-body text-center px-9 pb-4">
                                                <div class="d-flex align-items-center justify-content-center round-48 rounded text-bg-primary flex-shrink-0 mb-3 mx-auto">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-battery-vertical-3">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                        <path d="M7 18v-11a2 2 0 0 1 2 -2h.5a.5 .5 0 0 0 .5 -.5a.5 .5 0 0 1 .5 -.5h3a.5 .5 0 0 1 .5 .5a.5 .5 0 0 0 .5 .5h.5a2 2 0 0 1 2 2v11a2 2 0 0 1 -2 2h-6a2 2 0 0 1 -2 -2"></path>
                                                        <path d="M10 17h4"></path>
                                                        <path d="M10 14h4"></path>
                                                        <path d="M10 11h4"></path>
                                                    </svg>
                                                </div>
                                                <h6 class="fw-normal fs-3 mb-1">CHARGING</h6>                                 
                                                </h4>
                                            </div>
                                            <div class="col-lg-4 col-md-12 mb-1 text-lg-end">
                                                <span class="icon-item-icon"><svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="currentColor" class="icon icon-tabler icons-tabler-filled icon-tabler-charging-pile">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                        <path d="M12 3a3 3 0 0 1 3 3v4a3 3 0 0 1 3 3v3a.5 .5 0 1 0 1 0v-6.585l-1 -1l-.293 .292a1 1 0 0 1 -1.414 -1.414l.292 -.293l-.292 -.293a1 1 0 0 1 -.083 -1.32l.083 -.094a1 1 0 0 1 1.414 0l3 3a1 1 0 0 1 .293 .707v7a2.5 2.5 0 1 1 -5 0v-3a1 1 0 0 0 -1 -1v7a1 1 0 0 1 0 2h-12a1 1 0 0 1 0 -2v-13a3 3 0 0 1 3 -3zm-2.486 7.643a1 1 0 0 0 -1.371 .343l-1.5 2.5l-.054 .1a1 1 0 0 0 .911 1.414h1.233l-.59 .986a1 1 0 0 0 1.714 1.028l1.5 -2.5l.054 -.1a1 1 0 0 0 -.911 -1.414h-1.235l.592 -.986a1 1 0 0 0 -.343 -1.371m2.486 -5.643h-6a1 1 0 0 0 -1 1v1h8v-1a1 1 0 0 0 -1 -1"></path>
                                                    </svg></span>
                                            </div>
                                            <div class="col-lg-4 mb-1 col-md-12" style="display: flex; justify-content: center;">
                                                <div class="battery">
                                                    <span class="bar"></span>
                                                    <span class="bar"></span>
                                                    <span class="bar"></span>
                                                    <span class="bar"></span>
                                                    <span class="bar"></span>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-12 text-center text-lg-start">
                                                <span class="icon-item-icon"><svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="currentColor" class="icon icon-tabler icons-tabler-filled icon-tabler-car">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                        <path d="M17 14a3 3 0 0 1 2.685 4.34l-.067 .126l-.1 .165l-.141 .2l-.116 .141l-.116 .126a3 3 0 0 1 -.388 .334l-.149 .1l-.089 .055q -.052 .032 -.107 .06l-.17 .085l-.175 .073l-.104 .037l-.17 .052l-.172 .042l-.183 .032l-.075 .01q -.09 .011 -.18 .016l-.183 .006l-.183 -.006l-.18 -.016l-.192 -.03l-.17 -.036l-.18 -.051l-.058 -.019a3 3 0 0 1 -.174 -.065l-.161 -.072l-.168 -.087l-.053 -.03q -.122 -.072 -.237 -.156l-.16 -.124l-.15 -.134l-.129 -.129l-.066 -.073l-.1 -.12l-.12 -.165l-.074 -.113l-.063 -.108l-.067 -.126a3 3 0 0 1 -.315 -1.34a3 3 0 0 1 3 -3m-10 0a3 3 0 0 1 2.685 4.34l-.067 .126l-.1 .165l-.141 .2l-.116 .141l-.116 .126a3 3 0 0 1 -.388 .334l-.149 .1l-.089 .055q -.052 .032 -.107 .06l-.17 .085l-.175 .073l-.104 .037l-.17 .052l-.172 .042l-.183 .032l-.075 .01q -.09 .011 -.18 .016l-.183 .006l-.183 -.006l-.18 -.016l-.192 -.03l-.17 -.036l-.18 -.051l-.058 -.019a3 3 0 0 1 -.174 -.065l-.161 -.072l-.168 -.087l-.053 -.03q -.122 -.072 -.237 -.156l-.16 -.124l-.15 -.134l-.129 -.129l-.066 -.073l-.1 -.12l-.12 -.165l-.074 -.113l-.063 -.108l-.067 -.126a3 3 0 0 1 -.315 -1.34a3 3 0 0 1 3 -3m7 -9a1 1 0 0 1 .694 .28l.087 .095l3.699 4.625h.52a3 3 0 0 1 2.995 2.824l.005 .176v4a1 1 0 0 1 -1 1h-.126q .125 -.48 .126 -1a4 4 0 1 0 -7.874 1h-2.252q .124 -.48 .126 -1a4 4 0 1 0 -7.874 1h-.126a1 1 0 0 1 -1 -1v-6l.007 -.117l.008 -.056l.017 -.078l.012 -.036l.014 -.05l2.014 -5.034a1 1 0 0 1 .928 -.629zm-7 11a1 1 0 1 0 0 2a1 1 0 0 0 0 -2m10 0a1 1 0 1 0 0 2a1 1 0 0 0 0 -2m-3.48 -9h-.52v3h2.92z"></path>
                                                    </svg></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-6">
                                            <div class="card border-bottom border-info">
                                                <div class="card-body">
                                                    <div class="d-flex align-items-center justify-content-between">
                                                        <div>
                                                            <h4 class="fs-7"><span id="hours">00</span>:<span id="minutes">00</span></h4>
                                                            <h6 class="fw-medium text-info mb-0">Time (hh:mm)</h6>
                                                        </div>
                                                        <span class="text-info display-6">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-clock-hour-2">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                                <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"></path>
                                                                <path d="M12 12l3 -2"></path>
                                                                <path d="M12 7v5"></path>
                                                            </svg>

                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-6">
                                            <div class="card border-bottom border-info">
                                                <div class="card-body">
                                                    <div class="d-flex align-items-center justify-content-between">
                                                        <div>
                                                            <h4 class="fs-7" id="powerActive_id">0.0</h4>
                                                            <h6 class="fw-medium text-info mb-0">Power (kW)</h6>
                                                        </div>
                                                        <span class="text-info display-6">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-bolt">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                                <path d="M13 3l0 7l6 0l-8 11l0 -7l-6 0l8 -11"></path>
                                                            </svg>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-6">
                                            <div class="card border-bottom border-info">
                                                <div class="card-body">
                                                    <div class="d-flex align-items-center justify-content-between">
                                                        <div>
                                                            <h4 class="fs-7" id="energyActive_id">0.0</h4>
                                                            <h6 class="fw-medium text-info mb-0">Energy (kWh)</h6>
                                                        </div>
                                                        <span class="text-info display-6">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-battery-3">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                                <path d="M6 7h11a2 2 0 0 1 2 2v.5a.5 .5 0 0 0 .5 .5a.5 .5 0 0 1 .5 .5v3a.5 .5 0 0 1 -.5 .5a.5 .5 0 0 0 -.5 .5v.5a2 2 0 0 1 -2 2h-11a2 2 0 0 1 -2 -2v-6a2 2 0 0 1 2 -2"></path>
                                                                <path d="M7 10l0 4"></path>
                                                                <path d="M10 10l0 4"></path>
                                                                <path d="M13 10l0 4"></path>
                                                            </svg>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-6">
                                            <div class="card border-bottom border-info">
                                                <div class="card-body">
                                                    <div class="d-flex align-items-center justify-content-between">
                                                        <div>
                                                            <h4 class="fs-7" id="serviceActive_id">0.0</h4>
                                                            <h6 class="fw-medium text-info mb-0" id="serviceActive_monetary_unit_id">Service xx/kWh</h6>
                                                        </div>
                                                        <span class="text-info display-6">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-coins">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                                <path d="M9 14c0 1.657 2.686 3 6 3s6 -1.343 6 -3s-2.686 -3 -6 -3s-6 1.343 -6 3z"></path>
                                                                <path d="M9 14v4c0 1.656 2.686 3 6 3s6 -1.344 6 -3v-4"></path>
                                                                <path d="M3 6c0 1.072 1.144 2.062 3 2.598s4.144 .536 6 0c1.856 -.536 3 -1.526 3 -2.598c0 -1.072 -1.144 -2.062 -3 -2.598s-4.144 -.536 -6 0c-1.856 .536 -3 1.526 -3 2.598z"></path>
                                                                <path d="M3 6v10c0 .888 .772 1.45 2 2"></path>
                                                                <path d="M3 11c0 .888 .772 1.45 2 2"></path>
                                                            </svg>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </section>
                            <!-- Step 4 -->
                            <h6>4. SUMMARY</h6>
                            <section>
                                <div class="col-md-12 col-lg-8 offset-md-2 offset-lg-2">
                                    <div class="card-body border mb-2">
                                        <p class="text-center mb-1 mb-md-3 small ">Station information</p>
                                        <div id="infoDiv">
                                            <p class="m-0 small">Station : <span class="float-end text-primary fw-bold" id="ev_description_sum"> XXXX</span></p>
                                            <p class="m-0 small">Charge point : <span class="float-end text-primary fw-bold" id="ev_cp_sum"> XXXXX #XX</span></p>
                                            <p class="m-0 small mt-1 mb-1">Connector : <span class="float-end text-primary fw-bold"><img src="https://geonine.io/evpublic/connector/4.png" style="width: 1.5rem; padding: 0px; margin-top: -0.2rem;"> AC Type 2 (11.0 kW)</span></p>
                                            <p class="m-0 small mt-1 mb-1">Service Charge : <span class="float-end text-primary fw-bold" id="ev_service_price_sum">XX THB/h</span></p>
                                        </div>
                                    </div>
                                    <div class="card-body mb-2">
                                        <p class="text-center mb-1 mb-md-3 small ">Charging information</p>
                                        <div id="infoDiv">
                                            <p class="m-0 small">Date : <span class="float-end text-primary fw-bold" id="ev_date_start"> date time</span></p>
                                            <p class="m-0 small">Period : <span class="float-end text-primary fw-bold" id="ev_sumtime"> XXX Minute</span></p>
                                            <p class="m-0 small mt-1 mb-1">Unit : <span class="float-end text-primary fw-bold" id="ev_sumUnit"> XXX kWh</span></p>
                                        </div>
                                    </div>
                                    <div class="card-footer mb-2">
                                        <div id="infoDiv">
                                            <p class="m-0 small mt-1 mb-1">Total Price : <span class="float-end text-primary fw-bold" id="ev_sumPrice"> XXX THB</span></p>
                                        </div>
                                    </div>
                                    <div class="card mb-2">
                                        <div class="card-body border">
                                            <div class="row">
                                                <div class="col-3 text-end">
                                                    <span class="icon-item-icon"><svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="currentColor" class="icon icon-tabler icons-tabler-filled icon-tabler-charging-pile">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                            <path d="M12 3a3 3 0 0 1 3 3v4a3 3 0 0 1 3 3v3a.5 .5 0 1 0 1 0v-6.585l-1 -1l-.293 .292a1 1 0 0 1 -1.414 -1.414l.292 -.293l-.292 -.293a1 1 0 0 1 -.083 -1.32l.083 -.094a1 1 0 0 1 1.414 0l3 3a1 1 0 0 1 .293 .707v7a2.5 2.5 0 1 1 -5 0v-3a1 1 0 0 0 -1 -1v7a1 1 0 0 1 0 2h-12a1 1 0 0 1 0 -2v-13a3 3 0 0 1 3 -3zm-2.486 7.643a1 1 0 0 0 -1.371 .343l-1.5 2.5l-.054 .1a1 1 0 0 0 .911 1.414h1.233l-.59 .986a1 1 0 0 0 1.714 1.028l1.5 -2.5l.054 -.1a1 1 0 0 0 -.911 -1.414h-1.235l.592 -.986a1 1 0 0 0 -.343 -1.371m2.486 -5.643h-6a1 1 0 0 0 -1 1v1h8v-1a1 1 0 0 0 -1 -1"></path>
                                                        </svg></span>
                                                </div>
                                                <div class="col-6" style="margin: auto;">
                                                    <div id="myProgress">
                                                        <div id="myBarMax"></div>
                                                    </div>
                                                </div>
                                                <div class="col-3" style="align-items: start;">
                                                    <span class="icon-item-icon"><svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="currentColor" class="icon icon-tabler icons-tabler-filled icon-tabler-car">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                            <path d="M17 14a3 3 0 0 1 2.685 4.34l-.067 .126l-.1 .165l-.141 .2l-.116 .141l-.116 .126a3 3 0 0 1 -.388 .334l-.149 .1l-.089 .055q -.052 .032 -.107 .06l-.17 .085l-.175 .073l-.104 .037l-.17 .052l-.172 .042l-.183 .032l-.075 .01q -.09 .011 -.18 .016l-.183 .006l-.183 -.006l-.18 -.016l-.192 -.03l-.17 -.036l-.18 -.051l-.058 -.019a3 3 0 0 1 -.174 -.065l-.161 -.072l-.168 -.087l-.053 -.03q -.122 -.072 -.237 -.156l-.16 -.124l-.15 -.134l-.129 -.129l-.066 -.073l-.1 -.12l-.12 -.165l-.074 -.113l-.063 -.108l-.067 -.126a3 3 0 0 1 -.315 -1.34a3 3 0 0 1 3 -3m-10 0a3 3 0 0 1 2.685 4.34l-.067 .126l-.1 .165l-.141 .2l-.116 .141l-.116 .126a3 3 0 0 1 -.388 .334l-.149 .1l-.089 .055q -.052 .032 -.107 .06l-.17 .085l-.175 .073l-.104 .037l-.17 .052l-.172 .042l-.183 .032l-.075 .01q -.09 .011 -.18 .016l-.183 .006l-.183 -.006l-.18 -.016l-.192 -.03l-.17 -.036l-.18 -.051l-.058 -.019a3 3 0 0 1 -.174 -.065l-.161 -.072l-.168 -.087l-.053 -.03q -.122 -.072 -.237 -.156l-.16 -.124l-.15 -.134l-.129 -.129l-.066 -.073l-.1 -.12l-.12 -.165l-.074 -.113l-.063 -.108l-.067 -.126a3 3 0 0 1 -.315 -1.34a3 3 0 0 1 3 -3m7 -9a1 1 0 0 1 .694 .28l.087 .095l3.699 4.625h.52a3 3 0 0 1 2.995 2.824l.005 .176v4a1 1 0 0 1 -1 1h-.126q .125 -.48 .126 -1a4 4 0 1 0 -7.874 1h-2.252q .124 -.48 .126 -1a4 4 0 1 0 -7.874 1h-.126a1 1 0 0 1 -1 -1v-6l.007 -.117l.008 -.056l.017 -.078l.012 -.036l.014 -.05l2.014 -5.034a1 1 0 0 1 .928 -.629zm-7 11a1 1 0 1 0 0 2a1 1 0 0 0 0 -2m10 0a1 1 0 1 0 0 2a1 1 0 0 0 0 -2m-3.48 -9h-.52v3h2.92z"></path>
                                                        </svg></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="card" id="scan_page" style="display:none">
            <div class="card-body">
                <div class="col-12">
                    <div class="col-md-12">
                        <div id="reader"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>