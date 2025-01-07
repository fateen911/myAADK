<head>
    <!-- Include Bootstrap JS, Popper.js, and jQuery (if not already included) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    
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

        /* Notification count badge styling */
        .notification-count {
            position: absolute;
            top: -5px; /* Adjust this value to move the badge higher */
            right: -5px; /* Adjust this value to move the badge to the right */
            background-color: red; /* Red background for badge */
            color: white; /* White text for better contrast */
            border-radius: 50%; /* Makes the badge circular */
            font-size: 10px; /* Smaller font size */
            font-weight: bold;
            width: 18px; /* Set a fixed width for consistency */
            height: 18px; /* Set a fixed height for consistency */
            display: flex; /* Flexbox for centering text inside the badge */
            align-items: center; /* Vertically center the text */
            justify-content: center; /* Horizontally center the text */
            padding: 2px; /* Optional padding for text inside badge */
        }

        /* Icon styling with rounded background */
        #kt_menu_item_wow {
            position: relative; /* Required for absolute positioning of .notification-count */
            border-radius: 50% !important;
            background-color: lightgray;
            width: 40px; /* Width of the button */
            height: 40px; /* Height of the button */
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
</head>

<div id="kt_app_header" class="app-header" data-kt-sticky="true" data-kt-sticky-activate="{default: true, lg: true}" data-kt-sticky-name="app-header-minimize" data-kt-sticky-offset="{default: '200px', lg: '0'}" data-kt-sticky-animation="false">
    <!--begin::Header container-->
    <div class="app-container container-fluid d-flex align-items-stretch justify-content-between" id="kt_app_header_container">
        <!--begin::Sidebar mobile toggle-->
        <div class="d-flex align-items-center d-lg-none ms-n3 me-1 me-md-2" title="Show sidebar menu">
            <div class="btn btn-icon btn-active-color-primary w-35px h-35px" id="kt_app_sidebar_mobile_toggle">
                <i class="bi bi-list fs-3qx fs-md-3hx text-white">
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
                {{-- Notifikasi Klien --}}
                @if(Auth::user()->tahap_pengguna == 2)
                    <div class="app-navbar-item ms-1 ms-md-4" style="margin-right: 10px;">
                        <!--begin::Menu wrapper-->
                        <div class="btn btn-icon btn-custom btn-icon-dark w-35px h-35px" data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end" id="kt_menu_item_wow">
                            <i class="ki-solid ki-notification-on fs-2"></i>
                            <span class="notification-count">{{ $unreadCount }}</span>
                        </div>
                        <!--begin::Menu-->
                        <div class="menu menu-sub menu-sub-dropdown menu-column w-350px w-lg-375px" data-kt-menu="true" id="kt_menu_notifications">
                            <!--begin::Heading-->
                            <div class="d-flex flex-column bgi-no-repeat rounded-top" style="background-color:#363062;">
                                <!--begin::Title-->
                                <h3 class="text-white fw-semibold px-9 mt-5 mb-5">
                                    Semua Notifikasi
                                </h3>
                                <!--end::Title-->
                            </div>
                            <!--end::Heading-->

                            @if ($notifications->count())
                                <!--begin::Tab content-->
                                <div class="tab-content notification-item">
                                    <!--begin::Tab panel-->
                                    <div class="tab-pane fade show active" id="kt_topbar_notifications_1" role="tabpanel">
                                        <!--begin::Items-->
                                        <div class="scroll-y mh-250px">
                                            @foreach($notifications as $notification)
                                                <!--begin::Item-->
                                                <div class="d-flex flex-stack px-4 py-4 @if(!$notification->is_read) bg-light-primary @else bg-none @endif">
                                                    <!--begin::Section-->
                                                    <div class="d-flex align-items-center">
                                                        <!--begin::Title-->
                                                        <div class="mb-0 me-2">
                                                            <a href="{{ route('notifications.markRead', $notification->id) }}" class="fs-6 text-gray-800 text-hover-primary fw-bold">{{ $notification->status }}</a>
                                                            <div class="text-gray-400 fs-7">{{ $notification->message }}</div>
                                                            <span class="badge badge-light text-primary fs-8 mt-2">{{ $notification->created_at->locale('ms')->diffForHumans() }}</span>
                                                        </div>
                                                        <!--end::Title-->
                                                    </div>
                                                    <!--end::Section-->
                                                </div>
                                                <!--end::Item-->
                                            @endforeach
                                        </div>
                                        <!--end::Items-->

                                        <!--begin::View more-->
                                        <div class="py-3 text-center border-top">
                                            <a href="{{ route('notifications.index') }}" class="btn btn-color-gray-600 btn-active-color-primary">
                                                Lihat Semua
                                                <i class="ki-duotone ki-arrow-right fs-5">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            </a>
                                        </div>
                                        <!--end::View more-->
                                    </div>
                                    <!--end::Tab panel-->
                                </div>
                                <!--end::Tab content-->
                            @else
                                <p style="text-align: center; padding-top:10px;">Tiada notifikasi untuk klien ini.</p>
                            @endif
                        </div>
                        <!--end::Menu-->
                        <!--end::Menu wrapper-->
                    </div>
                @endif

                {{-- Notifikasi Klien --}}
                @if(Auth::user()->tahap_pengguna == 5)
                    <div class="app-navbar-item ms-1 ms-md-4" style="margin-right: 10px;">
                        <!--begin::Menu wrapper-->
                        <div class="btn btn-icon btn-custom btn-icon-dark w-35px h-35px" data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end" id="kt_menu_item_wow">
                            <i class="ki-solid ki-notification-on fs-2"></i>
                            <span class="notification-count">{{ $unreadCountPD }}</span>
                        </div>
                        <!--begin::Menu-->
                        <div class="menu menu-sub menu-sub-dropdown menu-column w-350px w-lg-375px" data-kt-menu="true" id="kt_menu_notifications">
                            <!--begin::Heading-->
                            <div class="d-flex flex-column bgi-no-repeat rounded-top" style="background-color:#363062;">
                                <!--begin::Title-->
                                <h3 class="text-white fw-semibold px-9 mt-5 mb-5">
                                    Semua Notifikasi Pegawai Daerah
                                </h3>
                                <!--end::Title-->
                            </div>
                            <!--end::Heading-->

                            @if ($notifications->count())
                                <!--begin::Tab content-->
                                <div class="tab-content notification-item">
                                    <!--begin::Tab panel-->
                                    <div class="tab-pane fade show active" id="kt_topbar_notifications_1" role="tabpanel">
                                        <!--begin::Items-->
                                        <div class="scroll-y mh-250px">
                                            @foreach($notifications as $notification)
                                                <!--begin::Item-->
                                                <div class="d-flex flex-stack px-4 py-4 @if($notification->is_read1 === 0 || $notification->is_read2 === 0) bg-light-primary @else bg-none @endif">
                                                    <!--begin::Section-->
                                                    <div class="d-flex flex-column w-100">
                                                        <!-- Notification for Message 1 -->
                                                        @if($notification->message1)
                                                            <a href="{{ route('notifications.markReadPD', [$notification->id, 'message1']) }}"
                                                            class="fs-6 text-gray-800 text-hover-primary ">
                                                                <p>{{ $notification->message1 }}</p>
                                                            </a>
                                                        @endif
                                        
                                                        <!-- Notification for Message 2 -->
                                                        @if($notification->message2)
                                                            <a href="{{ route('notifications.markReadPD', [$notification->id, 'message2']) }}"
                                                            class="fs-6 text-gray-800 text-hover-primary">
                                                                <p>{{ $notification->message2 }}</p>
                                                            </a>
                                                        @endif

                                                        <!-- Timestamp aligned to the right -->
                                                        <div class="d-flex justify-content-end">
                                                            <span class="badge badge-light text-primary fs-8 mt-2">{{ $notification->created_at->locale('ms')->diffForHumans() }}</span>
                                                        </div>
                                                    </div>
                                                    <!--end::Section-->
                                                </div>
                                                <!--end::Item-->
                                            @endforeach
                                        </div>
                                        <!--end::Items-->

                                        <!--begin::View more-->
                                        <div class="py-3 text-center border-top">
                                            <a href="{{ route('notifications.fetchNotificationsPD') }}" class="btn btn-color-gray-600 btn-hover-primary">
                                                Lihat Semua
                                                <i class="ki-duotone ki-arrow-right fs-5">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            </a>
                                        </div>
                                        <!--end::View more-->
                                    </div>
                                    <!--end::Tab panel-->
                                </div>
                                <!--end::Tab content-->
                            @else
                                <p style="text-align: center; padding-top:10px;">Tiada notifikasi untuk klien ini.</p>
                            @endif
                        </div>
                        <!--end::Menu-->
                        <!--end::Menu wrapper-->
                    </div>
                @endif

                <!--begin::User menu-->
                <div class="app-navbar-item ms-1 ms-md-4" id="kt_header_user_menu_toggle">
                    <div class="cursor-pointer symbol symbol-35px symbol-2by3 fs-4" data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end" style="font-weight: bold; color:white;">
                        @if(Auth::user()->tahap_pengguna != 2)
                            @if(Auth::user()->gambar_profil)
                                <img src="{{ asset('assets/gambar_profil/' . Auth::user()->gambar_profil) }}" alt="Gambar" class="profile-picture" />
                                {{ strtoupper(Auth::user()->name) }}
                            @else
                                <i class="fa fa-user" style="color: white; padding-right:10px; font-size:16px;"></i>
                                {{ strtoupper(Auth::user()->name) }}
                            @endif
                        @else
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

                                <!--begin::Username-->
                                <div class="d-flex flex-column">
                                    <div class="fw-bold d-flex align-items-center fs-6">{{Auth::user()->name}}</div>
                                    <a href="#" class="fw-semibold text-muted text-hover-primary fs-8">{{ Auth::user()->email }}</a>
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
                            <a href="{{route('profile.edit')}}" class="menu-link px-5">Profil Pengguna</a>
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
                </div>
                <!--end::User menu-->
            </div>
            <!--end::Navbar-->
        </div>
        <!--end::Header wrapper-->
    </div>
    <!--end::Header container-->
</div>
