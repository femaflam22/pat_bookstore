<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>kasir</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ route('manager.home') }}">
                    Book Store
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::guard('manager')->user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('manager.password') }}">
                                    Ubah Password
                                </a>
                                <a class="dropdown-item" href="{{ route('manager.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('manager.logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            <div class="container">
                <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active">
                        <a href="{{ route('manager.home') }}" class="text-decoration-none text-secondary"><img src="/img/home.svg" alt="" width="20">
                        Home</a>
                    </li>
                    <li class="dropdown breadcrumb-item">
                        <a class="dropdown-toggle text-decoration-none text-secondary" href="#" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Inputan
                        </a>

                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item" href="{{route('manager.register')}}">Buat Akun</a>
                        </div>
                    </li>
                    <li class="dropdown breadcrumb-item">
                        <a class="dropdown-toggle text-decoration-none text-secondary" href="#" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Laporan
                        </a>

                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item" href="{{route('manager.user')}}">Data User</a>
                            <a class="dropdown-item" href="{{route('manager.faktur')}}">Cetak Faktur</a>
                            <a class="dropdown-item" href="{{route('manager.penjualan')}}">Penjualan</a>
                            <a class="dropdown-item" href="{{route('manager.buku')}}">Data Buku</a>
                            <a class="dropdown-item" href="{{route('manager.filter.penulis')}}">Filter Penulis Buku</a>
                            <a class="dropdown-item" href="{{route('manager.pasok')}}">Data Pasok</a>
                            <a class="dropdown-item" href="{{route('manager.filter.pasok')}}">Filter Pasok Buku</a>
                        </div>
                    </li>
                </ol>
                </nav>
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">REGISTER</div>

                            <div class="card-body">
                                <form method="POST" action="{{ route('manager.create') }}">
                                    @if (Session::get('success'))
                                        <div class="alert alert-success">
                                            {{ Session::get('success') }}
                                        </div>
                                    @endif
                                    @if (Session::get('fail'))
                                        <div class="alert alert-danger">
                                            {{ Session::get('fail') }}
                                        </div>
                                    @endif
                                    @csrf

                                    <div class="form-group row">
                                        <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>

                                        <div class="col-md-6">
                                            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" autocomplete="name" autofocus>
                                            <span class="text-danger mt-2">@error('name'){{ $message }}@enderror</span>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="address" class="col-md-4 col-form-label text-md-right">Address</label>

                                        <div class="col-md-6">
                                            <input id="address" type="text" class="form-control" name="address" value="{{ old('address') }}" autocomplete="address" autofocus>
                                            <span class="text-danger mt-2">@error('address'){{ $message }}@enderror</span>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="telp" class="col-md-4 col-form-label text-md-right">Telp</label>

                                        <div class="col-md-6">
                                            <input id="telp" type="text" class="form-control" name="telp" value="{{ old('telp') }}" autocomplete="telp" autofocus>
                                            <span class="text-danger mt-2">@error('telp'){{ $message }}@enderror</span>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="status" class="col-md-4 col-form-label text-md-right">Status</label>

                                        <div class="col-md-6">
                                            <select class="form-control" id="status" name="status">
                                            <option>{{ old('status') }}</option>
                                            <option>Aktif</option>
                                            <option>Non-aktif</option>
                                            </select>
                                            <span class="text-danger mt-2">@error('status'){{ $message }}@enderror</span>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="username" class="col-md-4 col-form-label text-md-right">Username</label>

                                        <div class="col-md-6">
                                            <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}" autocomplete="username" autofocus>
                                            <span class="text-danger mt-2">@error('username'){{ $message }}@enderror</span>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                                        <div class="col-md-6">
                                            <input id="password" type="password" class="form-control" name="password" value="{{ old('password') }}" autocomplete="current-password">
                                            <span class="text-danger mt-2">@error('password'){{ $message }}@enderror</span>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="akses" class="col-md-4 col-form-label text-md-right">Akses</label>

                                        <div class="col-md-6">
                                            <select class="form-control" id="akses" name="akses">
                                            <option>{{ old('akses') }}</option>
                                            <option>Admin</option>
                                            <option>Kasir</option>
                                            <option>Manager</option>
                                            </select>
                                            <span class="text-danger mt-2">@error('akses'){{ $message }}@enderror</span>
                                        </div>
                                    </div>

                                    <div class="form-group row mb-0">
                                        <div class="col-md-8 offset-md-4">
                                            <button type="submit" class="btn btn-primary">Register</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
