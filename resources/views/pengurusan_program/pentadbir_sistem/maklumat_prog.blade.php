@extends('layouts._default')

@section('content')
    <head>
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
        <!-- Custom AADK CSS -->
        <link rel="stylesheet" href="/assets/css/customAADK.css">
        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <!-- Bootstrap JS -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <style>
            .btn-icon {
                display: flex;
                justify-content: center;
                align-items: center;
            }
            .d-none {
                display: none;
            }
        </style>
    </head>

    <!--begin::Page title-->
    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 mb-5">
        <!--begin::Title-->
        <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Pengurusan</h1>
        <!--end::Title-->
        <!--begin::Breadcrumb-->
        <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
            <!--begin::Item-->
            <li class="breadcrumb-item text-muted">Pengurusan</li>
            <!--end::Item-->
            <!--begin::Item-->
            <li class="breadcrumb-item">
                <span class="bullet bg-gray-400 w-5px h-2px"></span>
            </li>
            <!--end::Item-->
            <!--begin::Item-->
            <li class="breadcrumb-item text-muted">Maklumat Aktiviti</li>
            <!--end::Item-->
        </ul>
        <!--end::Breadcrumb-->
    </div>
    <!--end::Page title-->

    <!--begin::Body-->
    <div class="my-10 mx-w-300">
        <!--begin:::Tabs-->
        <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-semibold mb-n2 ">
            <!--begin:::Tab item-->
            <li class="nav-item">
                <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab" href="#kt_ecommerce_add_product_general">Maklumat Umum</a>
            </li>
            <!--end:::Tab item-->
            <!--begin:::Tab item-->
            <li class="nav-item">
                <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab" href="#kt_ecommerce_add_product_advanced">Maklum Balas Kehadiran</a>
            </li>
            <!--end:::Tab item-->
            @if($program->status != "BELUM SELESAI" && $program->status != "PINDA"  && $program->status != "BATAL")
                <!--begin:::Tab item-->
                <li class="nav-item">
                    <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab" href="#kt_ecommerce_add_product_reviews">Kehadiran</a>
                </li>
                <!--end:::Tab item-->
            @endif
        </ul>
        <!--end:::Tabs-->
    </div>

    <!--begin::Tab content-->
    <div class="tab-content mx-w-300">
        <!--begin::Tab pane-->
        <div class="tab-pane fade show active" id="kt_ecommerce_add_product_general" role="tab-panel">
            <!--begin::Content container-->
            <form id="kt_ecommerce_add_category_form" class="form d-flex flex-column flex-lg-row" data-kt-redirect="../../demo1/dist/apps/ecommerce/catalog/categories.html">
                <!--begin::Aside column-->
                <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10 h-600px">
                    <!--begin::QR code settings-->
                    <div class="card card-flush py-4">
                        <!--begin::Card header-->
                        <div class="card-header">
                            {{--                    <a href="#" class="btn btn-sm btn-bg-light btn-active-color-primary me-3" data-bs-toggle="modal" data-bs-target="#kt_modal_users_search">Zoom</a>--}}
                            <!--begin::Card title-->
                            <div class="card-title">
                                <h2>Kod QR</h2>
                            </div>
                            <!--end::Card title-->
                            <!--begin::Big QR-->
                            <div class="card-title">
                                <button type="button" id="modal_1" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_maklumat">
                                    <i class="ki-solid bi-arrows-angle-expand"></i>
                                </button>
                            </div>
                            <!--end::Big QR-->
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body text-center pt-0 text-center-range">
                            <!--begin::Image input-->
                            {!! QrCode::size(200)->generate($program->pautan_pengesahan); !!}
                            <!--end::Image input-->
                            <br><br>
                            <!--begin::Link-->
                            <div class="form-group d-flex flex-wrap align-items-center gap-2">
                                <input type="text" id="link_1" name="product_name" class="form-control mw-100 w-185px" placeholder="Link" value="{{$program->pautan_pengesahan}}" disabled/>
                                <button type="button" class="btn btn-sm btn-icon btn-light-dark" id="clipboard1">
                                    <i class="bi bi-clipboard-fill fs-2"></i>
                                </button>
                            </div>
                            <!--end::Link-->
                        </div>
                        <input type="hidden" id="programId" value="{{$program->id}}">
                        <!--end::Card body-->
                        <!--begin::Card body-->
                        <div class="card-body pt-2 text-center-range">
                            <!--begin::Share-->
                            <b class="fs-5">Hebahan:</b> &nbsp;
                            <!--end::Share-->
                            <!--begin::Share to-->
                                <button type="button" id="emel" class="btn btn-icon btn-danger mx-1 btn-sm" data-toggle="modal" data-target="#hebahanEmel" data-id="{{$program->id}}"><i class="bi bi-envelope-fill fs-3"></i></button>
                            <!--end::Share to-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::QR code settings-->
                    <!--begin::Status-->
                    <div class="card card-flush py-0">
                        <!--begin::Card header-->
                        <div class="card-header">
                            <!--begin::Card title-->
                            <div class="card-title">
                                <h2>Status</h2>
                            </div>
                            <!--end::Card title-->
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body pt-0">
                            @if($program->status == 'BELUM SELESAI')
                                <p class="badge badge-light-primary text-royalblue fs-6 fw-bold">{{$program->status}}</p>
                            @elseif($program->status == 'SEDANG BERLANGSUNG')
                                <p class="badge badge-light-warning text-darkorange fs-6 fw-bold">{{$program->status}}</p>
                            @elseif($program->status == 'SELESAI')
                                <p class="badge badge-light-success text-seagreen fs-6 fw-bold">{{$program->status}}</p>
                            @elseif($program->status == 'PINDA')
                                <p class="badge badge-light-yellow text-darkyellow fs-6 fw-bold">{{$program->status}}</p>
                            @elseif($program->status == 'BATAL')
                                <p class="badge badge-light-red text-darkred fs-6 fw-bold">{{$program->status}}</p>
                            @endif
                            <br>
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Status-->

                </div>
                <!--end::Aside column-->
                <!--begin::Main column-->
                <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10 w-820px">
                    <!--begin::Umum options-->
                    <div class="card card-flush py-4">
                        <!--begin::Card header-->
                        <div class="card-header">
                            <div class="card-title">
                                <h2>Maklumat Aktiviti</h2>
                            </div>
                            @if($program->status == "BELUM SELESAI" || $program->status == "PINDA")
                                <div class="card-title">
                                    <a href="{{url('/pengurusan-program/pentadbir-sistem/kemaskini-prog/'.$program->id)}}" class="btn btn-sm btn-primary btn-active-secondary">
                                        Kemaskini &nbsp; <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <a href="{{url('/pengurusan-program/pentadbir-sistem/batal-prog/'.$program->id)}}" id="batal" data-link="{{url('/pengurusan-program/pentadbir-sistem/batal-prog/'.$program->id)}}" class="btn btn-sm btn-danger btn-active-secondary">
                                        Batal <i class="bi bi-trash3-fill"></i>
                                    </a>
                                </div>
                            @endif
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body pt-0">
                            <!--begin::Input group-->
                            <div class="mb-6 fv-row">
                                <label class="form-label">Nama Aktiviti:</label>
                                <p class="text-bg-light p-3 rounded border-bottom border-secondary text-uppercase">{{$program->nama}}</p>
                            </div>
                            <!--end::Input group-->

                            <!--begin::Input group-->
                            <div class="mb-6 fv-row">
                                <label class="form-label">Kategori:</label>
                                <p class="text-bg-light p-3 rounded border-bottom border-secondary">{{$program->kategori->nama}}</p>
                            </div>
                            <!--end::Input group-->

                            <!--begin::Input group-->
                            <div class="mb-6 fv-row">
                                <label class="form-label">Objektif Aktiviti:</label>
                                <div class="text-bg-light p-3 rounded border-bottom border-secondary">{!!$program->objektif!!}</div>
                            </div>
                            <!--end::Input group-->
                            <div class="form d-flex flex-column flex-lg-row">
                                <div class="d-flex flex-column flex-row-fluid w-100 w-lg-350px me-lg-10">
                                    <!--begin::Input group-->
                                    <div class="mb-2 fv-row">
                                        <label class="form-label">Tarikh & Masa Mula:</label>
                                        <p class="text-bg-light p-3 rounded border-bottom border-secondary">{{date('d/m/Y, h:iA', strtotime($program->tarikh_mula))}}</p>
                                    </div>
                                    <!--end::Input group-->
                                </div>
                                <div class="d-flex flex-column flex-row-fluid w-100 w-lg-350px">
                                    <!--begin::Input group-->
                                    <div class="mb-2 fv-row">
                                        <label class="form-label">Tarikh & Masa Tamat:</label>
                                        <p class="text-bg-light p-3 rounded border-bottom border-secondary">{{date('d/m/Y, h:iA', strtotime($program->tarikh_tamat))}}</p>
                                    </div>
                                    <!--end::Input group-->
                                </div>
                            </div>
                            <!--end::Input group-->

                            <!--begin::Input group-->
                            <div class="mb-6 fv-row">
                                <label class="form-label">Tempat Aktiviti:</label>
                                <p class="text-bg-light p-3 rounded border-bottom border-secondary text-uppercase">{{$program->tempat}}</p>
                            </div>
                            <!--end::Input group-->

                            <!--begin::Input group-->
                            <div class="mb-6 fv-row">
                                <label class="form-label">Penganjur Aktiviti:</label>
                                <p class="text-bg-light p-3 rounded border-bottom border-secondary text-uppercase">
                                    @if($program->penganjur!=null)
                                        {{$program->penganjur}}
                                    @else
                                        TIADA
                                    @endif
                                </p>
                            </div>
                            <!--end::Input group-->

                            <!--begin::Input group-->
                            <div class="form d-flex flex-column flex-lg-row">
                                <div class="d-flex flex-column flex-row-fluid w-100 w-lg-350px me-lg-10">
                                    <!--begin::Input group-->
                                    <div class="mb-2 fv-row">
                                        <label class="form-label">Nama Pegawai:</label>
                                        <p class="text-bg-light p-3 rounded border-bottom border-secondary text-uppercase">{{$program->nama_pegawai}}</p>
                                    </div>
                                    <!--end::Input group-->
                                </div>
                                <div class="d-flex flex-column flex-row-fluid w-100 w-lg-350px">
                                    <!--begin::Input group-->
                                    <div class="mb-2 fv-row">
                                        <label class="form-label">No. Telefon Untuk Dihubungi:</label>
                                        <p class="text-bg-light p-3 rounded border-bottom border-secondary">{{$program->no_tel_dihubungi}}</p>
                                    </div>

                                </div>
                            </div>
                            <!--end::Input group-->

                            <!--begin::Input group-->
                            <div class="mb-6 fv-row">
                                <!--begin::Label-->
                                <label class="form-label">Catatan:</label>
                                <!--end::Label-->
                                <div class="text-bg-light p-3 rounded border-bottom border-secondary">
                                    @php
                                        // Strip HTML tags and trim whitespace
                                        $cleanMessage = trim(strip_tags($program->catatan));
                                    @endphp

                                    @if($cleanMessage === "")
                                        TIADA
                                    @else
                                        {!!$program->catatan!!}
                                    @endif
                                </div>
                            </div>
                            <!--end::Input group-->
                        </div>
                        <!--end::Card header-->
                    </div>
                    <!--end::Umum options-->
                </div>
                <!--end::Main column-->
            </form>
        </div>
        <!--end::Tab pane-->

        <!--begin::Tab pane pengesahan-->
        <div class="tab-pane fade" id="kt_ecommerce_add_product_advanced" role="tab-panel">
            <form id="kt_ecommerce_add_category_form" class="form d-flex flex-column flex-lg-row" data-kt-redirect="../../demo1/dist/apps/ecommerce/catalog/categories.html">
                <!--begin::Aside column-->
                <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10 h-400px">
                    <!--begin::QR code settings-->
                    <div class="card card-flush py-4">
                        <!--begin::Card header-->
                        <div class="card-header">
                            {{--                    <a href="#" class="btn btn-sm btn-bg-light btn-active-color-primary me-3" data-bs-toggle="modal" data-bs-target="#kt_modal_users_search">Zoom</a>--}}
                            <!--begin::Card title-->
                            <div class="card-title">
                                <h2>Kod QR</h2>
                            </div>
                            <!--end::Card title-->
                            <!--begin::Big QR-->
                            <div class="card-title">
                                <button type="button" id="modal_2" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_pengesahan">
                                    <i class="ki-solid bi-arrows-angle-expand"></i>
                                </button>
                            </div>
                            <!--end::Big QR-->
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body text-center pt-0 text-center-range">
                            <!--begin::Image input-->
                            {!! QrCode::size(200)->generate($program->pautan_pengesahan); !!}
                            <!--end::Image input-->
                            <br><br>
                            <!--begin::Link-->
                            <div class="form-group d-flex flex-wrap align-items-center gap-2">
                                <input type="text" id="link_2" name="product_name" class="form-control mw-100 w-185px" placeholder="Link" value="{{$program->pautan_pengesahan}}" disabled/>
                                <button type="button" class="btn btn-sm btn-icon btn-light-dark" id="clipboard2">
                                    <i class="bi bi-clipboard-fill fs-2"></i>
                                </button>
                            </div>
                            <!--end::Link-->
                        </div>
                        <!--end::Card body-->
                        <!--begin::Card body-->
                        <div class="card-body pt-2 text-center-range">
                            <!--begin::Share-->
                            <b class="fs-5">Hebahan:</b> &nbsp;
                            <!--end::Share-->
                            <!--begin::Share to-->
                            <a id="emel" class="btn btn-icon btn-danger mx-1 btn-sm" data-toggle="modal" data-target="#hebahanEmel" data-id="{{$program->id}}"><i class="bi bi-envelope-fill fs-3"></i></a>
                            <!--end::Share to-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::QR code settings-->

                </div>
                <!--end::Aside column-->
                <div class="d-flex flex-column gap-7 gap-lg-10 w-md-700px w-lg-800px mx-w-300 mt-20 mt-lg-0">
                    <!--begin::Card-->
                    <div class="row g-4 text-center mb-0">
                        <!--begin::Col-->
                        <div class="col-4">
                            <!--begin::Items-->
                            <div class="px-6 pt-5 card-rounded h-140px w-100 card theme-dark-bg-body bg-steelblue">
                                <!--begin::Symbol-->
                                <div class="symbol symbol-30px me-0 mb-5">
                                    <i class="fas bi bi-list-task text-light" style="font-size: 20px;">
                                        <span class="fw-semibold me-1 align-self-center fs-6 fs-md-2 px-auto" style="padding-bottom: 5px; font-family:sans-serif;">Responden</span>
                                    </i>
                                </div>
                                <!--end::Symbol-->
                                <!--begin::Stats-->
                                <div class="m-0">
                                    <span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 keseluruhanIPTS">{{$keseluruhan}}</span>
                                </div>
                                <!--end::Stats-->
                            </div>
                            <!--end::Items-->
                        </div>
                        <!--end::Col-->

                        <!--begin::Col-->
                        <div class="col-4">
                            <!--begin::Items-->
                            <div class="px-6 pt-5 card-rounded h-140px w-100 card theme-dark-bg-body bg-mediumseagreen">
                                <!--begin::Symbol-->
                                <div class="symbol symbol-30px me-0 mb-5">
                                    <i class="fas bi bi-check-circle-fill text-light" style="font-size: 20px;">
                                        <span class="fw-semibold me-1 align-self-center fs-6 fs-md-2 px-auto" style="padding-bottom: 5px; padding-left:5px; font-family:sans-serif;">Hadir</span>
                                    </i>
                                </div>
                                <!--end::Symbol-->
                                <!--begin::Stats-->
                                <div class="m-0">
                                    <span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 derafIPTS">{{$hadir}}</span>
                                </div>
                                <!--end::Stats-->
                            </div>
                            <!--end::Items-->
                        </div>
                        <!--end::Col-->

                        <!--begin::Col-->
                        <div class="col-4">
                            <!--begin::Items-->
                            <div class="px-6 pt-5 card-rounded h-140px w-100 card theme-dark-bg-body bg-palevioletred">
                                <!--begin::Symbol-->
                                <div class="symbol symbol-30px me-0 mb-5">
                                    <i class="fas bi bi-x-circle-fill text-light" style="font-size: 20px;">
                                        <span class="fw-semibold me-1 align-self-center fs-6 fs-md-2 px-auto" style="padding-bottom: 5px; font-family:sans-serif;">Tidak Hadir</span>
                                    </i>
                                </div>
                                <!--end::Symbol-->
                                <!--begin::Stats-->
                                <div class="m-0">
                                    <span class="text-white fw-bolder d-block fs-4x lh-1 ls-n1 keseluruhanIPTS">{{$tdk_hadir}}</span>
                                </div>
                                <!--end::Stats-->
                            </div>
                            <!--end::Items-->
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Card-->
                    <!--begin::Senarai Pengesahan-->
                    <div class="card card-flush py-4">
                        <!--begin::Card header-->
                        <div class="card-header">
                            <div class="card-title">
                                <h2>Senarai Pengesahan Kehadiran</h2>
                            </div>
                            <div class="card-title">
                                <a href="{{url('/pengurusan-program/pdf-pengesahan/'.$program->id)}}" class="btn btn-sm btn-danger btn-active-color-danger">
                                    PDF &nbsp; <i class="bi bi-file-pdf"></i>
                                </a>
                                <a href="{{url('/pengurusan-program/excel-pengesahan/'.$program->id)}}" class="btn btn-sm btn-success btn-active-color-success">
                                    Excel &nbsp; <i class="bi bi-file-earmark-spreadsheet"></i>
                                </a>
                            </div>
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body pt-0 table-responsive mx-10">
                            <!--begin::Table-->
                            <table class="table table-row-dashed fs-6 gy-5 my-0" id="pengesahanTable">
                                <thead>
                                <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                    <th class="min-w-125px">Nama</th>
                                    <th class="min-w-175px">No. Kad Pengenalan</th>
                                    <th class="min-w-175px">No. Telefon</th>
                                    <th class="min-w-175px">Pengesahan</th>
                                    <th class="min-w-175px">Negeri</th>
                                    <th class="min-w-175px">Daerah</th>
                                    <th class="min-w-175px">Catatan</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>Tiada</td>
                                    <td>Tiada</td>
                                    <td>Tiada</td>
                                    <td>Tiada</td>
                                    <td>Tiada</td>
                                    <td>Tiada</td>
                                    <td>Tiada</td>
                                </tr>
                                </tbody>
                            </table>
                            <!--end::Table-->
                        </div>
                        <!--end::Card header-->
                    </div>
                    <!--end::Senarai Pengesahan-->
                </div>
            </form>
        </div>
        <!--end::Tab pane pengesahan-->

        @if($program->status != "BELUM SELESAI")
            <!--begin::Tab pane perekodan-->
            <div class="tab-pane fade" id="kt_ecommerce_add_product_reviews" role="tab-panel">
                <form id="kt_ecommerce_add_category_form" class="form d-flex flex-column flex-lg-row" action="{{url('/pengurusan-program/klien/post-daftar-kehadiran-2/'.$program->id)}}" method="POST">
                    <!--begin::Aside column-->
                    @csrf
                    <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10 h-400px">
                        <!--begin::QR code settings-->
                        <div class="card card-flush py-4">
                            <!--begin::Card header-->
                            <div class="card-header">
                                {{--                    <a href="#" class="btn btn-sm btn-bg-light btn-active-color-primary me-3" data-bs-toggle="modal" data-bs-target="#kt_modal_users_search">Zoom</a>--}}
                                <!--begin::Card title-->
                                <div class="card-title">
                                    <h2>Kod QR</h2>
                                </div>
                                <!--end::Card title-->
                                <!--begin::Big QR-->
                                <div class="card-title">
                                    <button type="button" id="modal_3" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_perekodan">
                                        <i class="ki-solid bi-arrows-angle-expand"></i>
                                    </button>
                                </div>
                                <!--end::Big QR-->
                            </div>
                            <!--end::Card header-->
                            <!--begin::Card body-->
                            <div class="card-body text-center pt-0 text-center-range">
                                <!--begin::Image input-->
                                {!! QrCode::size(200)->generate($program->pautan_perekodan); !!}
                                <!--end::Image input-->
                                <br><br>
                                <!--begin::Link-->
                                <div class="form-group d-flex flex-wrap align-items-center gap-2">
                                    <input type="text" id="link_3" name="product_name" class="form-control mw-100 w-185px" placeholder="Link" value="{{$program->pautan_perekodan}}" disabled/>
                                    <button type="button" class="btn btn-sm btn-icon btn-light-dark" id="clipboard3">
                                        <i class="bi bi-clipboard-fill fs-2"></i>
                                    </button>
                                </div>
                                <!--end::Link-->
                            </div>
                            <!--end::Card body-->
                            <!--begin::Card body-->
                            {{--                        <div class="card-body pt-4">--}}
                            {{--                            <!--begin::Share-->--}}
                            {{--                            <b class="fs-5">Hebahan:</b> &nbsp;--}}
                            {{--                            <!--end::Share-->--}}
                            {{--                            <!--begin::Share to-->--}}
                            {{--                            <a href="{{ url('/pengurusan-program/hebahan/sms') }}" class="btn btn-icon btn-warning mx-1 btn-sm" id="share-button"><i class="bi bi-chat-dots-fill fs-3"></i></a>--}}
                            {{--                            <a href="{{ url('/pengurusan-program/hebahan/emel') }}" class="btn btn-icon btn-danger mx-1 btn-sm" id="share-button"><i class="bi bi-envelope-fill fs-3"></i></a>--}}
                            {{--                            <a href="{{ url('/pengurusan-program/hebahan/telegram') }}" class="btn btn-icon btn-primary mx-1 btn-sm" id="share-button"><i class="bi bi-telegram fs-3"></i></a>--}}
                            {{--                            <!--end::Share to-->--}}
                            {{--                        </div>--}}
                            <!--end::Card body-->
                        </div>
                        <!--end::QR code settings-->
                    </div>
                    <!--end::Aside column-->
                    <div class="d-flex flex-column gap-7 gap-lg-10 w-lg-800px mx-w-300">
                        @if($program->status != "BELUM SELESAI")
                        <!--begin::Rekod Kehadiran-->
                        <div class="card card-flush py-4">
                            <!--begin::Card header-->
                            <div class="card-header">
                                <div class="card-title">
                                    <h2>Rekod Kehadiran</h2>
                                </div>
                            </div>
                            <!--end::Card header-->
                            <!--begin::Card body-->
                            <div class="card-body pt-0">
                                <!--begin::Input group-->
                                <div class="mb-6 fv-row">
                                    @csrf
                                    <!--begin::Label-->
                                    <label class="form-label">No. Kad Pengenalan</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="number" name="no_kp" class="form-control mb-2" placeholder="No. Kad pengenalan" value="960101054554" />
                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="mb-6 fv-row">
                                    <button type="submit" id="perekodanBtn" class="btn btn-primary">
                                        <span class="indicator-label">Hadir</span>
                                        <span class="indicator-progress">Tunggu sebentar...
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                    </button>
                                </div>
                                <!--end::Input group-->
                            </div>
                            <!--end::Card header-->
                        </div>
                        <!--end::Rekod Kehadiran-->
                        @endif
                        <!--begin::Senarai kehadiran-->
                        <div class="card card-flush py-4">
                            <!--begin::Card header-->
                            <div class="card-header">
                                <!--begin::Card title-->
                                <div class="card-title">
                                    <h2>Senarai Klien Yang Hadir</h2>
                                </div>
                                <div class="card-title">
                                    <a href="{{url('/pengurusan-program/pdf-perekodan/'.$program->id)}}" class="btn btn-sm btn-danger btn-active-color-danger">
                                        PDF &nbsp; <i class="bi bi-file-pdf"></i>
                                    </a>
                                    <a href="{{url('/pengurusan-program/excel-perekodan/'.$program->id)}}" class="btn btn-sm btn-success btn-active-color-success">
                                        Excel &nbsp; <i class="bi bi-file-earmark-spreadsheet"></i>
                                    </a>
                                </div>
                                <!--end::Card title-->
                            </div>
                            <!--end::Card header-->
                            <!--begin::Card body-->
                            <div class="card-body pt-0 table-responsive mx-10">
                                <!--begin::Table-->
                                <table class="table table-row-dashed fs-6 gy-5 my-0" id="perekodanTable">
                                    <thead>
                                    <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                        <th class="min-w-125px">Nama</th>
                                        <th class="min-w-175px">No. Kad Pengenalan</th>
                                        <th class="min-w-175px">Tarikh/Masa</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Tiada</td>
                                            <td>Tiada</td>
                                            <td>Tiada</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <!--end::Table-->
                            </div>
                            <!--end::Card body-->
                        </div>
                        <!--end::Senarai kehadiran-->
                    </div>
                </form>
            </div>
        @endif
        <!--end::Tab pane perekodan-->
    </div>
    <!--end::Main column-->

    <!--begin::Modal - maklumat-->
    <div class="modal fade" id="kt_modal_maklumat" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-lg-750px mw-r-650 mw-350px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Modal header-->
                <div class="modal-header pb-0 border-0 justify-content-end">
                    <!--begin::Close-->
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                        <i class="ki-duotone bi bi-x-lg fs-1"></i>
                    </div>
                    <!--end::Close-->
                </div>
                <!--begin::Modal header-->
                <!--begin::Modal body-->
                <div class="modal-body scroll-y mx-5 mx-xl-18 pt-0 pb-15" id="qr-code">
                    <!--begin::Content-->
                    <!--begin::Image input-->
                    {!! QrCode::size(570)->generate($program->pautan_pengesahan); !!}
                    <!--end::Image input-->
                    <!--end::Search-->
                </div>
                <!--end::Modal body-->
            </div>
            <!--end::Modal content-->
        </div>
        <!--end::Modal dialog-->
    </div>

    <!--end::Modal - maklumat-->

    <!--begin::Modal - pengesahan-->
    <div class="modal fade" id="kt_modal_pengesahan" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-lg-750px mw-r-650 mw-350px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Modal header-->
                <div class="modal-header pb-0 border-0 justify-content-end">
                    <!--begin::Close-->
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                        <i class="ki-duotone bi bi-x-lg fs-1"></i>
                    </div>
                    <!--end::Close-->
                </div>
                <!--begin::Modal header-->
                <!--begin::Modal body-->
                <div class="modal-body scroll-y mx-5 mx-xl-18 pt-0 pb-15" id="qr-code-2">
                    <!--begin::Content-->
                    <!--begin::Image input-->
                    {!! QrCode::size(570)->generate($program->pautan_pengesahan); !!}
                    <!--end::Image input-->
                    <!--end::Search-->
                </div>
                <!--end::Modal body-->
            </div>
            <!--end::Modal content-->
        </div>
        <!--end::Modal dialog-->
    </div>
    <!--end::Modal - pengesahan-->

    <!--begin::Modal - perekodan-->
    <div class="modal fade" id="kt_modal_perekodan" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-lg-750px mw-r-650 mw-350px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Modal header-->
                <div class="modal-header pb-0 border-0 justify-content-end">
                    <!--begin::Close-->
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                        <i class="ki-duotone bi bi-x-lg fs-1"></i>
                    </div>
                    <!--end::Close-->
                </div>
                <!--begin::Modal header-->
                <!--begin::Modal body-->
                <div class="modal-body scroll-y mx-5 mx-xl-18 pt-0 pb-15" id="qr-code-3">
                    <!--begin::Content-->
                    <!--begin::Image input-->
                    {!! QrCode::size(570)->generate($program->pautan_perekodan); !!}
                    <!--end::Image input-->
                    <!--end::Search-->
                </div>
                <!--end::Modal body-->
            </div>
            <!--end::Modal content-->
        </div>
        <!--end::Modal dialog-->
    </div>
    <!--end::Modal - perekodan-->

    <!--begin::Modal - hebahan-->
    <!--SMS-->
    <div class="modal fade modal-lg" id="hebahanSms" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">HEBAHAN AKTIVITI</h5>
                    <button type="button" class="close border-0 bg-transparent" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="bi bi-x-lg"></i>
                    </button>
                </div>

                <div class="modal-body" id="modalBodySms">

                </div>

            </div>
        </div>
    </div>

    <!--Email-->
    <div class="modal fade modal-lg" id="hebahanEmel" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">HEBAHAN AKTIVITI</h5>
                    <button type="button" class="close border-0 bg-transparent" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="bi bi-x-lg"></i>
                    </button>
                </div>

                <div class="modal-body" id="modalBodyEmel">

                </div>

            </div>
        </div>
    </div>

    <!--Telegram-->
    <div class="modal fade modal-lg" id="hebahanTelegram" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">HEBAHAN AKTIVITI</h5>
                    <button type="button" class="close border-0 bg-transparent" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="bi bi-x-lg"></i>
                    </button>
                </div>

                <div class="modal-body" id="modalBodyTelegram">

                </div>

            </div>
        </div>
    </div>
    <!--end::Modal - hebahan-->

    <!--begin::Javascript-->

    <script>
        $(document).on('click', '#clipboard1', function() {
            // Get the text field
            var copyText = document.getElementById('link_1');

            // Select the text field
            copyText.select();
            copyText.setSelectionRange(0, 99999); // For mobile devices

            // Copy the text inside the text field
            navigator.clipboard.writeText(copyText.value);

            // Alert the copied text
            alert("Menyalin teks: " + copyText.value);
        });
        $(document).on('click', '#clipboard2', function() {
            // Get the text field
            var copyText = document.getElementById('link_2');

            // Select the text field
            copyText.select();
            copyText.setSelectionRange(0, 99999); // For mobile devices

            // Copy the text inside the text field
            navigator.clipboard.writeText(copyText.value);

            // Alert the copied text
            alert("Menyalin teks: " + copyText.value);
        });

        $(document).on('click', '#clipboard3', function() {
            // Get the text field
            var copyText = document.getElementById('link_3');

            // Select the text field
            copyText.select();
            copyText.setSelectionRange(0, 99999); // For mobile devices

            // Copy the text inside the text field
            navigator.clipboard.writeText(copyText.value);

            // Alert the copied text
            alert("Menyalin teks: " + copyText.value);
        });
    </script>

    <script>var hostUrl = "assets/";</script>
    <script src="/assets/plugins/global/plugins.bundle.js"></script>
    <script src="/assets/js/scripts.bundle.js"></script>
    <script src="/assets/plugins/custom/datatables/datatables.bundle.js"></script>
    <script src="/assets/js/custom/apps/customers/list/export.js"></script>
    <script src="/assets/js/custom/apps/customers/list/list.js"></script>
    <script src="/assets/js/custom/apps/customers/add.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <!-- Editor -->
    <script src="assets/js/custom/apps/ecommerce/catalog/save-product.js"></script>
    <!--end::Javascript-->
    <script>
        // Ensure the button does not trigger a form submission or page refresh
        document.getElementById('modal_1').addEventListener('click', function(event) {
            event.preventDefault();
        });

        document.getElementById('modal_2').addEventListener('click', function(event) {
            event.preventDefault();
        });

        document.getElementById('modal_3').addEventListener('click', function(event) {
            event.preventDefault();
        });

    </script>

    <!-- Modal Hebahan -->
    <script>
        <!-- SMS -->
        $(document).on('click', '#sms', function() {
            var id = $(this).data('id');
            $.ajax({
                url: '/pengurusan-program/hebahan/papar-sms/'+ id, // Laravel route with dynamic ID
                method: 'GET',
                success: function(response) {
                    $('#modalBodySms').html(response);
                },
                error: function() {
                    $('#modalBodySms').html('Error loading content.');
                }
            });
        });

        <!-- Emel -->
        $(document).on('click', '#emel', function() {
            var id = $(this).data('id');
            $.ajax({
                url: '/pengurusan-program/hebahan/papar-emel/'+ id, // Laravel route with dynamic ID
                method: 'GET',
                success: function(response) {
                    $('#modalBodyEmel').html(response);
                },
                error: function() {
                    $('#modalBodyEmel').html('Error loading content.');
                }
            });
        });

        <!-- Telegram -->
        $(document).on('click', '#telegram', function() {
            var id = $(this).data('id');
            $.ajax({
                url: '/pengurusan-program/hebahan/papar-telegram/'+ id, // Laravel route with dynamic ID
                method: 'GET',
                success: function(response) {
                    $('#modalBodyTelegram').html(response);
                },
                error: function() {
                    $('#modalBodyTelegram').html('Error loading content.');
                }
            });
        });
    </script>

    <script>
        // JavaScript function to select/deselect all checkboxes
        function toggleAll(source) {
            checkboxes = document.querySelectorAll('input[name="pilihan[]"]');
            for (var i = 0; i < checkboxes.length; i++) {
                checkboxes[i].checked = source.checked;
            }
        }
    </script>

    <!--pengesahan-->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script>
        $(document).ready(function(){
            fetchItems();

            function fetchItems() {
                var id = $('#programId').val();
                $.ajax({
                    url: '/pengesahan/' + id,
                    method: 'GET',
                    success: function(response) {
                        $('#pengesahanTable').DataTable().destroy();
                        let rows = '';
                        $.each(response, function(index, item) {
                            let catatan = item.catatan ? item.catatan : 'Tiada';  // Handle null catatan

                            // Construct table rows with the response data
                            rows += '<tr>';
                            rows += '<td class="text-uppercase">' + item.klien + '</td>';
                            rows += '<td class="text-uppercase">' + item.no_kp + '</td>';
                            rows += '<td class="text-uppercase">' + item.no_tel + '</td>';
                            rows += '<td class="text-uppercase">' + item.keputusan + '</td>';
                            rows += '<td class="text-uppercase">' + item.negeri + '</td>';
                            rows += '<td class="text-uppercase">' + item.daerah + '</td>';
                            rows += '<td>' + catatan + '</td>';
                            rows += '</tr>';
                        });
                        $('#pengesahanTable tbody').html(rows);
                        // Reinitialize DataTable if necessary
                        $('#pengesahanTable').DataTable({
                            ordering: true,
                            order: [],
                            language: {
                                url: "/assets/lang/Malay.json"
                            },
                            dom: '<"row"<"col-sm-12 col-md-6 mt-2 page"l><"col-sm-12 col-md-6 mt-2"f>>' +
                                '<"row"<"col-sm-12 my-0"tr>>' +
                                '<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
                            responsive: true
                        });
                    }
                });
            }
        });
    </script>

    <!--perekodan-->
    <script>
        $(document).ready(function(){
            fetchItems();

            function fetchItems() {
                var id = $('#programId').val();
                $.ajax({
                    url: '/perekodan/' + id,
                    method: 'GET',
                    success: function(response) {
                        $('#perekodanTable').DataTable().destroy();
                        let rows = '';
                        $.each(response, function(index, perekodan) {
                            let formattedDate = moment(perekodan.tarikh_perekodan).format('DD-MM-YYYY HH:mm:ss');
                            rows += '<tr>';
                            rows += '<td class="text-uppercase">' + perekodan.klien.nama + '</td>';
                            rows += '<td class="text-uppercase">' + perekodan.klien.no_kp + '</td>';
                            rows += '<td>' + formattedDate + '</td>';
                            rows += '</tr>';
                        });
                        $('#perekodanTable tbody').html(rows);
                        $('#perekodanTable').DataTable({
                            ordering: true,
                            order: [],
                            language: {
                                url: "/assets/lang/Malay.json"
                            },
                            dom: '<"row"<"col-sm-12 col-md-6 mt-2 page"l><"col-sm-12 col-md-6 mt-2"f>>' +
                                '<"row"<"col-sm-12 my-0"tr>>' +
                                '<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
                            responsive: true
                        });
                    }
                });
            }
        });
    </script>


    <script>
        $('#sortTable1').DataTable({
            ordering: true, // Enable manual sorting
            order: [], // Disable initial sorting
            language: {
                url: "/assets/lang/Malay.json"
            }
        });
    </script>

    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
    </script>

    <script>
        $(document).ready(function()
        {
            // Verify jQuery is loaded
            if (typeof $ !== 'undefined') {
                console.log('jQuery is loaded');
            } else {
                console.log('jQuery is not loaded');
            }

            // Initialize Select2
            $('#tahap_pengguna').select2();

            function toggleJawatanField() {
                var selectedValue = $('#tahap_pengguna').val();
                console.log('Selected value:', selectedValue);

                if (selectedValue == '3' || selectedValue == '4' || selectedValue == '5') {
                    $('#div-jawatan').removeClass('d-none');
                } else {
                    $('#div-jawatan').addClass('d-none');
                }
            }

            // Handle change event
            $('#tahap_pengguna').on('change', function() {
                toggleJawatanField();
            });

            // Initial call to set visibility based on default value
            toggleJawatanField();
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Check if there is a flash message
            @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berjaya!',
                text: '{!! session('success') !!}',
                confirmButtonText: 'OK'
            });
            @endif

            @if(session('success2'))
            Swal.fire({
                icon: 'success',
                title: 'Berjaya!',
                text: '{!! session('success2') !!}',
                confirmButtonText: 'OK'
            });
            @endif

            // Check if there is a flash error message
            @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Tidak Berjaya!',
                text: '{!! session('error') !!}',
                confirmButtonText: 'OK'
            });
            @endif

            @if(session('error2'))
            Swal.fire({
                icon: 'error',
                title: 'Tidak Berjaya!',
                text: '{!! session('error2') !!}',
                confirmButtonText: 'OK'
            });
            @endif
        });
    </script>

    <!--text editor-->
    <script>
        var quill = new Quill('#kt_docs_quill_basic', {
            modules: {
                toolbar: [
                    [{
                        header: [1, 2, false]
                    }],
                    ['bold', 'italic', 'underline'],
                    ['image', 'code-block']
                ]
            },
            placeholder: 'Type your text here...',
            theme: 'snow' // or 'bubble'
        });
    </script>

    <!--date-->
    <script src="/assets/plugins/global/plugins.bundle.js"></script>
    <script>
        $("#kt_daterangepicker_1").daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                locale: {
                    format: "DD/MM/YYYY"
                }
            }
        );

        $("#kt_daterangepicker_2").daterangepicker({
                timePicker: true,
                singleDatePicker: true,
                showDropdowns: true,
                locale: {
                    format: "hh:mm A"
                }
            }
        );

    </script>
    <script>
        $(document).on('click', '#batal', function(e) {
            e.preventDefault(); // Prevent default action (like submitting a form or following a link)
            var link = $(this).data('link'); // Get the link from the data-link attribute
            Swal.fire({
                html: "Adakah anda pasti?",
                icon: "warning",
                buttonsStyling: false,
                showCancelButton: true,
                confirmButtonText: "Ya",
                cancelButtonText: 'Tidak',
                customClass: {
                    confirmButton: "btn btn-primary",
                    cancelButton: 'btn btn-danger'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    // Redirect to the link if the user confirms
                    window.location.href = link;
                }
            });
        });
    </script>
    <script>
        function adjustQRCode() {
            const qrCode = document.getElementById('qr-code');
            const qrCode2 = document.getElementById('qr-code-2');
            const qrCode3 = document.getElementById('qr-code-3');
            const screenWidth = window.innerWidth;

            if (screenWidth <= 500) {
                qrCode.innerHTML = `{!! QrCode::size(270)->generate($program->pautan_pengesahan); !!}`;
                qrCode2.innerHTML = `{!! QrCode::size(270)->generate($program->pautan_pengesahan); !!}`;
                qrCode3.innerHTML = `{!! QrCode::size(270)->generate($program->pautan_perekodan); !!}`;
            }
        }

        // Run the function when the page loads and when the window is resized
        window.addEventListener('load', adjustQRCode);
        window.addEventListener('resize', adjustQRCode);
    </script>

@endsection
