@php
    use Carbon\Carbon;
@endphp

<head>
    <style>
        a.logo-container {
            display: flex;
            align-items: center;  /* Vertically centers the items */
            justify-content: center;  /* Horizontally centers the items */
        }

        a .myaadk-text {
            font-size: 28px;
            color: lightgray;
            font-weight: bold;
        }

        a.logo-container img {
            height: 50px;  /* Ensure the image height is consistent */
            margin-left: 10px !important;  /* Remove any default margins */
            vertical-align: middle;  /* Align the image middle */
        }

        .menu-item .menu-link {
            display: flex;
            align-items: center;
            padding: 10px;
            color: white;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .menu-item .menu-link:hover {
            background-color: darkgrey;
        }

        .menu-item.active .menu-link {
            background-color: darkgrey;
        }

        .menu-link.active {
            background-color: darkgrey !important;
        }

        .menu-sub .menu-link.submenu-active {
            background-color: darkgrey !important;
        }

        .menu-icon {
            margin-right: 10px;
        }

        .menu-content {
            padding: 10px;
        }
    </style>
</head>

<div id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true" data-kt-drawer-name="app-sidebar" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="225px" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">

    @if(Auth::user()->tahap_pengguna == 1)
    <!--begin::Logo-->
    <div class="app-sidebar-logo px-6" id="kt_app_sidebar_logo" class="logo-container">
        <!--begin::Logo image-->
        <a href="/" class="logo-container">
            <img alt="Logo" src="{{ asset('logo/mySupport-bg.png') }}" class="h-50px app-sidebar-logo-default" />
            <img alt="Logo" src="{{ asset('logo/mySupport-bg.png') }}" class="logo-position h-35px app-sidebar-logo-minimize" />
            <span class="app-sidebar-logo-default"><img alt="Logo" src="/logo/mySupport-huruf.png" class="logo-default h-40px mx-auto"/></span>
        </a>

        <div id="kt_app_sidebar_toggle" class="app-sidebar-toggle btn btn-icon btn-shadow btn-sm btn-color-muted btn-active-color-primary h-30px w-30px position-absolute top-50 start-100 translate-middle rotate" data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body" data-kt-toggle-name="app-sidebar-minimize">
            <i class="ki-duotone ki-black-left-line fs-3 rotate-180">
                <span class="path1"></span>
                <span class="path2"></span>
            </i>
        </div>
        <!--end::Sidebar toggle-->
    </div>
    <!--end::Logo-->

    <!--begin::sidebar menu PENTADBIR-->
    <div class="app-sidebar-menu overflow-hidden flex-column-fluid">
        <!--begin::Menu wrapper-->
        <div id="kt_app_sidebar_menu_wrapper" class="app-sidebar-wrapper">
            <!--begin::Scroll wrapper-->
            <div id="kt_app_sidebar_menu_scroll" class="scroll-y my-5 mx-3" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer" data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px" data-kt-scroll-save-state="true">
                <!--begin::Menu-->
                <div class="menu menu-column menu-rounded menu-sub-indention fw-semibold fs-6" id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false">
                    <!--begin:Menu item-->
                    <div data-kt-menu-trigger="click" class="menu-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <!--begin:Menu link-->
                        <a class="menu-link" href="{{ route('dashboard') }}" onclick="event.preventDefault(); window.location.href='{{ route('dashboard') }}';">
                            <span class="menu-icon">
                                <i class="ki-duotone ki-element-11 fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                </i>
                            </span>
                            <span class="menu-title">Laman Utama</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->

                    <!--begin:Menu item AKAUN PENGGUNA-->
                    <div class="menu-item pt-5">
                        <!--begin:Menu content-->
                        <div class="menu-content">
                            <span class="menu-heading fw-bold text-uppercase fs-7">AKAUN PENGGUNA</span>
                        </div>
                        <!--end:Menu content-->
                    </div>
                    <!--end:Menu item-->

                    <!--begin:Menu item-->
                    <div data-kt-menu-trigger="click" class="menu-item {{ request()->routeIs('senarai-pengguna') ? 'active' : '' }}">
                        <!--begin:Menu link-->
                        <span>
                            <a class="menu-link" href="{{ route('senarai-pengguna') }}" onclick="event.preventDefault(); window.location.href='{{ route('senarai-pengguna') }}';">
                                <span class="menu-icon">
                                    <i class="ki-duotone ki-user-edit fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                    </i>
                                </span>
                                <span class="menu-title">Senarai Pengguna</span>
                            </a>
                        </span>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->

                    <!--begin:Menu item PENGURUSAN-->
                    <div class="menu-item pt-5">
                        <!--begin:Menu content-->
                        <div class="menu-content">
                            <span class="menu-heading fw-bold text-uppercase fs-7">PENGURUSAN</span>
                        </div>
                        <!--end:Menu content-->
                    </div>
                    <!--end:Menu item-->

                    <!--begin:Menu item-->
                    <div data-kt-menu-trigger="click" class="menu-item {{ request()->routeIs('senarai-klien') ? 'active' : '' }}">
                        <!--begin:Menu link-->
                        <a class="menu-link" href="{{ route('senarai-klien') }}" onclick="event.preventDefault(); window.location.href='{{ route('senarai-klien') }}';">
                            <span class="menu-icon">
                                <i class="ki-duotone ki-badge fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                    <span class="path5"></span>
                                </i>
                            </span>
                            <span class="menu-title">Profil Klien</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->

                    <!--begin:Menu item-->
                    <div data-kt-menu-trigger="click" class="menu-item {{ request()->routeIs('senarai-permohonan-klien') ? 'active' : '' }}">
                        <!--begin:Menu link-->
                        <a class="menu-link" href="{{ route('senarai-permohonan-klien') }}" onclick="event.preventDefault(); window.location.href='{{ route('senarai-permohonan-klien') }}';">
                            <span class="menu-icon">
                                <i class="ki-duotone ki-badge fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                    <span class="path5"></span>
                                </i>
                            </span>
                            <span class="menu-title">Permohonan Kemaskini Profil Klien</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->

                    <!--begin:Menu item-->
                    <div data-kt-menu-trigger="click" class="menu-item {{ request()->routeIs('maklum.balas.kepulihan') ? 'active' : '' }}">
                        <!--begin:Menu link-->
                        <a class="menu-link" href="{{ route('maklum.balas.kepulihan') }}" onclick="event.preventDefault(); window.location.href='{{ route('maklum.balas.kepulihan') }}';">
                            <span class="menu-icon">
                                <i class="ki-duotone ki-questionnaire-tablet fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                    <span class="path5"></span>
                                </i>
                            </span>
                            <span class="menu-title">Maklum Balas Soal Selidik</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->

                    <!--begin:Menu item-->
                    <div data-kt-menu-trigger="click" class="menu-item {{ request()->routeIs('pengurusan_program.pentadbir_sistem.senarai_prog') ? 'active' : '' }}">
                        <!--begin:Menu link-->
                        <a class="menu-link" href="{{ url('/pengurusan-program/pentadbir-sistem/senarai-prog') }}" onclick="event.preventDefault(); window.location.href='{{ url('/pengurusan-program/pentadbir-sistem/senarai-prog') }}';">
                            <span class="menu-icon">
                                <i class="ki-duotone bi-activity fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                    <span class="path5"></span>
                                </i>
                            </span>
                            <span class="menu-title">Aktiviti</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->

                    <!--begin:Menu item PELAPORAN-->
                    <div class="menu-item pt-5">
                        <!--begin:Menu content-->
                        <div class="menu-content">
                            <span class="menu-heading fw-bold text-uppercase fs-7">PELAPORAN</span>
                        </div>
                        <!--end:Menu content-->
                    </div>
                    <!--end:Menu item-->

                    <!--begin:Menu item-->
                    <div data-kt-menu-trigger="click" class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link" href="{{ url('/pelaporan/modal-kepulihan') }}" onclick="event.preventDefault(); window.location.href='{{ url('/pelaporan/modal-kepulihan') }}';">
                            <span class="menu-icon">
                                <i class="ki-duotone ki-graph-up fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                    <span class="path5"></span>
                                    <span class="path6"></span>
                                </i>
                            </span>
                            <span class="menu-title">Keseluruhan</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->

                    <!--begin:Menu item-->
                    <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{ request()->routeIs('pelaporan.analisis.modal_kepulihan', 'pelaporan.rekod.modal_kepulihan') ? 'show' : '' }}">
                        <!--begin:Menu link-->
                        <a class="menu-link">
                            <span class="menu-icon">
                                <i class="ki-duotone ki-graph-up fs-3">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                    <span class="path5"></span>
                                    <span class="path6"></span>
                                </i>
                            </span>
                            <span class="menu-title">Modal Kepulihan</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <!--end:Menu link-->

                        <!--begin:Submenu-->
                        <div class="menu-sub menu-sub-accordion">
                            <div class="menu-item">
                                <a class="menu-link {{ request()->routeIs('pelaporan.analisis.modal_kepulihan') ? 'active' : '' }}" href="{{ url('/pelaporan/analisis/modal-kepulihan') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Analisis Data</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link {{ request()->routeIs('pelaporan.rekod.modal_kepulihan') ? 'active' : '' }}" href="{{ url('/pelaporan/rekod/modal-kepulihan') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Rekod Klien</span>
                                </a>
                            </div>
                        </div>
                        <!--end:Submenu-->
                    </div>
                    <!--end:Menu item-->

                    <!--begin:Menu item-->
                    <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{ request()->routeIs('pelaporan.aktiviti.analisis', 'pelaporan.aktiviti.aktivitiPB.senarai_aktiviti') ? 'show' : '' }}">
                        <!--begin:Menu link-->
                        <a class="menu-link" href="javascript:void(0);">
                            <span class="menu-icon">
                                <i class="bi bi-graph-up fs-5">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                    <span class="path5"></span>
                                    <span class="path6"></span>
                                </i>
                            </span>
                            <span class="menu-title">Aktiviti</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <!--end:Menu link-->

                        <!--begin:Submenu-->
                        <div class="menu-sub menu-sub-accordion">
                            <div class="menu-item">
                                <a class="menu-link {{ request()->routeIs('pelaporan.aktiviti.analisis') ? 'active' : '' }}" href="{{ url('/pelaporan/aktiviti/analisis') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Analisis Data</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link {{ request()->routeIs('pelaporan.aktiviti.aktivitiPB.senarai_aktiviti') ? 'active' : '' }}" href="{{ url('/pelaporan/aktiviti/aktivitiPB/senarai-aktiviti') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Rekod Aktiviti</span>
                                </a>
                            </div>
                        </div>
                        <!--end:Submenu-->
                    </div>
                    <!--end:Menu item-->
                </div>
                <!--end::Menu-->
            </div>
            <!--end::Scroll wrapper-->
        </div>
        <!--end::Menu wrapper-->
    </div>
    <!--end::sidebar menu-->

    @elseif(Auth::user()->tahap_pengguna == 2)
    <!--begin::Logo-->
    <div class="app-sidebar-logo px-6" id="kt_app_sidebar_logo" class="logo-container">
        <!--begin::Logo image-->
        <a href="/" class="logo-container">
            <img alt="Logo" src="{{ asset('logo/mySupport-bg.png') }}" class="h-50px app-sidebar-logo-default" />
            <img alt="Logo" src="{{ asset('logo/mySupport-bg.png') }}" class="logo-position h-35px app-sidebar-logo-minimize" />
            <span class="app-sidebar-logo-default"><img alt="Logo" src="/logo/mySupport-huruf.png" class="logo-default h-40px mx-auto"/></span>
        </a>

        <div id="kt_app_sidebar_toggle" class="app-sidebar-toggle btn btn-icon btn-shadow btn-sm btn-color-muted btn-active-color-primary h-30px w-30px position-absolute top-50 start-100 translate-middle rotate" data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body" data-kt-toggle-name="app-sidebar-minimize">
            <i class="ki-duotone ki-black-left-line fs-3 rotate-180">
                <span class="path1"></span>
                <span class="path2"></span>
            </i>
        </div>
        <!--end::Sidebar toggle-->
    </div>
    <!--end::Logo-->

    <!--begin::sidebar menu KLIEN-->
    <div class="app-sidebar-menu overflow-hidden flex-column-fluid">
        <!--begin::Menu wrapper-->
        <div id="kt_app_sidebar_menu_wrapper" class="app-sidebar-wrapper">
            <!--begin::Scroll wrapper-->
            <div id="kt_app_sidebar_menu_scroll" class="scroll-y my-5 mx-3" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer" data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px" data-kt-scroll-save-state="true">
                <!--begin::Menu-->
                <div class="menu menu-column menu-rounded menu-sub-indention fw-semibold fs-6" id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false">
                    <!--begin:Menu item-->
                    <div data-kt-menu-trigger="click" class="menu-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <!--begin:Menu link-->
                        <a class="menu-link" href="{{ route('dashboard') }}" onclick="event.preventDefault(); window.location.href='{{ route('dashboard') }}';">
                            <span class="menu-icon">
                                <i class="ki-duotone ki-element-11 fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                </i>
                            </span>
                            <span class="menu-title">Laman Utama</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->


                    <!--begin:Menu item-->
                    <div class="menu-item pt-5">
                        <!--begin:Menu content-->
                        <div class="menu-content">
                            <span class="menu-heading fw-bold text-uppercase fs-7">PENGURUSAN PROFIL</span>
                        </div>
                        <!--end:Menu content-->
                    </div>
                    <!--end:Menu item-->

                    <!--begin:Menu item-->
                    <div data-kt-menu-trigger="click" class="menu-item {{ request()->routeIs('pengurusan-profil') ? 'active' : '' }}">
                        <!--begin:Menu link-->
                        <a class="menu-link" href="{{ route('pengurusan-profil') }}" onclick="event.preventDefault(); window.location.href='{{ route('pengurusan-profil') }}';">
                            <span class="menu-icon">
                                <i class="ki-duotone ki-badge fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                    <span class="path5"></span>
                                </i>
                            </span>
                            <span class="menu-title">Profil Peribadi</span>
                        </a>
                        <!--end:Menu link-->
                    </div>

                    <!--begin:Menu item-->
                    <div data-kt-menu-trigger="click" class="menu-item {{ request()->routeIs('pejabat-pengawasan') ? 'active' : '' }}">
                        <!--begin:Menu link-->
                        <a class="menu-link" href="{{ route('pejabat-pengawasan') }}" onclick="event.preventDefault(); window.location.href='{{ route('pejabat-pengawasan') }}';">
                            <span class="menu-icon">
                                <i class="ki-duotone ki-badge fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                    <span class="path5"></span>
                                </i>
                            </span>
                            <span class="menu-title">Pertukaran Pejabat</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->

                    @php
                        // Get the client's ID
                        $clientId = DB::table('klien')->where('no_kp', Auth::user()->no_kp)->value('id');

                        // Get the tkh_tamat_pengawasan date from RawatanKlien
                        $rawatanKlien = DB::table('rawatan_klien')->where('klien_id', $clientId)->first();
                        $tkhTamatPengawasan = $rawatanKlien ? $rawatanKlien->tkh_tamat_pengawasan : null;

                        // Check if the current date is after tkh_tamat_pengawasan
                        $currentDate = Carbon::now();
                        $afterTkhTamatPengawasan = $tkhTamatPengawasan ? $currentDate->greaterThan(Carbon::parse($tkhTamatPengawasan)) : false;
                    @endphp

                    <!-- Check the conditions -->
                    @if ($afterTkhTamatPengawasan)
                        <!--begin:Menu item-->
                        <div class="menu-item pt-5">
                            <!--begin:Menu content-->
                            <div class="menu-content">
                                <span class="menu-heading fw-bold text-uppercase fs-7">MODAL KEPULIHAN</span>
                            </div>
                            <!--end:Menu content-->
                        </div>
                        <!--end:Menu item-->

                        <!--begin:Menu item-->
                        <div data-kt-menu-trigger="click" class="menu-item {{ request()->routeIs('klien.soalSelidik') ? 'active' : '' }}">
                            <!--begin:Menu link-->
                            <a class="menu-link" href="{{ route('klien.soalSelidik') }}" onclick="event.preventDefault(); window.location.href='{{ route('klien.soalSelidik') }}';">
                                <span class="menu-icon">
                                    <i class="ki-duotone ki-questionnaire-tablet fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </span>
                                <span class="menu-title">Soal Selidik</span>
                            </a>
                        </div>
                        <!--end:Menu item-->
                    @endif
                </div>
                <!--end::Menu-->
            </div>
            <!--end::Scroll wrapper-->
        </div>
        <!--end::Menu wrapper-->
    </div>
    <!--end::sidebar menu-->

    @elseif(Auth::user()->tahap_pengguna == 3)
    <!--begin::Logo-->
    <div class="app-sidebar-logo px-6" id="kt_app_sidebar_logo" class="logo-container">
        <!--begin::Logo image-->
        <a href="/" class="logo-container">
            <img alt="Logo" src="{{ asset('logo/mySupport-bg.png') }}" class="h-50px app-sidebar-logo-default" />
            <img alt="Logo" src="{{ asset('logo/mySupport-bg.png') }}" class="logo-position h-35px app-sidebar-logo-minimize" />
            <span class="app-sidebar-logo-default"><img alt="Logo" src="/logo/mySupport-huruf.png" class="logo-default h-40px mx-auto"/></span>
        </a>

        <div id="kt_app_sidebar_toggle" class="app-sidebar-toggle btn btn-icon btn-shadow btn-sm btn-color-muted btn-active-color-primary h-30px w-30px position-absolute top-50 start-100 translate-middle rotate" data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body" data-kt-toggle-name="app-sidebar-minimize">
            <i class="ki-duotone ki-black-left-line fs-3 rotate-180">
                <span class="path1"></span>
                <span class="path2"></span>
            </i>
        </div>
        <!--end::Sidebar toggle-->
    </div>
    <!--end::Logo-->

    <!--begin::sidebar menu PEGAWAI BRPP-->
    <div class="app-sidebar-menu overflow-hidden flex-column-fluid">
        <!--begin::Menu wrapper-->
        <div id="kt_app_sidebar_menu_wrapper" class="app-sidebar-wrapper">
            <!--begin::Scroll wrapper-->
            <div id="kt_app_sidebar_menu_scroll" class="scroll-y my-5 mx-3" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer" data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px" data-kt-scroll-save-state="true">
                <!--begin::Menu-->
                <div class="menu menu-column menu-rounded menu-sub-indention fw-semibold fs-6" id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false">
                    <!--begin:Menu item-->
                    <div data-kt-menu-trigger="click" class="menu-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <!--begin:Menu link-->
                        <a class="menu-link" href="{{ route('dashboard') }}" onclick="event.preventDefault(); window.location.href='{{ route('dashboard') }}';">
                            <span class="menu-icon">
                                <i class="ki-duotone ki-element-11 fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                </i>
                            </span>
                            <span class="menu-title">Laman Utama</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->


                    <!--begin:Menu item PENGURUSAN-->
                    <div class="menu-item pt-5">
                        <!--begin:Menu content-->
                        <div class="menu-content">
                            <span class="menu-heading fw-bold text-uppercase fs-7">PENGURUSAN</span>
                        </div>
                        <!--end:Menu content-->
                    </div>
                    <!--end:Menu item-->

                    <!--begin:Menu item-->
                    <div data-kt-menu-trigger="click" class="menu-item {{ request()->routeIs('senarai-klien-brpp') ? 'active' : '' }}">
                        <!--begin:Menu link-->
                        <a class="menu-link" href="{{ route('senarai-klien-brpp') }}" onclick="event.preventDefault(); window.location.href='{{ route('senarai-klien-brpp') }}';">
                            <span class="menu-icon">
                                <i class="ki-duotone ki-badge fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                    <span class="path5"></span>
                                </i>
                            </span>
                            <span class="menu-title">Profil Klien</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->

                     <!--begin:Menu item-->
                     <div data-kt-menu-trigger="click" class="menu-item {{ request()->routeIs('senarai-permohonan-klien-brpp') ? 'active' : '' }}">
                        <!--begin:Menu link-->
                        <a class="menu-link" href="{{ route('senarai-permohonan-klien-brpp') }}" onclick="event.preventDefault(); window.location.href='{{ route('senarai-permohonan-klien-brpp') }}';">
                            <span class="menu-icon">
                                <i class="ki-duotone ki-badge fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                    <span class="path5"></span>
                                </i>
                            </span>
                            <span class="menu-title">Permohonan Kemaskini Profil Klien</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->

                    <!--begin:Menu item-->
                    <div data-kt-menu-trigger="click" class="menu-item {{ request()->routeIs('maklum.balas.kepulihan') ? 'active' : '' }}">
                        <!--begin:Menu link-->
                        <a class="menu-link" href="{{ route('maklum.balas.kepulihan') }}" onclick="event.preventDefault(); window.location.href='{{ route('maklum.balas.kepulihan') }}';">
                            <span class="menu-icon">
                                <i class="ki-duotone ki-questionnaire-tablet fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                    <span class="path5"></span>
                                </i>
                            </span>
                            <span class="menu-title">Maklum Balas Soal Selidik</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->

                    <!--begin:Menu item-->
                    <div data-kt-menu-trigger="click" class="menu-item {{ request()->routeIs('pengurusan_program.pentadbir_sistem.senarai_prog') ? 'active' : '' }}">
                        <!--begin:Menu link-->
                        <a class="menu-link" href="{{ url('/pengurusan-program/pentadbir-sistem/senarai-prog') }}" onclick="event.preventDefault(); window.location.href='{{ url('/pengurusan-program/pentadbir-sistem/senarai-prog') }}';">
                            <span class="menu-icon">
                                <i class="ki-duotone bi-activity fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                    <span class="path5"></span>
                                </i>
                            </span>
                            <span class="menu-title">Aktiviti</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->


                    <!--begin:Menu item PELAPORAN-->
                    <div class="menu-item pt-5">
                        <!--begin:Menu content-->
                        <div class="menu-content">
                            <span class="menu-heading fw-bold text-uppercase fs-7">PELAPORAN</span>
                        </div>
                        <!--end:Menu content-->
                    </div>
                    <!--end:Menu item-->

                    <!--begin:Menu item-->
                    <div data-kt-menu-trigger="click" class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link" href="{{ url('/pelaporan/modal-kepulihan') }}" onclick="event.preventDefault(); window.location.href='{{ url('/pelaporan/modal-kepulihan') }}';">
                            <span class="menu-icon">
                                <i class="ki-duotone ki-graph-up fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                    <span class="path5"></span>
                                    <span class="path6"></span>
                                </i>
                            </span>
                            <span class="menu-title">Keseluruhan</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->

                    <!--begin:Menu item-->
                    <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{ request()->routeIs('pelaporan.analisis.modal_kepulihan', 'pelaporan.rekod.modal_kepulihan') ? 'show' : '' }}">
                        <!--begin:Menu link-->
                        <a class="menu-link" href="javascript:void(0);">
                            <span class="menu-icon">
                                <i class="bi bi-graph-up fs-5">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                    <span class="path5"></span>
                                    <span class="path6"></span>
                                </i>
                            </span>
                            <span class="menu-title">Modal Kepulihan</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <!--end:Menu link-->

                        <!--begin:Submenu-->
                        <div class="menu-sub menu-sub-accordion">
                            <div class="menu-item">
                                <a class="menu-link {{ request()->routeIs('pelaporan.analisis.modal_kepulihan') ? 'active' : '' }}" href="{{ url('/pelaporan/analisis/modal-kepulihan') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Analisis Data</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link {{ request()->routeIs('pelaporan.rekod.modal_kepulihan') ? 'active' : '' }}" href="{{ url('/pelaporan/rekod/modal-kepulihan') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Rekod Modal Kepulihan</span>
                                </a>
                            </div>
                        </div>
                        <!--end:Submenu-->
                    </div>
                    <!--end:Menu item-->

                    <!--begin:Menu item-->
                    <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{ request()->routeIs('pelaporan.aktiviti.analisis', 'pelaporan.aktiviti.aktivitiPB.senarai_aktiviti') ? 'show' : '' }}">
                        <!--begin:Menu link-->
                        <a class="menu-link" href="javascript:void(0);">
                            <span class="menu-icon">
                                <i class="bi bi-graph-up fs-5">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                    <span class="path5"></span>
                                    <span class="path6"></span>
                                </i>
                            </span>
                            <span class="menu-title">Aktiviti</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <!--end:Menu link-->

                        <!--begin:Submenu-->
                        <div class="menu-sub menu-sub-accordion">
                            <div class="menu-item">
                                <a class="menu-link {{ request()->routeIs('pelaporan.aktiviti.analisis') ? 'active' : '' }}" href="{{ url('/pelaporan/aktiviti/analisis') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Analisis Data</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link {{ request()->routeIs('pelaporan.aktiviti.aktivitiPB.senarai_aktiviti') ? 'active' : '' }}" href="{{ url('/pelaporan/aktiviti/aktivitiPB/senarai-aktiviti') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Rekod Aktiviti</span>
                                </a>
                            </div>
                        </div>
                        <!--end:Submenu-->
                    </div>
                    <!--end:Menu item-->
                </div>
                <!--end::Menu-->
            </div>
            <!--end::Scroll wrapper-->
        </div>
        <!--end::Menu wrapper-->
    </div>
    <!--end::sidebar menu-->

    @elseif(Auth::user()->tahap_pengguna == 4)
    <!--begin::Logo-->
    <div class="app-sidebar-logo px-6" id="kt_app_sidebar_logo" class="logo-container">
        <!--begin::Logo image-->
        <a href="/" class="logo-container">
            <img alt="Logo" src="{{ asset('logo/mySupport-bg.png') }}" class="h-50px app-sidebar-logo-default" />
            <img alt="Logo" src="{{ asset('logo/mySupport-bg.png') }}" class="logo-position h-35px app-sidebar-logo-minimize" />
            <span class="app-sidebar-logo-default"><img alt="Logo" src="/logo/mySupport-huruf.png" class="logo-default h-40px mx-auto"/></span>
        </a>

        <div id="kt_app_sidebar_toggle" class="app-sidebar-toggle btn btn-icon btn-shadow btn-sm btn-color-muted btn-active-color-primary h-30px w-30px position-absolute top-50 start-100 translate-middle rotate" data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body" data-kt-toggle-name="app-sidebar-minimize">
            <i class="ki-duotone ki-black-left-line fs-3 rotate-180">
                <span class="path1"></span>
                <span class="path2"></span>
            </i>
        </div>
        <!--end::Sidebar toggle-->
    </div>
    <!--end::Logo-->

    <!--begin::sidebar menu PEGAWAI NEGERI-->
    <div class="app-sidebar-menu overflow-hidden flex-column-fluid">
        <!--begin::Menu wrapper-->
        <div id="kt_app_sidebar_menu_wrapper" class="app-sidebar-wrapper">
            <!--begin::Scroll wrapper-->
            <div id="kt_app_sidebar_menu_scroll" class="scroll-y my-5 mx-3" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer" data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px" data-kt-scroll-save-state="true">
                <!--begin::Menu-->
                <div class="menu menu-column menu-rounded menu-sub-indention fw-semibold fs-6" id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false">
                    <!--begin:Menu item-->
                    <div data-kt-menu-trigger="click" class="menu-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <!--begin:Menu link-->
                        <a class="menu-link" href="{{ route('dashboard') }}" onclick="event.preventDefault(); window.location.href='{{ route('dashboard') }}';">
                            <span class="menu-icon">
                                <i class="ki-duotone ki-element-11 fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                </i>
                            </span>
                            <span class="menu-title">Laman Utama</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->


                    <!--begin:Menu item PENGURUSAN-->
                    <div class="menu-item pt-5">
                        <!--begin:Menu content-->
                        <div class="menu-content">
                            <span class="menu-heading fw-bold text-uppercase fs-7">PENGURUSAN</span>
                        </div>
                        <!--end:Menu content-->
                    </div>
                    <!--end:Menu item-->

                    <!--begin:Menu item-->
                    <div data-kt-menu-trigger="click" class="menu-item {{ request()->routeIs('senarai-klien-negeri') ? 'active' : '' }}">
                        <!--begin:Menu link-->
                        <a class="menu-link" href="{{ route('senarai-klien-negeri') }}" onclick="event.preventDefault(); window.location.href='{{ route('senarai-klien-negeri') }}';">
                            <span class="menu-icon">
                                <i class="ki-duotone ki-badge fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                    <span class="path5"></span>
                                </i>
                            </span>
                            <span class="menu-title">Profil Klien</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->

                    <!--begin:Menu item-->
                    <div data-kt-menu-trigger="click" class="menu-item {{ request()->routeIs('senarai-permohonan-klien-negeri') ? 'active' : '' }}">
                        <!--begin:Menu link-->
                        <a class="menu-link" href="{{ route('senarai-permohonan-klien-negeri') }}" onclick="event.preventDefault(); window.location.href='{{ route('senarai-permohonan-klien-negeri') }}';">
                            <span class="menu-icon">
                                <i class="ki-duotone ki-badge fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                    <span class="path5"></span>
                                </i>
                            </span>
                            <span class="menu-title">Permohonan Kemaskini Profil Klien</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->

                    <!--begin:Menu item-->
                    <div data-kt-menu-trigger="click" class="menu-item {{ request()->routeIs('maklum.balas.kepulihan') ? 'active' : '' }}">
                        <!--begin:Menu link-->
                        <a class="menu-link" href="{{ route('maklum.balas.kepulihan') }}" onclick="event.preventDefault(); window.location.href='{{ route('maklum.balas.kepulihan') }}';">
                            <span class="menu-icon">
                                <i class="ki-duotone ki-questionnaire-tablet fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                    <span class="path5"></span>
                                </i>
                            </span>
                            <span class="menu-title">Maklum Balas Soal Selidik</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->

                    <!--begin:Menu item-->
                    <div data-kt-menu-trigger="click" class="menu-item {{ request()->routeIs('pengurusan_program.pegawai_aadk.senarai_prog') ? 'active' : '' }}">
                        <!--begin:Menu link-->
                        <a class="menu-link" href="{{ url('/pengurusan-program/pegawai-aadk/senarai-prog') }}" onclick="event.preventDefault(); window.location.href='{{ url('/pengurusan-program/pegawai-aadk/senarai-prog') }}';">
                            <span class="menu-icon">
                                <i class="ki-duotone bi-activity fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                    <span class="path5"></span>
                                </i>
                            </span>
                            <span class="menu-title">Aktiviti</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->


                    <!--begin:Menu item PELAPORAN-->
                    <div class="menu-item pt-5">
                        <!--begin:Menu content-->
                        <div class="menu-content">
                            <span class="menu-heading fw-bold text-uppercase fs-7">PELAPORAN</span>
                        </div>
                        <!--end:Menu content-->
                    </div>
                    <!--end:Menu item-->

                    <!--begin:Menu item-->
                    <div data-kt-menu-trigger="click" class="menu-item {{ request()->routeIs('pelaporan.modal_kepulihan.negeri') ? 'active' : '' }}">
                        <!--begin:Menu link-->
                        <a class="menu-link" href="{{ url('/pegawai-negeri/pelaporan/modal-kepulihan') }}" onclick="event.preventDefault(); window.location.href='{{ url('/pegawai-negeri/pelaporan/modal-kepulihan') }}';">
                            <span class="menu-icon">
                                <i class="ki-duotone ki-graph-up fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                    <span class="path5"></span>
                                    <span class="path6"></span>
                                </i>
                            </span>
                            <span class="menu-title">Modal Kepulihan</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->

                    <!--begin:Menu item-->
                    <div data-kt-menu-trigger="click" class="menu-item {{ request()->routeIs('pelaporan.aktiviti.aktivitiND.senarai_aktiviti') ? 'active' : '' }}">
                        <!--begin:Menu link-->
                        <a class="menu-link" href="{{ url('/pelaporan/aktiviti/aktivitiND/senarai-aktiviti') }}" onclick="event.preventDefault(); window.location.href='{{ url('/pelaporan/aktiviti/aktivitiND/senarai-aktiviti') }}';">
                            <span class="menu-icon">
                                <i class="bi bi-graph-up fs-5">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                    <span class="path5"></span>
                                    <span class="path6"></span>
                                </i>
                            </span>
                            <span class="menu-title">Aktiviti</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->
                </div>
                <!--end::Menu-->
            </div>
            <!--end::Scroll wrapper-->
        </div>
        <!--end::Menu wrapper-->
    </div>
    <!--end::sidebar menu-->

    @elseif(Auth::user()->tahap_pengguna == 5)
    <!--begin::Logo-->
    <div class="app-sidebar-logo px-6" id="kt_app_sidebar_logo" class="logo-container">
        <!--begin::Logo image-->
        <a href="/" class="logo-container">
            <img alt="Logo" src="{{ asset('logo/mySupport-bg.png') }}" class="h-50px app-sidebar-logo-default" />
            <img alt="Logo" src="{{ asset('logo/mySupport-bg.png') }}" class="logo-position h-35px app-sidebar-logo-minimize" />
            <span class="app-sidebar-logo-default"><img alt="Logo" src="/logo/mySupport-huruf.png" class="logo-default h-40px mx-auto"/></span>
        </a>

        <div id="kt_app_sidebar_toggle" class="app-sidebar-toggle btn btn-icon btn-shadow btn-sm btn-color-muted btn-active-color-primary h-30px w-30px position-absolute top-50 start-100 translate-middle rotate" data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body" data-kt-toggle-name="app-sidebar-minimize">
            <i class="ki-duotone ki-black-left-line fs-3 rotate-180">
                <span class="path1"></span>
                <span class="path2"></span>
            </i>
        </div>
        <!--end::Sidebar toggle-->
    </div>
    <!--end::Logo-->

    <!--begin::sidebar menu PEGAWAI DAERAH-->
    <div class="app-sidebar-menu overflow-hidden flex-column-fluid">
        <!--begin::Menu wrapper-->
        <div id="kt_app_sidebar_menu_wrapper" class="app-sidebar-wrapper">
            <!--begin::Scroll wrapper-->
            <div id="kt_app_sidebar_menu_scroll" class="scroll-y my-5 mx-3" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer" data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px" data-kt-scroll-save-state="true">
                <!--begin::Menu-->
                <div class="menu menu-column menu-rounded menu-sub-indention fw-semibold fs-6" id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false">
                    <!--begin:Menu item-->
                    <div data-kt-menu-trigger="click" class="menu-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <!--begin:Menu link-->
                        <a class="menu-link" href="{{ route('dashboard') }}" onclick="event.preventDefault(); window.location.href='{{ route('dashboard') }}';">
                            <span class="menu-icon">
                                <i class="ki-duotone ki-element-11 fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                </i>
                            </span>
                            <span class="menu-title">Laman Utama</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->


                    <!--begin:Menu item AKAUN KLIEN-->
                    <div class="menu-item pt-5">
                        <!--begin:Menu content-->
                        <div class="menu-content">
                            <span class="menu-heading fw-bold text-uppercase fs-7">AKAUN KLIEN</span>
                        </div>
                        <!--end:Menu content-->
                    </div>
                    <!--end:Menu item-->

                    <!--begin:Menu item-->
                    <div data-kt-menu-trigger="click" class="menu-item {{ request()->routeIs('pegawai-daerah.senarai-klien') ? 'active' : '' }}">
                        <!--begin:Menu link-->
                        <span>
                            <a class="menu-link" href="{{ route('pegawai-daerah.senarai-klien') }}" onclick="event.preventDefault(); window.location.href='{{ route('pegawai-daerah.senarai-klien') }}';">
                                <span class="menu-icon">
                                    <i class="ki-duotone ki-user-edit fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                    </i>
                                </span>
                                <span class="menu-title">Senarai Klien</span>
                            </a>
                        </span>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->


                    <!--begin:Menu item PENGURUSAN-->
                    <div class="menu-item pt-5">
                        <!--begin:Menu content-->
                        <div class="menu-content">
                            <span class="menu-heading fw-bold text-uppercase fs-7">PENGURUSAN</span>
                        </div>
                        <!--end:Menu content-->
                    </div>
                    <!--end:Menu item-->

                    <!--begin:Menu item-->
                    <div data-kt-menu-trigger="click" class="menu-item {{ request()->routeIs('senarai-klien-daerah') ? 'active' : '' }}">
                        <!--begin:Menu link-->
                        <a class="menu-link" href="{{ route('senarai-klien-daerah') }}" onclick="event.preventDefault(); window.location.href='{{ route('senarai-klien-daerah') }}';">
                            <span class="menu-icon">
                                <i class="ki-duotone ki-badge fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                    <span class="path5"></span>
                                </i>
                            </span>
                            <span class="menu-title">Profil Klien</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->

                    <!--begin:Menu item-->
                    <div data-kt-menu-trigger="click" class="menu-item {{ request()->routeIs('senarai-permohonan-klien-daerah') ? 'active' : '' }}">
                        <!--begin:Menu link-->
                        <a class="menu-link" href="{{ route('senarai-permohonan-klien-daerah') }}" onclick="event.preventDefault(); window.location.href='{{ route('senarai-permohonan-klien-daerah') }}';">
                            <span class="menu-icon">
                                <i class="ki-duotone ki-badge fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                    <span class="path5"></span>
                                </i>
                            </span>
                            <span class="menu-title">Permohonan Kemaskini Profil Klien</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->

                    <!--begin:Menu item-->
                    <div data-kt-menu-trigger="click" class="menu-item {{ request()->routeIs('maklum.balas.kepulihan') ? 'active' : '' }}">
                        <!--begin:Menu link-->
                        <a class="menu-link" href="{{ route('maklum.balas.kepulihan') }}" onclick="event.preventDefault(); window.location.href='{{ route('maklum.balas.kepulihan') }}';">
                            <span class="menu-icon">
                                <i class="ki-duotone ki-questionnaire-tablet fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                    <span class="path5"></span>
                                </i>
                            </span>
                            <span class="menu-title">Maklum Balas Soal Selidik</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->

                    <!--begin:Menu item-->
                    <div data-kt-menu-trigger="click" class="menu-item {{ request()->routeIs('pengurusan_program.pegawai_aadk.senarai_prog') ? 'active' : '' }}">
                        <!--begin:Menu link-->
                        <a class="menu-link" href="{{ url('/pengurusan-program/pegawai-aadk/senarai-prog') }}" onclick="event.preventDefault(); window.location.href='{{ url('/pengurusan-program/pegawai-aadk/senarai-prog') }}';">
                            <span class="menu-icon">
                                <i class="ki-duotone bi-activity fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                    <span class="path5"></span>
                                </i>
                            </span>
                            <span class="menu-title">Aktiviti</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->


                    <!--begin:Menu item PELAPORAN-->
                    <div class="menu-item pt-5">
                        <!--begin:Menu content-->
                        <div class="menu-content">
                            <span class="menu-heading fw-bold text-uppercase fs-7">PELAPORAN</span>
                        </div>
                        <!--end:Menu content-->
                    </div>
                    <!--end:Menu item-->

                    <!--begin:Menu item-->
                    <div data-kt-menu-trigger="click" class="menu-item {{ request()->routeIs('pelaporan.modal_kepulihan.daerah') ? 'active' : '' }}">
                        <!--begin:Menu link-->
                        <a class="menu-link" href="{{ url('/pegawai-daerah/pelaporan/modal-kepulihan') }}" onclick="event.preventDefault(); window.location.href='{{ url('/pegawai-daerah/pelaporan/modal-kepulihan') }}';">
                            <span class="menu-icon">
                                <i class="ki-duotone ki-graph-up fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                    <span class="path5"></span>
                                    <span class="path6"></span>
                                </i>
                            </span>
                            <span class="menu-title">Modal Kepulihan</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->

                    <!--begin:Menu item-->
                    <div data-kt-menu-trigger="click" class="menu-item {{ request()->routeIs('pelaporan.aktiviti.aktivitiND.senarai_aktiviti') ? 'active' : '' }}">
                        <!--begin:Menu link-->
                        <a class="menu-link" href="{{ url('/pelaporan/aktiviti/aktivitiND/senarai-aktiviti') }}" onclick="event.preventDefault(); window.location.href='{{ url('/pelaporan/aktiviti/aktivitiND/senarai-aktiviti') }}';">
                            <span class="menu-icon">
                                <i class="bi bi-graph-up fs-5">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                    <span class="path5"></span>
                                    <span class="path6"></span>
                                </i>
                            </span>
                            <span class="menu-title">Aktiviti</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->
                </div>
                <!--end::Menu-->
            </div>
            <!--end::Scroll wrapper-->
        </div>
        <!--end::Menu wrapper-->
    </div>
    <!--end::sidebar menu-->
    @endif
</div>
