<!DOCTYPE HTML>
<html>
<head>
    <meta name="viewport" content="width=device-width; initial-scale=1.0"/>
    <title>CMS</title>
    <link rel="stylesheet" href="/css/bootstrap.css" />
    <script type="text/javascript" src="/ckeditor/ckeditor.js"></script>
    @include('layouts.parts.head')
</head>
<body>
        @yield('content')
    <script src="/js/bootstrap.js"></script>
        @include('layouts.parts.footer')
</body>
</html>