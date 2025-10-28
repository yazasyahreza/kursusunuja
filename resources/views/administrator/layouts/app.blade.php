<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="This is admin template for laravel putra 2025">
    <meta name="author" content="AdminKit">
    <meta name="keywords" content="unuja, teknik, if, bem-ft, bootcamp, laravel, 2025, yaza">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="https://cdn-icons-png.flaticon.com/512/5087/5087579.png" />

    <link rel="canonical" href="https://demo-basic.adminkit.io/" />

    <title>Aplikasi Kursus - Admin Dashboard</title>

    @include('administrator.layouts.style')
    @yield('this-page-style')
    <style>
        body {
            font-family: 'Open Sans', sans-serif;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        @include('administrator.layouts.sidebar')

        <div class="main">
            @include('administrator.layouts.header')

            <main class="content">
                @yield('this-page-content')
            </main>

            @include('administrator.layouts.footer')
        </div>
    </div>

    @include('administrator.layouts.script')
    @yield('this-page-scripts')
</body>

</html>
