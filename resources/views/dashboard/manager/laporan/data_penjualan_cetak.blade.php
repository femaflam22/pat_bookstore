<!doctype html>
<html lang="en">
<head>
    <title>Manager</title>
</head>
<body>
    <h2 style="text-align: center;">Data Pembelian</h2>
    <div class="konten">
        <table style="text-align: center;" border="1">
                <thead class="thead-light">
                    <tr>
                    <th>No</th>
                    <th>Kode Faktur</th>
                    <th>Judul</th>
                    <th>Kasir</th>
                    <th>Jumlah Beli</th>
                    <th>Total Harga</th>
                    <th>Bayar</th>
                    <th>Kembalian</th>
                    <th>Tanggal</th>
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
    </div>
</body>
</html>