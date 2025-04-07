<html>
<head>
    <title>Telebot - @yield('title')</title>
    <meta charset="utf-8">
    <meta name="author" content="Circle Creative">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Fav Icon  -->
    <link rel="shortcut icon" href="/themes/admin/default/assets/images/favicon.png">
    <link rel="stylesheet" href="/themes/admin/default/assets/css/dashlite.css?ver=3.2.4">
    <link id="skin-default" rel="stylesheet" href="/themes/admin/default/assets/css/theme.css?ver=3.2.4">
    @stack('styles')
</head>
<body class="nk-body bg-white has-sidebar">
    <div class="nk-app-root">
        <!-- main @s -->
        <div class="nk-main ">
            <!-- sidebar @s -->
            @include('master.partials.sidebar')
            <!-- sidebar @e -->

            <!-- wrap @s -->
            <div class="nk-wrap ">
                <!-- main header @s -->
                @include('master.partials.header')
                <!-- main header @e -->

                <!-- content @s -->
                @yield('content')
                <!-- content @e -->

                <!-- footer @s -->
                @include('master.partials.footer')
                <!-- footer @e -->
            </div>
            <!-- wrap @e -->
        </div>
        <!-- main @e -->
    </div>
    @stack('form')
    <!-- JavaScript -->
    <script src="/themes/admin/default/assets/js/bundle.js?ver=3.2.4"></script>
    <script src="/themes/admin/default/assets/js/scripts.js?ver=3.2.4"></script>
    <script src="/themes/admin/default/assets/js/charts/gd-analytics.js?ver=3.2.4"></script>
    <script src="/themes/admin/default/assets/js/libs/jqvmap.js?ver=3.2.4"></script>
    <link rel="stylesheet" href="/themes/admin/default/assets/css/editors/summernote.css?ver=3.2.0">
    <script src="/themes/admin/default/assets/js/libs/editors/summernote.js?ver=3.2.0"></script>
    <script src="/themes/admin/default/assets/js/editors.js?ver=3.2.0"></script>
    @stack('scripts')
</body>
</html>
