<!DOCTYPE html>
<html lang="en">
<!--begin::Head-->
<head><base href="../../"/>
    <!--begin::Vendor Stylesheets(used for this page only)-->
    <link href="/assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
    <link href="/assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <link href="/assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
    <script src="/assets/lang/Malay.json"></script>
    <!-- Include jQuery from CDN -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Include Select2 CSS from CDN -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- Include Select2 JS from CDN -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</head>
<!--end::Head-->
<!--begin::Body-->
<body id="kt_body" class="app-blank bgi-size-cover bgi-position-center bgi-no-repeat">
<!--begin::Root-->
<div class="d-flex flex-column flex-root" id="kt_app_root">
    <!--begin::Page bg image-->
    <style>body { background-image: url('assets/media/auth/bg9.jpg'); } [data-bs-theme="dark"] body { background-image: url('assets/media/auth/bg9-dark.jpg'); }</style>
    <!--end::Page bg image-->
    <!--begin::Authentication - Signup Welcome Message -->
    <div class="d-flex flex-column flex-center flex-column-fluid">
        <!--begin::Content-->
        <div class="d-flex flex-column flex-center text-center p-10">
            <!--begin::Wrapper-->
            <div class="card card-flush w-lg-650px py-5">
                <div class="card-body py-15 py-lg-20">
                    <!--begin::Logo-->
                    <div class="mb-13">
                        <img alt="Logo" src="logo/aadk.png" class="h-125px" />
                    </div>
                    <!--end::Logo-->
                    <!--begin::Title-->
                    <h1 class="fw-bolder text-gray-900 mb-7">Pendaftaran Kehadiran</h1>
                    <!--end::Title-->
                    <!--begin::Counter-->
                    <!--(uncomment to display coming soon counter)
<div class="d-flex flex-center pb-10 pt-lg-5 pb-lg-12">
<div class="w-65px rounded-3 bg-body shadow-sm py-4 px-5 mx-3">
    <div class="fs-2 fw-bold text-gray-800" id="kt_coming_soon_counter_days"></div>
    <div class="fs-7 fw-semibold text-muted">days</div>
</div>

<div class="w-65px rounded-3 bg-body shadow-sm py-4 px-5 mx-3">
    <div class="fs-2 fw-bold text-gray-800" id="kt_coming_soon_counter_hours"></div>
    <div class="fs-7 text-muted">hrs</div>
</div>

<div class="w-65px rounded-3 bg-body shadow-sm py-4 px-5 mx-3">
    <div class="fs-2 fw-bold text-gray-800" id="kt_coming_soon_counter_minutes"></div>
    <div class="fs-7 text-muted">min</div>
</div>

<div class="w-65px rounded-3 bg-body shadow-sm py-4 px-5 mx-3">
    <div class="fs-2 fw-bold text-gray-800" id="kt_coming_soon_counter_seconds"></div>
    <div class="fs-7 text-muted">sec</div>
</div>
</div>
-->
                    <!--end::Counter-->
                    <!--begin::Text-->
                    <div class="w-md-350px mb-2 mx-auto fw-semibold fs-6 mb-7 ">
                        Nama Program: Program Pemulihan Bersepadu <br>
                        Tarikh/Masa: 17/06/2024, 9AM <br>
                        Tempat: Dewan Perdana <br>
                        Penganjur: En. Syafiq Rahman <br>
                        Pegawai AADK: En. Kairul Azizi <br>
                        Sila Dihubungi: 013-5728935 <br>
                        <br>
                        <div class="fw-semibold fs-6 text-gray-500 mb-7">
                            Sila masukkan No. Kad Pengenalan anda.<br>
                        </div>
                    </div>
                    <!--end::Text-->
                    <!--begin::Form-->
                    <form class="w-md-350px mb-2 mx-auto" action="#" id="kt_coming_soon_form">
                        <div class="fv-row text-start">
                            <div class="d-flex flex-column flex-md-row justify-content-center gap-3">
                                <!--end::Input=-->
                                <input type="text" placeholder="No. Kad Pengenalan" name="no_kp" autocomplete="off" class="form-control" />
                                <!--end::Input=-->
                                <!--begin::Submit-->
                                <button class="btn btn-primary text-nowrap" id="kt_coming_soon_submit">
                                    <!--begin::Indicator label-->
                                    <span class="indicator-label">Hantar</span>
                                    <!--end::Indicator label-->
                                    <!--begin::Indicator progress-->
                                    <span class="indicator-progress">Please wait...
											<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                    <!--end::Indicator progress-->
                                </button>
                                <!--end::Submit-->
                            </div>
                        </div>
                    </form>
                    <!--end::Form-->
                </div>
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::Authentication - Signup Welcome Message-->
</div>
<!--end::Root-->
<!--begin::Javascript-->
<script>var hostUrl = "assets/";</script>
<!--begin::Global Javascript Bundle(mandatory for all pages)-->
<script src="assets/plugins/global/plugins.bundle.js"></script>
<script src="assets/js/scripts.bundle.js"></script>
<!--end::Global Javascript Bundle-->
<!--begin::Custom Javascript(used for this page only)-->
<script src="assets/js/custom/authentication/sign-up/coming-soon.js"></script>
<!--end::Custom Javascript-->
<!--end::Javascript-->
</body>
<!--end::Body-->
</html>
