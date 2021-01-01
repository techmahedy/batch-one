
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    @stack('style')
</head>
<body>
<div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
    @includeIf('admin.layout.header')
    <div class="app-main">
        @includeIf('admin.layout.sidebar')
        <div class="app-main__outer">
            <div class="app-main__inner"> 
                <div class="row">
                    <div class="col-md-12">
                        <div class="main-card mb-3 card">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div> 
        </div>
    </div>
</div>
<script src="{{ asset('admin/assets/scripts/main.js') }}"></script>
@stack('script')
</body>
</html>
