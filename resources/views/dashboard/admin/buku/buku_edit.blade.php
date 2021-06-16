<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" crossorigin="anonymous"> --}}
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ route('admin.home') }}">
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
                                {{ Auth::guard('admin')->user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('admin.password') }}">
                                    Ubah Password
                                </a>
                                <a class="dropdown-item" href="{{ route('admin.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
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
                        <a href="{{ route('admin.home') }}" class="text-decoration-none text-secondary"><img src="/img/home.svg" alt="" width="20">
                        Home</a>
                    </li>
                    <li class="dropdown breadcrumb-item">
                        <a class="dropdown-toggle text-decoration-none text-secondary" href="#" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Inputan
                        </a>

                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item" href="{{ route('admin.distributor') }}">Input Distributor</a>
                            <a class="dropdown-item" href="{{ route('admin.buku') }}">Input Buku</a>
                        </div>
                    </li>
                    <li class="dropdown breadcrumb-item">
                        <a class="dropdown-toggle text-decoration-none text-secondary" href="#" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Tambah
                        </a>

                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item" href="{{ route('admin.pasok') }}">Input Pasok Buku</a>
                        </div>
                    </li>
                    <li class="dropdown breadcrumb-item">
                        <a class="dropdown-toggle text-decoration-none text-secondary" href="#" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Laporan
                        </a>

                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item" href="{{route('admin.buku.data') }}">Semua Data Buku</a>
                            <a class="dropdown-item" href="{{ route('admin.buku.filter') }}">Filter Penulis Buku</a>
                            <a class="dropdown-item" href="{{ route('admin.pasok.data') }}">Pasok Buku</a>
                            <a class="dropdown-item" href="{{ route('admin.pasok.filter') }}">Filter Pasok Buku</a>
                        </div>
                    </li>
                </ol>
                </nav>
            </div>

            <div class="container px-4">
                <form method="POST" action="{{ route('admin.buku.update',$data->id) }}">
                    @if (Session::get('success'))
                        <div class="alert alert-success">
                            {{ Session::get('success') }}
                        </div>
                    @endif
                    @method('PATCH')
                    @csrf
                    <h4 class="text-center my-5">Form Buku</h4>
                    <div class="form-group">
                        <label for="judul">Judul</label>
                        <input type="text" class="form-control" id="judul" value="{{ $data->judul }}" name="judul" placeholder="Masukkan judul buku">
                        <span class="text-danger mt-2">@error('judul'){{ $message }}@enderror</span>
                    </div>
                    <div class="form-group">
                        <label for="noisbn">No ISBN</label>
                        <input type="text" class="form-control" id="noisbn"  name="noisbn" value="{{ $data->noisbn }}" placeholder="Masukkan No ISBN buku">
                        <span class="text-danger mt-2">@error('noisbn'){{ $message }}@enderror</span>
                    </div>
                    <div class="form-group">
                        <label for="penulis">Penulis</label>
                        <input class="form-control" name="penulis" id="penulis" type="text" placeholder="Masukkan nama penulis" value="{{ $data->penulis }}">
                        <span class="text-danger mt-2">@error('penulis'){{ $message }}@enderror</span>
                    </div>
                    <div class="form-group">
                        <label for="penerbit">Penerbit</label>
                        <input class="form-control" name="penerbit" id="penerbit" type="text" value="{{ $data->penerbit }}" placeholder="Masukkan nama penerbit">
                        <span class="text-danger mt-2">@error('penerbit'){{ $message }}@enderror</span>
                    </div>
                    <div class="form-group">
                        <label for="tahun">Tahun</label>
                        <input type="number" class="form-control" id="tahun" value="{{ $data->tahun }}" placeholder="Masukkan tahun terbit buku" name="tahun">
                        <span class="text-danger mt-2">@error('tahun'){{ $message }}@enderror</span>
                    </div>
                    <div class="form-group">
                        <label for="stok">Stok</label>
                        <input type="number" class="form-control" id="stok" value="{{ $data->stok }}" name="stok" placeholder="Masukkan stok dalam pcs">
                        <span class="text-danger mt-2">@error('stok'){{ $message }}@enderror</span>
                    </div>
                    <div class="form-group">
                        <label for="harga_pokok">Harga Pokok</label>
                        <input type="number" class="form-control" id="harga_pokok"  name="harga_pokok" value="{{ $data->harga_pokok }}" placeholder="Harga tanpa titik (80000)">
                        <span class="text-danger mt-2">@error('harga_pokok'){{ $message }}@enderror</span>
                    </div>
                    <div class="form-group">
                        <label for="harga_jual">Harga Jual</label>
                        <input type="number" class="form-control" id="harga_jual"  name="harga_jual" value="{{$data->harga_jual }}" placeholder="Harga tanpa titik (80000)">
                        <span class="text-danger mt-2">@error('harga_jual'){{ $message }}@enderror</span>
                    </div>
                    <div class="form-group">
                        <label for="ppn">PPN</label>
                        <input type="number" class="form-control" id="ppn" value="{{ $data->ppn }}" name="ppn" placeholder="Harga tanpa titik (4000)">
                        <span class="text-danger mt-2">@error('ppn'){{ $message }}@enderror</span>
                    </div>
                    <div class="form-group">
                        <label for="diskon">Diskon</label>
                        <input type="number" class="form-control" id="diskon"  name="diskon" value="{{ $data->diskon }}" placeholder="Tanpa tanda % (50)">
                        <span class="text-danger mt-2">@error('diskon'){{ $message }}@enderror</span>
                    </div>
                    <button type="submit" class="btn btn-primary">Tambahkan</button>
                </form>
                <hr class="my-5">
            </div>
        </main>
    </div>
</body>
</html>