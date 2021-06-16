<!doctype html>
<html lang="en">
<head>
    <title>Manager</title>
</head>
<body>
    <h2 style="text-align: center;">Data User</h2>
    <div class="konten">
        <table style="text-align: center;" border="1">
            <thead class="thead-light">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Username</th>
                    <th>Alamat</th>
                    <th>No Telpon</th>
                    <th>Status</th>
                    <th>Akses</th>
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
                    </tr>
                    @endforeach
                    <tr>
                        <td colspan="2">Jumlah</td>
                        <th colspan="10" class="text-left">{{$total}}</th>
                    </tr>
                </tbody>
        </table>
    </div>
</body>
</html>