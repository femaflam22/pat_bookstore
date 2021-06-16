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

        <main class="my-5">
            <div class="container">
                <div class="d-flex justify-content-between">
                    <div>
                        <a href="{{route('manager.buku.cetak')}}" class="btn btn-success mb-3">Cetak</a>
                        <a href="{{route('manager.home')}}" class="btn btn-secondary mb-3">Kembali</a>
                        <a href="{{route('manager.buku')}}" class="btn btn-info mb-3 text-white">Refresh</a>
                        <a href="{{route('manager.buku.order')}}" class="btn btn-info mb-3 text-white">Urutkan Stok</a>
                    </div>
                    <form class="form-inline mb-3" action="{{route('manager.buku.search')}}" method="POST">
                        @csrf
                        <input class="form-control mr-sm-2" type="search" placeholder="Judul Buku" aria-label="Search" name="search">
                        <button class="btn btn-outline-secondary my-2 my-sm-0" type="submit">Cari</button>
                    </form>
                </div>
                <table class="table table-bordered text-center">
                <thead class="thead-light">
                    <tr>
                    <th scope="col">No</th>
                    <th scope="col">Kode Buku</th>
                    <th scope="col">Judul</th>
                    <th scope="col">No ISBN</th>
                    <th scope="col">Penulis</th>
                    <th scope="col">Penerbit</th>
                    <th scope="col">Tahun</th>
                    <th scope="col">Stok</th>
                    <th scope="col">Harga Pokok</th>
                    <th scope="col">Harga Jual</th>
                    <th scope="col">PPN</th>
                    <th scope="col">Diskon</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datas as $book)
                    <tr>
                    <td>{{$no++}}</td>
                    <td>{{$book->buku_kode}}</td>
                    <td>{{$book->judul}}</td>
                    <td>{{$book->noisbn}}</td>
                    <td>{{$book->penulis}}</td>
                    <td>{{$book->penerbit}}</td>
                    <td>{{$book->tahun}}</td>
                    <td>{{$book->stok}}</td>
                    <td>{{$book->harga_pokok}}</td>
                    <td>{{$book->harga_jual}}</td>
                    <td>{{$book->ppn}}</td>
                    <td>{{$book->diskon}}</td>
                    </tr>
                    @endforeach
                    <tr>
                        <td colspan="2">Jumlah</td>
                        <th colspan="10" class="text-left">{{$total}}</th>
                    </tr>
                </tbody>
                </table>
                <div class="pt-3 float-right">
                    {!! $datas->links() !!}
                </div>
            </div>
        </main>
    </div>
</body>
</html>