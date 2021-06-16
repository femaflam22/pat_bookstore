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
                @if (Session::get('success'))
                    <div class="alert alert-success">
                        {{ Session::get('success') }}
                    </div>
                @endif
                <div class="d-flex justify-content-between">
                    <div>
                        <a href="{{route('manager.user.cetak')}}" class="btn btn-success mb-3">Cetak</a>
                        <a href="{{route('manager.home')}}" class="btn btn-secondary mb-3">Kembali</a>
                        <a href="{{route('manager.user')}}" class="btn btn-info mb-3 text-white">Refresh</a>
                    </div>
                    <form class="form-inline mb-3" action="{{route('manager.user.search')}}" method="POST">
                        @csrf
                        <input class="form-control mr-sm-2" type="search" placeholder="Nama user" aria-label="Search" name="search">
                        <button class="btn btn-outline-secondary my-2 my-sm-0" type="submit">Cari</button>
                    </form>
                </div>
                <table class="table table-bordered text-center">
                <thead class="thead-light">
                    <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Username</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">No Telpon</th>
                    <th scope="col">Status</th>
                    <th scope="col">Akses</th>
                    <th scope="col">Hapus</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datas as $data)
                    <tr>
                    <td>{{$no++}}</td>
                    <td>{{$data->name}}</td>
                    <td>{{$data->username}}</td>
                    <td>{{$data->address}}</td>
                    <td>{{$data->telp}}</td>
                    <td>{{$data->status}}</td>
                    <td>{{$data->akses}}</td>
                    <td>
                        <a href="{{ route('manager.user.delete',$data->id) }}"><img src="/img/delete.svg" width="20"></a>
                    </td>
                    </tr>
                    @endforeach
                    <tr>
                        <td colspan="1">Jumlah</td>
                        <th colspan="9" class="text-left">{{$total}}</th>
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