<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.title', 'Laravel') }}</title>
    
    <meta name="description" content="SS面板是一家专门提供SS账号的服务商，技术支持于Shadowsocks。Shadowsocks是新兴的一项Socks5代理技术，其相对于VPN而言，更佳快速、更加安全。SS面板精选全球各地优秀节点，深度优化各节点性能，欢迎有兴趣的同学前来试用～">
    <meta name="keywords" content="ss,shadowsocks,ss账号,shadowsocks账号" />
    <meta name="author" content="">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body>
    <div id="app">
        <router-view></router-view>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
