<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin</title>
    
    <link rel="shortcut icon" href="/img/admin.svg" type="image/x-icon">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
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
                            <a class="dropdown-item" href="{{ route('admin.buku.takterjual') }}">Buku yang Tidak Pernah Terjual</a>
                            <a class="dropdown-item" href="{{ route('admin.buku.terjual') }}">Buku yang Terjual</a>
                            <a class="dropdown-item" href="{{ route('admin.pasok.data') }}">Pasok Buku</a>
                            <a class="dropdown-item" href="{{ route('admin.pasok.filter') }}">Filter Pasok Buku</a>
                        </div>
                    </li>
                </ol>
                </nav>
            </div>

            <div class="container px-4">
                <form method="POST" action="{{ route('admin.distributor.add') }}">
                    @if (Session::get('success'))
                        <div class="alert alert-success">
                            {{ Session::get('success') }}
                        </div>
                    @endif
                    @csrf
                    <h4 class="text-center my-5">Form Distributor</h4>
                    <div class="form-group">
                        <label for="nama_distributor">Nama</label>
                        <input type="text" class="form-control" id="nama_distributor"  name="nama_distributor" placeholder="Masukkan nama lengkap distributor" value="{{ old('nama_distributor') }}">
                        <span class="text-danger mt-2">@error('nama_distributor'){{ $message }}@enderror</span>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <input class="form-control" name="alamat" id="alamat" type="text" placeholder="Masukkan alamat distributor" value="{{ old('alamat') }}">
                        <span class="text-danger mt-2">@error('alamat'){{ $message }}@enderror</span>
                    </div>
                    <div class="form-group">
                        <label for="telpon">Telpon</label>
                        <input type="text" class="form-control" id="telpon"  name="telpon" value="{{ old('telpon') }}" placeholder="Masukkan nomor telpon distributor">
                        <span class="text-danger mt-2">@error('telpon'){{ $message }}@enderror</span>
                    </div>
                    <button type="submit" class="btn btn-primary">Tambahkan</button>
                </form>
                <hr class="my-5">
            </div>

            <div class="container">
                <div class="d-flex justify-content-between">
                    <a href="{{route('admin.distributor')}}" class="btn btn-info mb-3 text-white">Refresh</a>
                    <form class="form-inline mb-3 justify-content-end" action="{{route('admin.distributor.search')}}" method="POST">
                        @csrf
                        <input class="form-control mr-sm-2" type="search" placeholder="Nama Distributor" aria-label="Search" name="search">
                        <button class="btn btn-outline-secondary my-2 my-sm-0" type="submit">Cari</button>
                    </form>
                </div>
                <table class="table table-bordered text-center">
                <thead class="thead-light">
                    <tr>
                    <th scope="col">Kode Distributor</th>
                    <th scope="col">Nama Distributor</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">Telpon</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Hapus</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($distributors as $dtbt)
                    <tr>
                    <td>{{$dtbt->kode_distributor}}</td>
                    <td>{{$dtbt->nama_distributor}}</td>
                    <td>{{$dtbt->alamat}}</td>
                    <td>{{$dtbt->telpon}}</td>
                    <td>
                        <a href="{{ route('admin.distributor.edit',$dtbt->id) }}"><img src="/img/edit.svg" width="20"></a>
                    </td>
                    <td>
                        <a href="{{ route('admin.distributor.delete',$dtbt->id) }}"><img src="/img/delete.svg" width="20"></a>
                    </td>
                    </tr>
                    @endforeach
                </tbody>
                </table>
                <div class="pt-3 float-right mb-5">
                    {!! $distributors->links() !!}
                </div>
            </div>
        </main>
    </div>
</body>
</html>