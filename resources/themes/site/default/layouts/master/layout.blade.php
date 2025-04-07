<html>
<head>
    <title>@yield('title')</title>
    <link rel="stylesheet" href="/themes/site/default/assets/css/style.css">

    <meta charset="utf-8">
    <meta name="author" content="Circle Creative">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="A powerful and conceptual apps base dashboard template that especially build for developers and programmers.">

    <!-- Fav Icon  -->
    <link rel="shortcut icon" href="/themes/site/default/assets/images/favicon.png">

    <!-- StyleSheets  -->
    <link rel="stylesheet" href="/themes/site/default/assets/css/dashlite.css?ver=3.2.4">
    <link id="skin-default" rel="stylesheet" href="/themes/site/default/assets/css/theme.css?ver=3.2.4">
</head>
<body class="nk-body bg-white npc-landing ">
<div class="nk-app-root">
    <!-- main @s -->
    <div class="nk-main ">
        <!-- header @s -->
        @include('master.partials.header')
        <!-- header @e -->

        <!-- content @s -->
        @yield('content')
        <!-- content @e -->

        <!-- footer @s -->
        @include('master.partials.footer')
        <!-- footer @e -->
    </div>
    <!-- main @e -->

    <!-- JavaScript -->
    <script src="/themes/site/default/assets/js/bundle.js?ver=3.2.4"></script>
    <script src="/themes/site/default/assets/js/scripts.js?ver=3.2.4"></script>
</body>
</html>
