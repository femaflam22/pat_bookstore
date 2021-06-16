<!doctype html>
<html lang="en">
<head>
    <title>Admin</title>
</head>
<body>
    <h2 style="text-align: center;">Data Pasok</h2>
    <div class="konten">
        <table style="text-align: center;" border="1">
            <thead>
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
                </tr>
                @endforeach
                <tr>
                    <td colspan="2">Jumlah</td>
                    <th colspan="10">{{$total}}</th>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>