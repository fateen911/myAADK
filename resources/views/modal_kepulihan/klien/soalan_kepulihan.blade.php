@extends('layouts._default')

@section('content')

@php
    use Carbon\Carbon;
@endphp

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .question {
            margin-bottom: 15px;
        }
        .options {
            display: flex;
            gap: 20px;
        }
        .options label {
            display: flex;
            align-items: center;
            gap: 5px;
        }
    </style>
</head>

<div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
    <!--begin::Page title-->
    <div class="page-title flex-column justify-content-center flex-wrap me-3 mb-5">
        <!--begin::Title-->
        <h1 class="page-heading text-dark fw-bold fs-3 flex-column justify-content-center my-0">Modal Kepulihan</h1>
        <!--end::Title-->
        <!--begin::Breadcrumb-->
        <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
            <!--begin::Item-->
            <li class="breadcrumb-item text-muted">
                <a href="../../demo1/dist/index.html" class="text-muted text-hover-primary">Modal Kepulihan</a>
            </li>
            <!--end::Item-->
            <!--begin::Item-->
            <li class="breadcrumb-item">
                <span class="bullet bg-gray-400 w-5px h-2px"></span>
            </li>
            <!--end::Item-->
            <!--begin::Item-->
            <li class="breadcrumb-item text-muted">Soal Selidik</li>
            <!--end::Item-->
            <!--begin::Item-->
            <li class="breadcrumb-item">
                <span class="bullet bg-gray-400 w-5px h-2px"></span>
            </li>
            <!--end::Item-->
            <!--begin::Item-->
            <li class="breadcrumb-item text-muted">Soalan Kepulihan</li>
            <!--end::Item-->
        </ul>
        <!--end::Breadcrumb-->
    </div>
    <!--end::Page title-->
</div>
    
<!--begin::Content-->
<div id="kt_app_content" class="app-content flex-column-fluid">
    <!--begin::Content container-->
    <div id="kt_app_content_container" class="app-container container-xxl">
        <!--begin::Card body-->
        <div class="card card-flush">
            <h2 class="text-center pt-10">BORANG SOAL SELIDIK MODAL KEPULIHAN</h2>

            <div class="card-body">
                <form action="{{ route('klien.submit.kepulihan') }}" method="POST">
                    @csrf
                    @foreach($questions as $question)
                        <div class="question" style="font-size: 12pt;">
                            <p><b>{{ $loop->iteration }}. {{ $question->soalan }}</b></p>
                            <div class="options">
                                <label>
                                    <input type="radio" name="answer[{{ $question->id }}]" value="1"> Sangat Tidak Setuju
                                </label>
                                <label>
                                    <input type="radio" name="answer[{{ $question->id }}]" value="2"> Tidak Setuju
                                </label>
                                <label>
                                    <input type="radio" name="answer[{{ $question->id }}]" value="3"> Setuju
                                </label>
                                <label>
                                    <input type="radio" name="answer[{{ $question->id }}]" value="4"> Sangat Setuju
                                </label>
                            </div>
                        </div>
                        <br>
                    @endforeach
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary text-center mt-5">Simpan</button>
                    </div>
                </form>                
            </div>
        </div>
        <!--end::Card body-->
    </div>
    <!--end::Content container-->
</div>

<!--end::Content-->

<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

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

        // Check if there is a flash error message
        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Tidak Berjaya!',
                text: '{!! session('error') !!}',
                confirmButtonText: 'OK'
            });
        @endif
    });
</script>
@endsection