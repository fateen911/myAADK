@extends('layouts._default')

@section('content')
    <head>
        <!-- Custom AADK CSS -->
		<link rel="stylesheet" href="/assets/css/customAADK.css">
        <script src="/assets/lang/Malay.json"></script>

        <style>
            #kt_app_content_container {
                width: 90% !important;
            }

            .notification-item {
                font-family: 'Arial', sans-serif;
                line-height: 1.6;
            }
        
            .notification-item p {
                margin: 0;
            }
        
            .notification-date-time {
                font-size: 0.9rem; 
                padding-left: 40px;
                color: #666;
            }
        
            .notification-item ul {
                margin: 0;
                padding-left: 20px;
            }
        
            .notification-item ul li {
                list-style-type: none;
                position: relative;
                padding-left: 15px;
            }
        
            .notification-item ul li:before {
                content: "\2022";
                position: absolute;
                left: 0;
                color: #363062;
            }

            @media (max-width: 768px) {
                #kt_app_content_container {
                    width: 100% !important;
                    padding: 0 !important;
                }

                .list-group-item {
                    display: flex;
                    flex-direction: column;
                    align-items: flex-start;
                    padding: 10px;
                }

                .notification-item {
                    display: flex;
                    flex-direction: column; /* Stack messages and date vertically */
                    width: 100%;
                }

                .notification-item > div {
                    display: flex;
                    flex-direction: column; /* Make child items stack vertically */
                    width: 100%;
                }

                .notification-item a {
                    width: 100%;
                    font-size: 1rem; /* Adjust text size for better readability */
                    margin-bottom: 5px; /* Add spacing between message and date */
                }

                .notification-date-time {
                    font-size: 0.85rem; /* Slightly smaller text for dates */
                    color: #666; /* Subtle text color */
                    text-align: left; /* Align date to the left */
                    width: 100%; /* Ensure date takes full width */
                    white-space: nowrap; /* Prevent line breaks for the date and time */
                }
            }
        </style>
    </head>

    <body>
        <!--begin::Page title-->
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 mb-5">
            <!--begin::Title-->
            <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Notifikasi</h1>
            <!--end::Title-->
            <!--begin::Breadcrumb-->
            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                <!--begin::Item-->
                <li class="breadcrumb-item text-muted">
                    <a href="../../demo1/dist/index.html" class="text-muted text-hover-primary">Notifikasi</a>
                </li>
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-400 w-5px h-2px"></span>
                </li>
                <li class="breadcrumb-item text-muted">Semua Notifikasi</li>
                <!--end::Item-->
            </ul>
            <!--end::Breadcrumb-->
        </div>
        <!--end::Page title-->

        <!--begin::Content-->
        <div id="kt_app_content" class="app-content flex-column-fluid d-flex justify-content-center align-items-center">
            <!--begin::Content container-->
            <div id="kt_app_content_container" class="app-container container-xxl">
                <div class="card mb-xl-10">
                    <!--begin::Card header-->
                    <div class="card-header border-0" style="background-color: #363062;">
                        <div class="card-title m-0">
                            <h3 class="fw-bold m-0" style="color: white;">Semua Notifikasi</h3>
                        </div>
                    </div>
                    <!--end::Card header-->

                    <!--begin::Notifications List-->
                    <div class="card-body">
                        <div class="list-group">
                            @forelse($notifications as $notification)
                                <div class="list-group-item @if($notification->is_read1 === 0 || $notification->is_read2 === 0) bg-light-primary @else bg-none @endif">
                                    <div class="notification-item">
                                        <!-- Notification status and date/time in the same row -->
                                        <div style="display: flex; justify-content: space-between; align-items: center;">
                                            <!-- Notification for Message 1 -->
                                            @if($notification->message1)
                                                <a href="{{ route('notifications.markReadPD', [$notification->id, 'message1']) }}"
                                                class="fs-6 text-black text-hover-primary w-80">
                                                    <p>{{ $notification->message1 }}</p>
                                                </a>
                                            @endif
                            
                                            <!-- Notification for Message 2 -->
                                            @if($notification->message2)
                                                <a href="{{ route('notifications.markReadPD', [$notification->id, 'message2']) }}"
                                                class="fs-6 text-black text-hover-primary w-80">
                                                    <p>{{ $notification->message2 }}</p>
                                                </a>
                                            @endif
                            
                                            <!-- Notification Date -->
                                            <p class="notification-date-time w-20">
                                                {{ $notification->created_at->format('d/m/Y h:i A') }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="list-group-item">
                                    <p class="text-center">Tiada notifikasi baharu.</p>
                                </div>
                            @endforelse
                        </div>                        
                    </div>
                    <!--end::Notifications List-->
                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

        <script>
            document.querySelectorAll('.notification-link').forEach(item => {
                item.addEventListener('click', function (e) {
                    e.preventDefault();
                    const notificationId = this.getAttribute('data-id');
                    const messageType = this.getAttribute('data-message');

                    fetch(`/pegawai-daerah/notifikasi/${notificationId}/${messageType}`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        }
                    }).then(response => {
                        if (response.ok) {
                            this.classList.add('read');
                        }
                    });
                });
            });
        </script>
    </body>
@endsection

