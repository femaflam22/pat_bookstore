<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">
    <title>Book Store</title>
</head>

<body class="bg-muted">
    {{-- <div class="container">
        <a href="{{ route('admin.login') }}" class="btn btn-primary btn-lg btn-block">Admin</a>
        <a href="{{ route('kasir.login') }}" class="btn btn-secondary btn-lg btn-block">Kasir</a>
        <a href="{{ route('manager.login') }}" class="btn btn-secondary btn-lg btn-block">Manajer</a>
    </div> --}}
    <div class="jumbotron jumbotron-fluid hero">
    <div class="container">
        <p class="display-4"><span>Book Store</span>, Let's Do The <span>Best</span> For Today</p>
    </div>
    </div>
    <div class="container bg-white content">
        <div class="row justify-content-center">
            <div class="col-lg-12 type-panel">
                <div class="row">
                    <div class="col-lg d-flex flex-row inner">
                        <img src="/img/admin.svg" alt="admin">
                        <a href="{{ route('admin.login') }}" class="d-flex flex-column text-none">
                            <h4>Admin</h4>
                            <p>klik jika anda admin</p>
                        </a>
                    </div>
                    <div class="col-lg d-flex flex-row inner">
                        <img src="/img/kasir.svg" alt="kasir">
                        <a href="{{ route('kasir.login') }}" class="d-flex flex-column text-none">
                            <h4>Kasir</h4>
                            <p>klik jika anda kasir</p>
                        </a>
                    </div>
                    <div class="col-lg d-flex flex-row inner">
                        <img src="/img/manager.svg" alt="manager" class="mngr">
                        <a href="{{ route('manager.login') }}" class="d-flex flex-column text-none">
                            <h4>Manager</h4>
                            <p>klik jika anda manager</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</body>

</html>