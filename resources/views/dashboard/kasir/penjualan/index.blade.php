<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Kasir</title>

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
                <a class="navbar-brand" href="{{ route('kasir.home') }}">
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
                                {{ Auth::guard('web')->user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('kasir.password') }}">
                                    Ubah Password
                                </a>
                                <a class="dropdown-item" href="{{ route('kasir.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('kasir.logout') }}" method="POST" class="d-none">
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
                        <a href="{{ route('kasir.home') }}" class="text-decoration-none text-secondary"><img src="/img/home.svg" alt="" width="20">
                        Home</a>
                    </li>
                    <li class="dropdown breadcrumb-item">
                        <a class="dropdown-toggle text-decoration-none text-secondary" href="#" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Transaksi
                        </a>

                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item" href="{{route('kasir.penjualan')}}">Penjualan</a>
                        </div>
                    </li>
                    <li class="dropdown breadcrumb-item">
                        <a class="dropdown-toggle text-decoration-none text-secondary" href="#" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Laporan
                        </a>

                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item" href="{{route('kasir.pembelian.struk')}}">Cetak Faktur</a>
                            <a class="dropdown-item" href="{{route('kasir.pembelian.data')}}">Penjualan</a>
                        </div>
                    </li>
                </ol>
                </nav>
            </div>

            <div class="container">
                <div class="container px-4">
                <form method="POST" action="{{ route('kasir.penjualan.check') }}">
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
                    <h4 class="text-center my-5">Form Buku</h4>
                    <div class="form-group">
                        <label for="judul">Judul Buku</label>
                        <select class="form-control" id="judul" name="judul">
                        <option>{{ old('judul') }}</option>
                            @foreach ($datas as $data)
                                <option>{{$data->judul}}</option>
                            @endforeach
                        </select>
                        <span class="text-danger mt-2">@error('judul'){{ $message }}@enderror</span>
                    </div>
                    <div class="form-group">
                        <label for="jumlah_beli">Jumlah Beli</label>
                        <input type="number" class="form-control" id="jumlah_beli"  name="jumlah_beli" value="{{ old('jumlah_beli') }}">
                        <span class="text-danger mt-2">@error('jumlah_beli'){{ $message }}@enderror</span>
                    </div>
                    <div class="form-group">
                        <label for="id_kasir">Kasir ID</label>
                        <select class="form-control" id="id_kasir" name="id_kasir">
                        <option>{{ old('id_kasir') }}</option>
                            @foreach ($users as $user)
                                <option>{{$user->id}}</option>
                            @endforeach
                        </select>
                        <span class="text-danger mt-2">@error('id_kasir'){{ $message }}@enderror</span>
                    </div>
                    <button type="submit" class="btn btn-primary">Selanjutnya</button>
                </form>
            </div>
            </div>
        </main>
    </div>
</body>
</html>