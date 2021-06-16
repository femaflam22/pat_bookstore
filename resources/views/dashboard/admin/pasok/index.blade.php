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
                <form method="POST" action="{{ route('admin.pasok.add') }}">
                    @if (Session::get('success'))
                        <div class="alert alert-success">
                            {{ Session::get('success') }}
                        </div>
                    @endif
                    @csrf
                    <h4 class="text-center my-5">Form Pasok</h4>
                    <div class="form-group">
                        <label for="buku_kode">Kode Buku</label>
                        <select class="form-control" id="buku_kode" name="buku_kode">
                        <option>{{ old('buku_kode') }}</option>
                            @foreach ($books as $book)
                                <option>{{$book->buku_kode}}</option>
                            @endforeach
                        </select>
                        <span class="text-danger mt-2">@error('buku_kode'){{ $message }}@enderror</span>
                    </div>
                    <div class="form-group">
                        <label for="id_distributor">Kode Distributor</label>
                        <select class="form-control" id="id_distributor" name="id_distributor">
                        <option>{{ old('id_distributor') }}</option>
                            @foreach ($distributors as $dtbt)
                                <option>{{$dtbt->id}}</option>
                            @endforeach
                            </select>
                        <span class="text-danger mt-2">@error('id_distributor'){{ $message }}@enderror</span>
                    </div>
                    <div class="form-group">
                        <label for="jumlah">Jumlah Pasok</label>
                        <input class="form-control" name="jumlah" id="jumlah" type="number" placeholder="Masukkan jumlah pasok dalam pcs" value="{{ old('jumlah') }}">
                        <span class="text-danger mt-2">@error('jumlah'){{ $message }}@enderror</span>
                    </div>
                    <div class="form-group">
                        <label for="tanggal">Tanggal</label>
                        <input type="date" class="form-control" id="tanggal"  name="tanggal" value="{{ old('tanggal') }}">
                        <span class="text-danger mt-2">@error('tanggal'){{ $message }}@enderror</span>
                    </div>
                    <button type="submit" class="btn btn-primary">Tambahkan</button>
                </form>
                <hr class="my-5">
            </div>

            <div class="container">
                <div class="d-flex justify-content-between">
                    <a href="{{route('admin.pasok')}}" class="btn btn-info mb-3 text-white">Refresh</a>
                    <form method="POST" action="{{route('admin.pasok.search')}}" class="mb-3">
                    <div class="d-flex">
                        @csrf
                        <img src="/img/until.svg" alt="dari" width="25" class="mr-3">
                        <input type="date" class="form-control" name="until">
                        <button type="submit" class="btn btn-primary ml-2">Cari</button>
                    </div>
                    </form>
                </div>
                <table class="table table-bordered text-center">
                <thead class="thead-light">
                    <tr>
                    <th scope="col">Nama Distributor</th>
                    <th scope="col">Judul</th>
                    <th scope="col">No ISBN</th>
                    <th scope="col">Penulis</th>
                    <th scope="col">Penerbit</th>
                    <th scope="col">Harga Jual</th>
                    <th scope="col">Stok</th>
                    <th scope="col">Jumlah Pasok</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Hapus</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datas as $data)
                    <tr>
                    <td>{{$data->distributor['nama_distributor']}}</td>
                    <td>{{$data->book['judul']}}</td>
                    <td>{{$data->book['noisbn']}}</td>
                    <td>{{$data->book['penulis']}}</td>
                    <td>{{$data->book['penerbit']}}</td>
                    <td>{{$data->book['harga_jual']}}</td>
                    <td>{{$data->book['stok']}}</td>
                    <td>{{$data->jumlah}}</td>
                    <td>{{$data->tanggal}}</td>
                    <td>
                        <a href="{{ route('admin.pasok.edit',$data->id) }}"><img src="/img/edit.svg" width="20"></a>
                    </td>
                    <td>
                        <a href="{{ route('admin.pasok.delete',$data->id) }}"><img src="/img/delete.svg" width="20"></a>
                    </td>
                    </tr>
                    @endforeach
                </tbody>
                </table>
                <div class="pt-3 float-right mb-5">
                    {!! $datas->links() !!}
                </div>
            </div>
        </main>
    </div>
</body>
</html>