<!doctype html>
<html lang="en">
<head>
    <title>Admin</title>
</head>
<body>
    <h2 style="text-align: center;">Data Pasok {{$from}} Sampai {{$until}}</h2>
    <div class="konten">
        <table style="text-align: center;" border="1">
          <thead>
                    <tr>
                    <th>No</th>
                    <th>Nama Distributor</th>
                    <th>Judul</th>
                    <th>No ISBN</th>
                    <th>Penulis</th>
                    <th>Penerbit</th>
                    <th>Harga Jual</th>
                    <th>Stok</th>
                    <th>Jumlah Pasok</th>
                    <th>Tanggal</th>
                    </tr>
                </thead>
          <tbody>
                    @foreach ($datas as $db)
                    <tr>
                    <td>{{$no}}</td>
                    <td>{{$db->distributor['nama_distributor']}}</td>
                    <td>{{$db->book['judul']}}</td>
                    <td>{{$db->book['noisbn']}}</td>
                    <td>{{$db->book['penulis']}}</td>
                    <td>{{$db->book['penerbit']}}</td>
                    <td>{{$db->book['harga_jual']}}</td>
                    <td>{{$db->book['stok']}}</td>
                    <td>{{$db->jumlah}}</td>
                    <td>{{$db->tanggal}}</td>
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