<!doctype html>
<html lang="en">
<head>
    <title>Kasir</title>
</head>
<body>
    <h2 style="text-align: center;">Struk Pembelian</h2>
    <div class="konten">
        <table style="text-align: center;" border="1">
                    <tr>
                    <th colspan="2">No Faktur</th>
                    <td colspan="2">{{$kode_faktur}}</td>
                    <th colspan="2">Tanggal</th>
                    <td colspan="2">{{$tanggal}}</td>
                    <th scope="col">Kasir</th>
                    <td scope="col">{{$username}}</td>
                    </tr>
                    <tr>
                    <th colspan="2">Judul Buku</th>
                    <td colspan="2">{{$judul}}</td>
                    <th colspan="2">Jumlah Beli</th>
                    <td colspan="2">{{$jumlah_beli}}</td>
                    <th colspan="2">Total Harga</th>
                    <td colspan="2">{{$total_harga}}</td>
                    </tr>
                    <tr>
                    <th colspan="2">Bayar</th>
                    <td colspan="2">{{$bayar}}</td>
                    <th colspan="2">Kembalian</th>
                    <td colspan="2">{{$kembalian}}</td>
                    </tr>
                </table>
    </div>
</body>
</html>