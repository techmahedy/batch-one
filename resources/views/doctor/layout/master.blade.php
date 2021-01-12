
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    @stack('style')
    <style>
        li.message {
            display: block;
            background: #e4cfcf;
            padding: 4px;
            border-left: 5px solid darkblue;
            color: black;
        }
    </style>
</head>
<body>
<div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
    @includeIf('doctor.layout.header')
    <div class="app-main">
        @includeIf('doctor.layout.sidebar')
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="{{ asset('admin/assets/scripts/main.js') }}"></script>
<script>
    $(function(){
        setTimeout(function(){
            $("#hide_message").fadeOut();
        },2000);
    });
</script>
@stack('script')
</body>
</html>
