<html>
<head>
    <title>@yield('title')</title>
    <meta charset="utf-8">
    <meta name="author" content="Circle Creative">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Fav Icon  -->
    <link rel="shortcut icon" href="/themes/admin/default/assets/images/favicon.png">
    <link rel="stylesheet" href="/themes/admin/default/assets/css/dashlite.css?ver=3.2.4">
    <link id="skin-default" rel="stylesheet" href="/themes/admin/default/assets/css/theme.css?ver=3.2.4">
</head>
<body class="nk-body bg-white has-sidebar">
    <div class="nk-app-root">
        <!-- content @s -->
        @yield('content')
        <!-- content @e -->
    </div>
    <!-- JavaScript -->
    <script src="/themes/admin/default/assets/js/bundle.js?ver=3.2.4"></script>
    <script src="/themes/admin/default/assets/js/scripts.js?ver=3.2.4"></script>
</body>
</html>
