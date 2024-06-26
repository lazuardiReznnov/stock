<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8" />
        <meta content="width=device-width, initial-scale=1.0" name="viewport" />

        <title>{{ $title }} | {{ config("app.name") }}</title>
        <meta content="" name="description" />
        <meta content="" name="keywords" />

        <!-- Favicons -->
        <link href="/assets/img/favicon.png" rel="icon" />
        <link href="/assets/img/apple-touch-icon.png" rel="apple-touch-icon" />

        <!-- Google Fonts -->
        <link href="https://fonts.gstatic.com" rel="preconnect" />
        <link
            href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
            rel="stylesheet"
        />

        @stack('csslivewire')
        <!-- Vendor CSS Files -->
        @stack('css') @stack('script')

        <link
            href="/assets/vendor/boxicons/css/boxicons.min.css"
            rel="stylesheet"
        />
        <link href="/assets/vendor/quill/quill.snow.css" rel="stylesheet" />
        <link href="/assets/vendor/quill/quill.bubble.css" rel="stylesheet" />
        <link href="/assets/vendor/remixicon/remixicon.css" rel="stylesheet" />
        <link
            href="/assets/vendor/simple-datatables/style.css"
            rel="stylesheet"
        />
        @vite(['resources/sass/app.scss', 'resources/js/app.js'])
        <!-- Template Main CSS File -->
        <link href="/assets/css/style.css" rel="stylesheet" />

        <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: Mar 09 2023 with Bootstrap v5.2.3
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
    </head>

    <body>
        <!-- ======= Header ======= -->
        @include('layouts.dashboard.header')

        <!-- End Header -->

        <!-- ======= Sidebar ======= -->
        @include('layouts.dashboard.sidebar')
        <!-- End Sidebar-->

        <main id="main" class="main">
            {{ $slot }}
        </main>
        <!-- End #main -->

        <!-- ======= Footer ======= -->
        @include('layouts.dashboard.footer')

        <!-- End Footer -->

        <a
            href="#"
            class="back-to-top d-flex align-items-center justify-content-center"
            ><i class="bi bi-arrow-up-short"></i
        ></a>
        @stack('script2')
        <!-- Vendor JS Files -->
        <script src="/assets/vendor/apexcharts/apexcharts.min.js"></script>

        <script src="/assets/vendor/chart.js/chart.umd.js"></script>
        <script src="/assets/vendor/echarts/echarts.min.js"></script>
        <script src="/assets/vendor/quill/quill.min.js"></script>
        <script src="/assets/vendor/simple-datatables/simple-datatables.js"></script>
        <script src="/assets/vendor/tinymce/tinymce.min.js"></script>
        <script src="/assets/vendor/php-email-form/validate.js"></script>

        <!-- Template Main JS File -->

        <script src="/assets/js/main.js"></script>
        @stack('jslivewire')
    </body>
</html>
