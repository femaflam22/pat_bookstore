<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Manager</title>

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
                <div class="d-flex justify-content-between">
                <div>
                    <a href="{{route('manager.penjualan.cetak')}}" class="btn btn-success mb-3">Cetak</a>
                    <a href="{{route('manager.penjualan')}}" class="btn btn-info mb-3 text-white">Refresh</a>
                    <a href="{{route('manager.home')}}" class="btn btn-secondary mb-3 text-white">Home</a>
                </div>
                <form method="POST" action="{{route('manager.penjualan.filter')}}">
                    @csrf
                <div class="form-row">
                    <div class="col d-flex">
                    <img src="/img/until.svg" alt="dari" width="25" class="mr-3">
                    <input type="date" class="form-control" name="until" value="{{date('Y-m-d')}}">
                    </div>
                    <div class="col">
                        <button type="submit" class="btn btn-primary mb-2">Cari</button>
                    </div>
                </div>
                </form>
                </div>
                <table class="table table-bordered text-center">
                <thead class="thead-light">
                    <tr>
                    <th scope="col">No</th>
                    <th scope="col">Kode Faktur</th>
                    <th scope="col">Judul</th>
                    <th scope="col">Kasir</th>
                    <th scope="col">Jumlah Beli</th>
                    <th scope="col">Total Harga</th>
                    <th scope="col">Bayar</th>
                    <th scope="col">Kembalian</th>
                    <th scope="col">Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datas as $data)
                    <tr>
                    <td>{{$no++}}</td>
                    <td>{{$data->kode_faktur}}</td>
                    <td>{{$data->book['judul']}}</td>
                    <td>{{$data->kasir['name']}}</td>
                    <td>{{$data->jumlah_beli}}</td>
                    <td>{{$data->total_harga}}</td>
                    <td>{{$data->bayar}}</td>
                    <td>{{$data->kembalian}}</td>
                    <td>{{$data->tanggal}}</td>
                    </tr>
                    @endforeach
                    <tr>
                        <td colspan="1">Jumlah</td>
                        <th colspan="9" class="text-left">{{$total}}</th>
                    </tr>
                </tbody>
                </table>

                <div class="pt-3 mb-5 float-right">
                    {!! $datas->links() !!}
                </div>
            </div>
        </main>
    </div>
</body>
</html>