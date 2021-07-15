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
                <div class="dropdown bg-muted px-3 py-3 text-center">
                    <a class="dropdown-toggle text-decoration-none text-secondary h3" href="#" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Pilih Nama Penulis
                    </a>

                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        @foreach ($books as $book)
                            <a class="dropdown-item h5" href="{{ route('admin.buku.filter.result',$book->penulis) }}">{{$book->penulis}}</a>
                        @endforeach
                    </div>
                </div>
                <img src="/img/people.svg" alt="admin" width="300" class="d-block mx-auto my-4">
            </div>
        </main>
    </div>
</body>
</html>