<head>
    <style>
        .profile-picture {
            width: 40px !important; /* Adjust the width as needed */
            height: 40px !important; /* Ensure height is the same as width for a perfect circle */
            border-radius: 50% !important; /* This makes the image circular */
            object-fit: cover; /* Ensures the image covers the area without distortion */
            margin-right: 10px; /* Space between the image and the text */
            vertical-align: middle; /* Align with text vertically */
        }

        .cursor-pointer {
            cursor: pointer;
            display: flex;
            align-items: center;
        }
    </style>
</head>

<div id="kt_app_header" class="app-header" data-kt-sticky="true" data-kt-sticky-activate="{default: true, lg: true}" data-kt-sticky-name="app-header-minimize" data-kt-sticky-offset="{default: '200px', lg: '0'}" data-kt-sticky-animation="false">
    <!--begin::Header container-->
    <div class="app-container container-fluid d-flex align-items-stretch justify-content-between" id="kt_app_header_container">
        <!--begin::Sidebar mobile toggle-->
        <div class="d-flex align-items-center d-lg-none ms-n3 me-1 me-md-2" title="Show sidebar menu">
            <div class="btn btn-icon btn-active-color-primary w-35px h-35px" id="kt_app_sidebar_mobile_toggle">
                <i class="ki-duotone ki-abstract-14 fs-2 fs-md-1">
                    <span class="path1"></span>
                    <span class="path2"></span>
                </i>
            </div>
        </div>
        <!--end::Sidebar mobile toggle-->
        
        <!--begin::Header wrapper-->
        <div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1" id="kt_app_header_wrapper">
            <!--begin::Menu wrapper-->
            <div class="app-header-menu app-header-mobile-drawer align-items-stretch" data-kt-drawer="true" data-kt-drawer-name="app-header-menu" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="250px" data-kt-drawer-direction="end" data-kt-drawer-toggle="#kt_app_header_menu_toggle" data-kt-swapper="true" data-kt-swapper-mode="{default: 'append', lg: 'prepend'}" data-kt-swapper-parent="{default: '#kt_app_body', lg: '#kt_app_header_wrapper'}">
            </div>
            <!--end::Menu wrapper-->

            <!--begin::Navbar-->
            <div class="app-navbar flex-shrink-0">
                <!--begin::User menu-->
                <div class="app-navbar-item ms-1 ms-md-4" id="kt_header_user_menu_toggle">
                    <div class="cursor-pointer symbol symbol-35px symbol-2by3 fs-4" data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end" style="font-weight: bold; color:#2d2d5d;">
                        @if(Auth::user()->gambar_profil)
                            <img src="{{ asset('assets/gambar_profil/' . Auth::user()->gambar_profil) }}" alt="Gambar" class="profile-picture" />
                            {{ strtoupper(Auth::user()->name) }}
                        @else
                            <i class="fa fa-user" style="color: #2d2d5d; padding-right:5px; font-size:15px;"></i>
                            {{ strtoupper(Auth::user()->name) }}
                        @endif
                    </div>

                    <!--begin::User account menu-->
                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px" data-kt-menu="true">
                        <!--begin::Menu item-->
                        <div class="menu-item px-3">
                            <div class="menu-content d-flex align-items-center">
                                <div class="symbol symbol-40px me-5">
                                    <div class="symbol-label fs-2 bg-light-primary text-primary">
                                        {{ substr(Auth::user()->name,0,1) }}
                                    </div>
                                </div>
                                {{-- @php
                                    $nama = DB::table('smoku')->where('nokp', Auth::user()->no_kp)->value('nama');
                                    $nama2 = Auth::user()->nama;
                                @endphp
                                <!--begin::Avatar-->
                                <div class="symbol symbol-50px me-5">
                                    @if($nama2)
                                        <div class="symbol-label fs-3 bg-light-primary text-primary">
                                            {{ substr($nama2,0,1) }}
                                        </div>
                                    @elseif($nama)
                                        <div class="symbol-label fs-3 bg-light-primary text-primary">
                                            {{ substr($nama,0,1) }}
                                        </div>
                                    @else
                                        <div class="symbol-label fs-3 bg-light-primary text-primary">
                                            {{ substr(Auth::user()->email,0,1) }}
                                        </div>
                                    @endif
                                </div> --}}
                                <!--end::Avatar-->
                    
                                <!--begin::Username-->
                                <div class="d-flex flex-column">
                                    <div class="fw-bold d-flex align-items-center fs-6">{{Auth::user()->name}}</div>
                                    <a href="#" class="fw-semibold text-muted text-hover-primary fs-8">{{ Auth::user()->email }}</a>
                                    {{-- @if($nama2)
                                        <div class="fw-bold d-flex align-items-center fs-5">{{$nama2}}</div>
                                    @else
                                        <div class="fw-bold d-flex align-items-center fs-5">{{$nama}}</div>
                                    @endif
                                    <a href="#" class="fw-semibold text-muted text-hover-primary fs-7">{{ Auth::user()->email }}</a> --}}
                                </div>
                                <!--end::Username-->
                            </div>
                        </div>
                        <!--end::Menu item-->

                        <!--begin::Menu separator-->
                        <div class="separator my-2"></div>
                        <!--end::Menu separator-->

                        <!--begin::Menu item-->
                        <div class="menu-item px-5">
                            <a href="{{route('profile.edit')}}" class="menu-link px-5">Profil Diri</a>
                        </div>
                        <!--end::Menu item-->

                        <!--begin::Menu item-->
                        <div class="menu-item px-5">
                            <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                      document.getElementById('logout-form').submit();" class="menu-link px-5">Log Keluar</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                        <!--end::Menu item-->
                    </div>
                    <!--end::User account menu-->
                    <!--end::Menu wrapper-->
                </div>
                <!--end::User menu-->
            </div>
            <!--end::Navbar-->
        </div>
        <!--end::Header wrapper-->
    </div>
    <!--end::Header container-->
</div> 
