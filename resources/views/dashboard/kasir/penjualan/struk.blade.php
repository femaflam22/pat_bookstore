<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Kasir</title>
    
    <link rel="shortcut icon" href="/img/kasir.svg" type="image/x-icon">

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
                <a href="{{route('kasir.pembelian.struk.cetak')}}" class="btn btn-success mb-3">Cetak</a>
                <a href="{{route('kasir.home')}}" class="btn btn-secondary mb-3">Kembali</a>
                <table class="table table-bordered text-center">
                    @foreach ($datas as $data)
                    <tr>
                    <th scope="col">No Faktur</th>
                    <td scope="col">{{$data->kode_faktur}}</td>
                    <th scope="col">Tanggal</th>
                    <td scope="col">{{$data->tanggal}}</td>
                    <th scope="col">Kasir</th>
                    <td scope="col">{{$data->getKasir['name']}}</td>
                    </tr>
                    <tr>
                    <th scope="col">Judul Buku</th>
                    <td scope="col">{{$data->book['judul']}}</td>
                    <th scope="col">Jumlah Beli</th>
                    <td scope="col">{{$data->jumlah_beli}}</td>
                    <th scope="col">Total Harga</th>
                    <td scope="col">{{$data->total_harga}}</td>
                    </tr>
                    <tr>
                    <th scope="col">Bayar</th>
                    <td scope="col">{{$data->bayar}}</td>
                    <th scope="col">Kembalian</th>
                    <td scope="col">{{$data->kembalian}}</td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </main>
    </div>
</body>
</html>