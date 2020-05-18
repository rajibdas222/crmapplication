<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    @yield('title')
    <link rel="shortcut icon" href="<?php echo(\Config::get('app.url').'/public/backend/images/logo/favicon.ico');?>">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <meta name="description"content="dhakajacos.com.bd jacos jacos-crm jacos.jp">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <link rel="stylesheet" href="<?php echo(\Config::get('app.url').'/public/css/app.css');?>">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.3.0/css/flag-icon.css">
    <link href="<?php echo(\Config::get('app.url').'/public/dashboard/styles/shards-dashboards.1.1.0.min.css');?>"rel="stylesheet">
    <link rel="stylesheet" href="<?php echo(\Config::get('app.url').'/public/dashboard/styles/extras.1.1.0.min.css');?>">
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <link href="{{Config::get('app.url').'/public/css/home-page-custom.css'}}" rel="stylesheet">
    {{-- Select2 --}}
    <link href="<?php echo(\Config::get('app.url').'/public/dashboard/dist/css/select2.min.css');?>" rel="stylesheet" />
    @include('backend.layouts.js_variable')
</head>

<body>
    <div class="container-fluid" id="app">
        <div class="row">
            <!-- Sidebar -->
            @include('backend.pages.sidebar')
            @include('backend.pages.header')
            @yield('content')

            @include('backend.modals.delete_modal')
            @include('backend.modals.permission_show_modal')
            @include('backend.modals.change_password_modal')
            @include('backend.modals.user_change_password_modal')
            @include('backend.modals.new_user_modal')
            @include('backend.pages.footer')

        </div>
    </div>
    <script src="<?php echo(\Config::get('app.url').'/public/js/app.js')?>"></script>
    <script src="<?php echo(\Config::get('app.url').'/public/js/approach-data.js')?>"></script>
    <script src="<?php echo(\Config::get('app.url').'/public/dashboard/scripts/Chart.min.js')?>"></script>
    <script src="<?php echo(\Config::get('app.url').'/public/dashboard/scripts/shards-dashboards.1.1.0.min.js')?>"></script>
    <script src="<?php echo(\Config::get('app.url').'/public/dashboard/scripts/jquery.sharrre.min.js')?>"></script>
    <script src="<?php echo(\Config::get('app.url').'/public/dashboard/scripts/extras.1.1.0.min.js')?>"></script>
    {{-- Select2 script  --}}
    <script src="<?php echo(\Config::get('app.url').'/public/dashboard/scripts/select2.min.js')?>"></script>
    <script src="<?php echo(\Config::get('app.url').'/public/js/role_permission.js')?>"></script>
    <script src="<?php echo(\Config::get('app.url').'/public/js/all_functions.js')?>"></script>

    @yield('script')

</body>

</html>