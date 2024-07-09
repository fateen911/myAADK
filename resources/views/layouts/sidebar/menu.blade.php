<head>
    <style>
        a.logo-container {
            display: flex;
            align-items: center;  /* Vertically centers the items */
            justify-content: center;  /* Horizontally centers the items */
        }

        a .myaadk-text {
            font-family:Georgia, 'Times New Roman', Times, serif;
            font-size: 27px;
            margin-left: 10px;  /* Adjust the space between the logo and the text */
            padding-top: 5px;
            color: lightgray;  /* Optional: Set the text color */
            font-weight: bold;  /* Optional: Make the text bold */
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
        <a href="https://www.adk.gov.my/?lang=en" class="logo-container">
            <img alt="Logo" src="{{ asset('logo/aadk.png') }}" class="h-50px app-sidebar-logo-default" />
            <span class="myaadk-text">i-Recover</span>
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

                    <!--begin:Menu item-->
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
                    <div data-kt-menu-trigger="click" class="menu-item {{ request()->routeIs('senarai-klien') || request()->routeIs('maklumat-klien') ? 'active' : '' }}">
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
                    <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                        <!--begin:Menu link-->
                        <span class="menu-link">
                            <span class="menu-icon">
                                <i class="ki-duotone ki-questionnaire-tablet fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                            </span>
                            <span class="menu-title">Soal Selidik Kepulihan</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <!--end:Menu link-->

                        <!--begin:Menu sub-->
                        <div class="menu-sub menu-sub-accordion">
                            <!--begin:Menu item-->
                            <div class="menu-item {{ request()->routeIs('maklum.balas.kepulihan') ? 'active' : '' }}">
                                <!--begin:Menu link-->
                                <a class="menu-link" href={{route('maklum.balas.kepulihan')}}>
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Maklum Balas</span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                            <!--end:Menu item-->

                            <!--begin:Menu item-->
                            {{-- <div data-kt-menu-trigger="click" class="menu-item {{ request()->routeIs('soalan-kepulihan') ? 'active' : '' }}">
                                <!--begin:Menu link-->
                                <span class="menu-link">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Senarai Soalan</span>
                                </span>
                                <!--end:Menu link-->
                            </div> --}}
                            <!--end:Menu item-->
                        </div>
                        <!--end:Menu sub-->
                    </div>
                    <!--end:Menu item-->

                    <!--begin:Menu item-->
                    <div data-kt-menu-trigger="click" class="menu-item {{ request()->routeIs('pengurusan_program.pentadbir_sistem.senarai_prog') ? 'active' : '' }}">
                        <!--begin:Menu link-->
                        <a class="menu-link" href="{{ url('/pengurusan_program/pentadbir_sistem/senarai_prog') }}" onclick="event.preventDefault(); window.location.href='{{ url('/pengurusan_program/pentadbir_sistem/senarai_prog') }}';">
                            <span class="menu-icon">
                                <i class="ki-duotone ki-badge fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                    <span class="path5"></span>
                                </i>
                            </span>
                            <span class="menu-title">Program</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->

{{--                    <!--begin:Menu item-->--}}
{{--                    <div data-kt-menu-trigger="click" class="menu-item menu-accordion">--}}
{{--                        <!--begin:Menu link-->--}}
{{--                        <span class="menu-link">--}}
{{--                            <span class="menu-icon">--}}
{{--                                <i class="ki-duotone ki-calendar-add fs-2">--}}
{{--                                    <span class="path1"></span>--}}
{{--                                    <span class="path2"></span>--}}
{{--                                    <span class="path3"></span>--}}
{{--                                    <span class="path4"></span>--}}
{{--                                    <span class="path5"></span>--}}
{{--                                    <span class="path6"></span>--}}
{{--                                </i>--}}
{{--                            </span>--}}
{{--                            <span class="menu-title">Program</span>--}}
{{--                            <span class="menu-arrow"></span>--}}
{{--                        </span>--}}
{{--                        <!--end:Menu link-->--}}

{{--                        <!--begin:Menu sub-->--}}
{{--                        <div class="menu-sub menu-sub-accordion">--}}
{{--                            <!--begin:Menu item-->--}}
{{--                            <div class="menu-item {{ request()->routeIs('pengurusan_program.pentadbir_sistem.senarai_prog') ? 'active' : '' }}">--}}
{{--                                <!--begin:Menu link-->--}}
{{--                                <a class="menu-link" href={{url('/pengurusan_program/pentadbir_sistem/senarai_prog')}}>--}}
{{--                                    <span class="menu-bullet">--}}
{{--                                        <span class="bullet bullet-dot"></span>--}}
{{--                                    </span>--}}
{{--                                    <span class="menu-title">Pendaftaran</span>--}}
{{--                                </a>--}}
{{--                                <!--end:Menu link-->--}}
{{--                            </div>--}}
{{--                            <!--end:Menu item-->--}}
{{--                            <!--begin:Menu item-->--}}
{{--                            <div class="menu-item">--}}
{{--                                <!--begin:Menu link-->--}}
{{--                                <a class="menu-link" href="../../demo1/dist/apps/projects/list.html">--}}
{{--                                    <span class="menu-bullet">--}}
{{--                                        <span class="bullet bullet-dot"></span>--}}
{{--                                    </span>--}}
{{--                                    <span class="menu-title">Hebahan</span>--}}
{{--                                </a>--}}
{{--                                <!--end:Menu link-->--}}
{{--                            </div>--}}
{{--                            <!--end:Menu item-->--}}
{{--                            <!--begin:Menu item-->--}}
{{--                            <div class="menu-item">--}}
{{--                                <!--begin:Menu link-->--}}
{{--                                <a class="menu-link" href="../../demo1/dist/apps/projects/project.html">--}}
{{--                                    <span class="menu-bullet">--}}
{{--                                        <span class="bullet bullet-dot"></span>--}}
{{--                                    </span>--}}
{{--                                    <span class="menu-title">Kehadiran</span>--}}
{{--                                </a>--}}
{{--                                <!--end:Menu link-->--}}
{{--                            </div>--}}
{{--                            <!--end:Menu item-->--}}
{{--                        </div>--}}
{{--                        <!--end:Menu sub-->--}}
{{--                    </div>--}}
{{--                    <!--end:Menu item-->--}}


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
                    <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                        <!--begin:Menu link-->
                        <span class="menu-link">
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
                            <span class="menu-title">Jana Laporan</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <!--end:Menu link-->

                        <!--begin:Menu sub-->
                        <div class="menu-sub menu-sub-accordion">
                            <!--begin:Menu item-->
                            <div data-kt-menu-trigger="click" class="menu-item {{ request()->routeIs('laporan-modal-kepulihan') ? 'active' : '' }}">
                                <!--begin:Menu link-->
                                <span class="menu-link">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Modal Kepulihan</span>
                                </span>
                                <!--end:Menu link-->
                            </div>
                            <!--end:Menu item-->
                            <!--begin:Menu item-->
                            <div data-kt-menu-trigger="click" class="menu-item {{ request()->routeIs('laporan-program-kepulihan') ? 'active' : '' }}">
                                <!--begin:Menu link-->
                                <span class="menu-link">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Program Kepulihan</span>
                                </span>
                                <!--end:Menu link-->
                            </div>
                            <!--end:Menu item-->
                        </div>
                        <!--end:Menu sub-->
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
        <a href="https://www.adk.gov.my/?lang=en" class="logo-container">
            <img alt="Logo" src="{{ asset('logo/aadk.png') }}" class="h-50px app-sidebar-logo-default" />
            <span class="myaadk-text">i-Recover</span>
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
                    <div data-kt-menu-trigger="click" class="menu-item here show menu-accordion">
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

                    <!--begin:Menu item-->
                    <div data-kt-menu-trigger="click" class="menu-item {{ request()->routeIs('pengurusan_program.pentadbir_sistem.senarai_prog') ? 'active' : '' }}">
                        <!--begin:Menu link-->
                        <a class="menu-link" href="{{ url('/pengurusan_program/pentadbir_sistem/senarai_prog') }}" onclick="event.preventDefault(); window.location.href='{{ url('/pengurusan_program/pentadbir_sistem/senarai_prog') }}';">
                            <span class="menu-icon">
                                <i class="ki-duotone ki-badge fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                    <span class="path5"></span>
                                </i>
                            </span>
                            <span class="menu-title">Program</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->

                    <!--begin:Menu item-->
                    {{-- <div class="menu-item pt-5">
                        <!--begin:Menu content-->
                        <div class="menu-content">
                            <span class="menu-heading fw-bold text-uppercase fs-7">PROGRAM</span>
                        </div>
                        <!--end:Menu content-->
                    </div> --}}

                    <!--begin:Menu sub-->
                    {{-- <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                        <!--begin:Menu link-->
                        <span class="menu-link">
                            <span class="menu-icon">
                                <i class="ki-duotone ki-calendar-add fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                    <span class="path5"></span>
                                    <span class="path6"></span>
                                </i>
                            </span>
                            <span class="menu-title">Pengesahan Kehadiran</span>
                        </span>
                        <!--end:Menu link-->
                        <!--begin:Menu link-->
                        <span class="menu-link">
                            <span class="menu-icon">
                                <i class="ki-duotone ki-calendar-add fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                    <span class="path5"></span>
                                    <span class="path6"></span>
                                </i>
                            </span>
                            <span class="menu-title">Perekodan Kehadiran </span>
                        </span>
                        <!--end:Menu link-->
                    </div> --}}
                    <!--end:Menu sub-->
                </div>
                <!--end::Menu-->
            </div>
            <!--end::Scroll wrapper-->
        </div>
        <!--end::Menu wrapper-->
    </div>
    <!--end::sidebar menu-->

    @elseif(Auth::user()->tahap_pengguna == 3 || Auth::user()->tahap_pengguna == 4 || Auth::user()->tahap_pengguna == 5)
    <!--begin::Logo-->
    <div class="app-sidebar-logo px-6" id="kt_app_sidebar_logo" class="logo-container">
        <!--begin::Logo image-->
        <a href="https://www.adk.gov.my/?lang=en" class="logo-container">
            <img alt="Logo" src="{{ asset('logo/aadk.png') }}" class="h-50px app-sidebar-logo-default" />
            <span class="myaadk-text">i-Recover</span>
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

    <!--begin::sidebar menu KAKITANGAN-->
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
                    <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                        <!--begin:Menu link-->
                        <span class="menu-link">
                            <span class="menu-icon">
                                <i class="ki-duotone ki-questionnaire-tablet fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                            </span>
                            <span class="menu-title">Soal Selidik Kepulihan</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <!--end:Menu link-->
                        <!--begin:Menu sub-->
                        <div class="menu-sub menu-sub-accordion">
                            <!--begin:Menu item-->
                            <div class="menu-item {{ request()->routeIs('maklum.balas.kepulihan') ? 'active' : '' }}">
                                <!--begin:Menu link-->
                                <a class="menu-link" href={{route('maklum.balas.kepulihan')}}>
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Maklum Balas</span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                            <!--end:Menu item-->
                        </div>
                        <!--end:Menu sub-->
                    </div>
                    <!--end:Menu item-->

                    <!--begin:Menu item-->
                    <div data-kt-menu-trigger="click" class="menu-item {{ request()->routeIs('pengurusan_program.pegawai_aadk.senarai_prog') ? 'active' : '' }}">
                        <!--begin:Menu link-->
                        <a class="menu-link" href="{{ url('/pengurusan_program/pegawai_aadk/senarai_prog') }}" onclick="event.preventDefault(); window.location.href='{{ url('/pengurusan_program/pegawai_aadk/senarai_prog') }}';">
                            <span class="menu-icon">
                                <i class="ki-duotone ki-badge fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                    <span class="path5"></span>
                                </i>
                            </span>
                            <span class="menu-title">Program</span>
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
                    <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                        <!--begin:Menu link-->
                        <span class="menu-link">
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
                            <span class="menu-title">Jana Laporan</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <!--end:Menu link-->

                        <!--begin:Menu sub-->
                        <div class="menu-sub menu-sub-accordion">
                            <!--begin:Menu item-->
                            <div data-kt-menu-trigger="click" class="menu-item {{ request()->routeIs('laporan-modal-kepulihan') ? 'active' : '' }}">
                                <!--begin:Menu link-->
                                <span class="menu-link">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Modal Kepulihan</span>
                                </span>
                                <!--end:Menu link-->
                            </div>
                            <!--end:Menu item-->
                            <!--begin:Menu item-->
                            <div data-kt-menu-trigger="click" class="menu-item {{ request()->routeIs('laporan-program-kepulihan') ? 'active' : '' }}">
                                <!--begin:Menu link-->
                                <span class="menu-link">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Program Kepulihan</span>
                                </span>
                                <!--end:Menu link-->
                            </div>
                            <!--end:Menu item-->
                        </div>
                        <!--end:Menu sub-->
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
