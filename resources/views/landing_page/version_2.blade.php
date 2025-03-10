<!DOCTYPE html>
<!--
Author: Keenthemes
Product Name: Metronic
Product Version: 8.2.0
Purchase: https://1.envato.market/EA4JP
Website: http://www.keenthemes.com
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
License: For each use you must have a valid license purchased only from above link in order to legally use the theme for your project.
-->
<html lang="en">
<!--begin::Head-->
<head><base href=""/>
    <meta charset="utf-8" />
    <meta name="description" content="The most advanced Bootstrap 5 Admin Theme with 40 unique prebuilt layouts on Themeforest trusted by 100,000 beginners and professionals. Multi-demo, Dark Mode, RTL support and complete React, Angular, Vue, Asp.Net Core, Rails, Spring, Blazor, Django, Express.js, Node.js, Flask, Symfony & Laravel versions. Grab your copy now and get life-time updates for free." />
    <meta name="keywords" content="metronic, bootstrap, bootstrap 5, angular, VueJs, React, Asp.Net Core, Rails, Spring, Blazor, Django, Express.js, Node.js, Flask, Symfony & Laravel starter kits, admin themes, web design, figma, web development, free templates, free admin themes, bootstrap theme, bootstrap template, bootstrap dashboard, bootstrap dak mode, bootstrap button, bootstrap datepicker, bootstrap timepicker, fullcalendar, datatables, flaticon" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" />
    <link rel="shortcut icon" href="/assets/media/logos/favicon.ico" />
    <!--begin::Fonts(mandatory for all pages)-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
    <link href="/assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <link href="/assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
    <!--end::Global Stylesheets Bundle-->
    <script>// Frame-busting to prevent site from being loaded within a frame without permission (click-jacking) if (window.top != window.self) { window.top.location.replace(window.self.location.href); }</script>
</head>
<style>
    /* Custom Arrow Styling */
    .carousel-control-prev-icon,
    .carousel-control-next-icon {
        background-color: rgba(153, 27, 30, 0.83); /* Change the arrow color */
        border-radius: 50%; /* Make it round */
        padding: 10px; /* Add padding for larger buttons */
    }

    .carousel-control-prev-icon:hover,
    .carousel-control-next-icon:hover {
        background-color: rgba(153, 27, 30, 0.83); /* Change color on hover */
    }
</style>
<!--end::Head-->
<!--begin::Body-->
<body id="kt_body" data-bs-spy="scroll" data-bs-target="#kt_landing_menu" class="bg-body position-relative app-blank">
<!--begin::Theme mode setup on page load-->
<script>var defaultThemeMode = "light"; var themeMode; if ( document.documentElement ) { if ( document.documentElement.hasAttribute("data-bs-theme-mode")) { themeMode = document.documentElement.getAttribute("data-bs-theme-mode"); } else { if ( localStorage.getItem("data-bs-theme") !== null ) { themeMode = localStorage.getItem("data-bs-theme"); } else { themeMode = defaultThemeMode; } } if (themeMode === "system") { themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light"; } document.documentElement.setAttribute("data-bs-theme", themeMode); }</script>
<!--end::Theme mode setup on page load-->
<!--begin::Root-->
<div class="d-flex flex-column flex-root" id="kt_app_root">
    <!--begin::Header Section-->
    <div class="mb-0" id="home">
        <!--begin::Wrapper-->
        <div class="bgi-no-repeat bgi-size-contain bgi-position-x-center bgi-position-y-bottom landing-light landing-img-2">
            <!--begin::Header-->
            <div class="landing-header landing-darkblue">
                <!--begin::Container-->
                <div class="container">
                    <!--begin::Wrapper-->
                    <div class="d-flex align-items-center justify-content-between">
                        <!--begin::Menu wrapper-->
                        <div class="d-lg-block flex-lg-root" id="kt_header_nav_wrapper">
                            <div class="d-lg-block p-5 p-lg-0" data-kt-drawer="true" data-kt-drawer-name="landing-menu" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="200px" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_landing_menu_toggle" data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_body', lg: '#kt_header_nav_wrapper'}">
                                <!--begin::Menu-->
                                <div class="gap-2 menu menu-column flex-nowrap menu-rounded menu-lg-row menu-state-title-primary nav nav-flush fs-5 fw-semibold" id="kt_landing_menu">
                                    <!--begin::Menu item-->
                                    <div class="menu-item">
                                        <!--begin::Menu link-->
                                        <a href="https://wa.me/60196262233" class="btn landing-darkblue py-3 px-4 px-xxl-6 btn-active-red" data-kt-scroll-toggle="true" data-kt-drawer-dismiss="true">
                                            <i class="bi bi-whatsapp fs-2 text-white"></i>&nbsp; 019 626 2233
                                        </a>
                                        <!--end::Menu link-->
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item">
                                        <!--begin::Menu link-->
                                        <a href="tel:1-800-22-2235" class="btn landing-darkblue py-3 px-4 px-xxl-6 btn-active-red" data-kt-scroll-toggle="true" data-kt-drawer-dismiss="true">
                                            <i class="bi bi-telephone-fill fs-2 text-white"></i>&nbsp; 1800-22-2235
                                        </a>
                                        <!--end::Menu link-->
                                    </div>
                                    <!--end::Menu item-->
                                </div>
                                <!--end::Menu-->
                            </div>
                        </div>
                        <!--end::Menu wrapper-->
                        <!--begin::Logo-->
                        <div class="d-flex align-items-center text-center">
                            <!--begin::Mobile menu toggle-->
                            <button class="btn btn-icon btn-active-color-primary me-3 d-flex d-lg-none" id="kt_landing_menu_toggle">
                                <i class="ki-duotone ki-abstract-14 fs-2hx">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                            </button>
                            <!--end::Mobile menu toggle-->
                            <div class="mt-2">
                                <!--begin::Logo image-->
                                <a href="{{url('/landing-page/version-2')}}">
                                    <div>
                                        <a href="/">
                                            <img alt="Logo" src="/logo/mySupport-huruf.png" class="logo-default h-30px h-lg-50px mx-auto"/>
                                        </a>
                                        <p class="text-white fs-10 fs-md-15">Sokongan Untuk Kepulihan Anda Prioriti AADK</p>
                                    </div>
                                </a>
                                <!--end::Logo image-->
                            </div>

                        </div>
                        <!--end::Logo-->
                        <!--begin::Login-->
                        <div class="flex-equal text-end ms-1 flex-lg-root">
                            <a href="{{url('/login')}}" class="btn landing-darkblue btn-active-red">
                                <i class="bi bi-person-circle fs-2 text-white"></i>&nbsp; Log Masuk
                            </a>
                        </div>
                        <!--end::Login-->
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Container-->
            </div>
            <!--end::Header-->

            <!--begin::Landing hero-->
            <div class="d-md-flex w-85 w-md-100 min-h-350px min-h-lg-500px p-lg-10 p-2">
                <div class="text-left mt-5 mb-5 mb-lg-10 py-10 py-lg-20 mx-lg-20 mx-10 w-100 w-md-50 landing-bg-white">
                    <div class="d-flex gap-2 mb-8">
                        <img alt="Logo" src="/logo/jata_negara.png" class="logo-default h-50px h-lg-80px"/>
                        <img alt="Logo" src="/logo/aadk.png" class="logo-default h-50px h-lg-80px"/>
                        <a href="/">
                            <img alt="Logo" src="/logo/mySupport.png" class="logo-default h-50px h-lg-80px"/>
                        </a>
                    </div>
                    <hr class="w-100 w-md-100">
                    <br>
                    <h3 class="fw-medium text-justify w-100 w-md-100 f-calibri">
                        MySupport merupakan sistem maklumat klien AADK yang telah tamat
                        mengikuti program. Ia mengandungi butir-butir peribadi klien dan
                        maklumat khusus berkaitan status kepulihan mereka. Kepentingan
                        pangkalan data adalah untuk memberi sokongan kepulihan yang
                        berterusan pasca pemulihan pada bila-bila masa dengan cepat
                        dan mesra.
                    </h3>
                    <br>
                    <div>
                        <h2 class="f-book mx-auto w-50 ps-lg-10">
                            <span class="ms-0">“Aku,</span><br>
                            <span class="ms-12">AADK & </span><br>
                            <span class="ms-25">Keluarga”</span>
                        </h2>
                    </div>
                    <br>
                    <h3 class="fw-medium text-justify w-100 w-md-100 f-calibri">
                        Kepulihan adalah satu perjalanan dan manifesto sokongan
                        antara Aku, AADK & Keluarga. Satu langkah yang kecil menuju
                        kejayaan yang besar.
                    </h3>
                </div>

                <div class="container landing-red-op shadow w-90 h-50 w-md-30 h-md-50 my-auto mx-10">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="flex-root">
                            <h3 class="mt-5 ms-3 text-white">Pengumuman Aktiviti</h3>
                        </div>
                        <div class="flex-root d-flex gap-2 mt-4 justify-content-end me-5">
                            <i class="bi bi-circle-fill text-success"></i>
                            <i class="bi bi-circle-fill text-warning"></i>
                            <i class="bi bi-circle-fill text-danger"></i>
                        </div>
                    </div>
                    <div id="programCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner" id="carousel-content">
                            <!-- Dynamic program content will be inserted here -->
                            <div class="d-block mx-2 mt-2 mb-5 w-97 text-center p-5 landing-bg-white text-black">
                                <h3 class="p-2">Tiada Aktiviti</h3>
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#programCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#programCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
            <!--end::Landing hero-->
        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::Content Section-->

    <!--begin::Footer Section-->
    <div class="mb-0">
        <!--begin::Wrapper-->
        <div class="landing-darkblue landing-hr-top pt-5 px-5 px-lg-0">
            <!--begin::Container-->
            <div class="container">
                <!--begin::Row-->
                <div class="row py-5 py-lg-15">
                    <!--begin::Col-->
                    <div class="col-lg-4 pe-lg-5 mb-5 mb-lg-0">
                        <!--begin::Block-->
                        <div class="rounded landing-dark-border p-1 mb-2">
                            <!--begin::Text-->
                            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15938.187061609875!2d101.7468338!3d2.9456305!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31cdc9847e2a657f%3A0xf2b32842ef9d2b51!2sAgensi%20Antidadah%20Kebangsaan!5e0!3m2!1sen!2smy!4v1724031008391!5m2!1sen!2smy" width="350" height="250" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" class="responsive-iframe"></iframe>
                            <!--end::Text-->
                        </div>
                        <!--end::Block-->
                    </div>
                    <!--end::Col-->
                    <!--begin::Col-->
                    <div class="col-lg-4 pe-lg-5 mb-5 mb-lg-0">
                        <!--begin::Block-->
                        <div class="rounded landing-dark-border p-1 mb-2">
                            <!--begin::Title-->
                            <h4 class="text-white">AGENSI ANTIDADAH KEBANGSAAN MALAYSIA <br>KEMENTERIAN DALAM NEGERI</h4>
                            <!--end::Title-->
                            <!--begin::Text-->
                            <p class="fs-5">Jalan Maktab Perguruan Islam <br>43000 Kajang, Selangor </p>
                            <!--end::Text-->
                        </div>
                        <!--end::Block-->
                        <!--begin::Block-->
                        <div class="rounded landing-dark-border p-1">
                            <!--begin::Text-->
                            <p class="fs-5">
                                Tel : 03 – 8911 2200 <br>
                                Faks : 03 – 8926 2055 <br>
                                Emel : webmaster[at]adk[dot]gov[dot]my <br>
                                <br>
                                Hotline AADK : 1-800-22-2235 / 019 – 626 2233
                            </p>
                            <!--end::Text-->
                        </div>
                        <!--end::Block-->
                    </div>
                    <!--end::Col-->
                    <!--begin::Col-->
                    <div class="col-lg-4 pe-lg-5 mb-5 mb-lg-0">
                        <!--begin::Navs-->
                        <div class="d-flex justify-content-lg-start px-2">
                            <!--begin::Links-->
                            <div class="d-flex fw-semibold flex-column ms-lg-20">
                                <!--begin::Subtitle-->
                                <h4 class="fw-bold text-gray-400 mb-6">Media Sosial</h4>
                                <!--end::Subtitle-->
                                <!--begin::Link-->
                                <a href="https://www.adk.gov.my" class="mb-6">
                                    <img src="/assets/media/svg/brand-logos/website-2.svg" class="h-20px me-2" alt="" />
                                    <span class="text-white opacity-50 text-hover-primary fs-5 mb-6">Website</span>
                                </a>
                                <!--end::Link-->
                                <!--begin::Link-->
                                <a href="https://web.facebook.com/aadkmalaysia" class="mb-6">
                                    <img src="/assets/media/svg/brand-logos/facebook-4.svg" class="h-20px me-2" alt="" />
                                    <span class="text-white opacity-50 text-hover-primary fs-5 mb-6">Facebook</span>
                                </a>
                                <!--end::Link-->
                                <!--begin::Link-->
                                <a href="https://x.com/aadkmalaysia" class="mb-6">
                                    <img src="/assets/media/logos/twitter-x-black.png" class="h-20px me-2" alt="" />
                                    <span class="text-white opacity-50 text-hover-primary fs-5 mb-6">X</span>
                                </a>
                                <!--end::Link-->
                                <!--begin::Link-->
                                <a href="https://www.instagram.com/aadk.malaysia/" class="mb-6">
                                    <img src="/assets/media/svg/brand-logos/instagram-2-1.svg" class="h-20px me-2" alt="" />
                                    <span class="text-white opacity-50 text-hover-primary fs-5 mb-6">Instagram</span>
                                </a>
                                <!--end::Link-->
                                <!--begin::Link-->
                                <a href="https://www.youtube.com/channel/UCitb-TRjaYFqEJ_Np6gYlZg" class="mb-6">
                                    <img src="/assets/media/svg/brand-logos/youtube-logo.svg" class="h-20px me-2" alt="" />
                                    <span class="text-white opacity-50 text-hover-primary fs-5 mb-6">YouTube</span>
                                </a>
                                <!--end::Link-->
                                <!--begin::Link-->
                                <a href="https://www.tiktok.com/@aadk.tv" class="mb-6">
                                    <img src="/assets/media/svg/brand-logos/tiktok-2.svg" class="h-20px me-2" alt="" />
                                    <span class="text-white opacity-50 text-hover-primary fs-5 mb-6">TikTok</span>
                                </a>
                                <!--end::Link-->
                                <!--begin::Link-->
                                <a href="https://t.me/aadkofficial" class="mb-6">
                                    <img src="/assets/media/svg/brand-logos/telegram-v2.svg" class="h-20px me-2" alt="" />
                                    <span class="text-white opacity-50 text-hover-primary fs-5 mb-6">Telegram</span>
                                </a>
                                <!--end::Link-->
                            </div>
                            <!--end::Links-->
                        </div>
                        <!--end::Navs-->
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Row-->
            </div>
            <!--end::Container-->
            <!--begin::Separator-->
            <div class="landing-dark-separator"></div>
            <!--end::Separator-->
            <!--begin::Container-->
            <div class="container">
                <!--begin::Wrapper-->
                <div class="d-flex flex-column flex-md-row flex-stack py-3 py-lg-5">
                    <!--begin::Copyright-->
                    <div class="d-flex align-items-center order-2 order-md-1">
                        <!--begin::Logo-->
                        <a href="{{url('/landing-page/version-2')}}">
                            <img alt="Logo" src="/logo/aadk.png" class="h-30px h-md-35px" />
                        </a>
                        <!--end::Logo image-->
                        <!--begin::Logo image-->
                        <span class="mx-3 fs-6 fw-semibold text-gray-600 pt-1" href="https://www.adk.gov.my/">© 2024 Agensi Antidadah Kebangsaan (AADK), Hak Cipta Terpelihara.</span>
                        <!--end::Logo image-->
                    </div>
                    <!--end::Copyright-->
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::Footer Section-->
    <!--begin::Scrolltop-->
    <div id="kt_scrolltop" class="scrolltop landing-blue" data-kt-scrolltop="true">
        <i class="ki-duotone ki-arrow-up">
            <span class="path1"></span>
            <span class="path2"></span>
        </i>
    </div>
    <!--end::Scrolltop-->
</div>
<!--end::Root-->
<!--begin::Scrolltop-->
<div id="kt_scrolltop" class="scrolltop landing-blue" data-kt-scrolltop="true">
    <i class="ki-duotone ki-arrow-up">
        <span class="path1"></span>
        <span class="path2"></span>
    </i>
</div>
<!--end::Scrolltop-->
<!--begin::Javascript-->
<script>var hostUrl = "/assets/";</script>
<!--begin::Global Javascript Bundle(mandatory for all pages)-->
<script src="/assets/plugins/global/plugins.bundle.js"></script>
<script src="/assets/js/scripts.bundle.js"></script>
<!--end::Global Javascript Bundle-->
<!--begin::Vendors Javascript(used for this page only)-->
<script src="/assets/plugins/custom/fslightbox/fslightbox.bundle.js"></script>
<script src="/assets/plugins/custom/typedjs/typedjs.bundle.js"></script>
<!--end::Vendors Javascript-->
<!--begin::Custom Javascript(used for this page only)-->
<script src="/assets/js/custom/landing.js"></script>
<script src="/assets/js/custom/pages/pricing/general.js"></script>
<!--end::Custom Javascript-->

<!--program-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function () {
        // Function to format date in d/m/Y, h:iA format
        function formatDate(dateStr) {
            const options = {
                year: 'numeric', month: '2-digit', day: '2-digit',
                hour: '2-digit', minute: '2-digit', hour12: true
            };
            const date = new Date(dateStr);
            return date.toLocaleDateString('en-GB', options);
        }

        // Fetch programs with AJAX
        $.ajax({
            url: '/program-dianjurkan',
            method: 'GET',
            success: function (data) {
                let carouselContent = '';
                if (data === null || data.length === 0) {
                    carouselContent = `
                        <div class="d-block mx-2 mt-5 mb-5 w-97 text-center px-5 py-10 landing-bg-white text-black">
                            <h3 class="p-2">Tiada Aktiviti Buat Masa Ini</h3>
                        </div>
                    `;
                } else {
                    $.each(data, function (index, program) {
                        carouselContent += `
                            <div class="carousel-item ${index === 0 ? 'active' : ''}">
                                <div class="d-block mx-2 mt-5 mb-5 w-97 text-center px-5 py-10 landing-bg-white text-black">
                                    <h3 class="p-2">${program.nama}</h3>
                                    <p class="m-0 p-0">Tarikh/Masa Mula: ${formatDate(program.tarikh_mula)}</p>
                                    <p class="m-0 p-0">Tarikh/Masa Tamat: ${formatDate(program.tarikh_tamat)}</p>
                                    <p class="m-0 p-0">Tempat: ${program.tempat}</p>
                                    <p class="m-0 p-0">Pautan: <a href="${program.pautan_pengesahan}">Klik di sini</a></p>
                                </div>
                            </div>
                        `;
                    });
                }
                $('#carousel-content').html(carouselContent);
            }
        });
    });
</script>
<!--end::Javascript-->
</body>
<!--end::Body-->
</html>
