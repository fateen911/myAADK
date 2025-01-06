@extends('layouts._default')

@section('content')
    <head>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/datetime/1.5.1/js/dataTables.dateTime.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">

        <style>
            .notification-item {
                font-family: 'Arial', sans-serif;
                line-height: 1.6;
            }
        
            .notification-item p {
                margin: 0;
            }
        
            .notification-date-time {
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
                    <a href="../../demo1/dist/index.html" class="text-muted text-hover-primary">Senarai Notifikasi</a>
                </li>
                <!--end::Item-->
            </ul>
            <!--end::Breadcrumb-->
        </div>
        <!--end::Page title-->

        <!--begin::Content-->
        <div id="kt_app_content" class="app-content flex-column-fluid d-flex justify-content-center align-items-center">
            <!--begin::Content container-->
            <div id="kt_app_content_container" class="app-container container-xxl" style="width: 80%;">
                <div class="card mb-5 mb-xl-10">
                    <!--begin::Card header-->
                    <div class="card-header border-0" style="background-color: #363062;">
                        <div class="card-title m-0">
                            <h3 class="fw-bold m-0" style="color: white;">Semua Notifikasi Anda</h3>
                        </div>
                    </div>
                    <!--end::Card header-->
        
                    <!--begin::Notifications List-->
                    <div class="card-body">
                        <div class="list-group">
                            @forelse($notifications as $notification)
                                <div class="list-group-item @if(!$notification->is_read) bg-light-primary @else bg-none @endif">
                                    <div class="notification-item">
                                        <!-- Notification status and date/time in the same row -->
                                        <div style="display: flex; justify-content: space-between; align-items: center;">
                                            <!-- Left: Status -->
                                            <a href="{{ route('notifications.markRead', $notification->id) }}" class="fs-5 text-black text-hover-primary fw-bold">{{ $notification->status }}</a>
                                            
                                            <!-- Right: Created date and time -->
                                            <p class="notification-date-time" style="font-size: 0.9rem;">
                                                {{ $notification->created_at->format('d/m/Y h:i A') }}
                                            </p>
                                        </div>
                    
                                        <!-- Notification message -->
                                        @php
                                            // Split the message at the word "Alasan" if it exists
                                            $message_parts = explode('Alasan:', $notification->message);
                                        @endphp
                    
                                        <!-- First part is the main message -->
                                        <p style="font-size: 1rem;">
                                            {{ $message_parts[0] }}
                                        </p>
                    
                                        <!-- If there is an 'Alasan' part, we display it -->
                                        @if(count($message_parts) > 1)
                                            <p style="font-style: italic; margin-top: 0.5rem;">
                                                <strong>Alasan:</strong>
                                                <ul style="padding-left: 50px;">
                                                    @foreach(explode(',', trim($message_parts[1])) as $reason)
                                                        <li>{{ trim($reason) }}</li>
                                                    @endforeach
                                                </ul>
                                            </p>
                                        @endif
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
            <!--end::Content container-->
        </div>    
        <!--end::Content-->

        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

        <script>
           document.querySelectorAll('.dropdown-item').forEach(item => {
                item.addEventListener('click', function (e) {
                    e.preventDefault();
                    let notificationId = this.getAttribute('data-id');
                    fetch(`/notifikasi/${notificationId}`, {
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
