<!doctype html>
<html lang="en">
<head>
    <title>Fema's Bookstore</title>
</head>
<body style="margin: 25px 0 0 0; padding: 0; box-sizing: border-box;">
    <h2 style="text-align: center;">Struk Pembelian</h2>
    <div class="konten" style="display: flex; justify-content: center;">
        <table style="border-collapse: collapse; margin: 25px 0; font-size: 1rem; border: 1px solid #333">
                    <tr>
                    <th style="padding: 15px 10px; text-align: center; border: 1px solid #333;">No Faktur</th>
                    <td style="padding: 15px 10px; text-align: center; border: 1px solid #333;">{{$kode_faktur}}</td>
                    <th style="padding: 15px 10px; text-align: center; border: 1px solid #333;">Tanggal</th>
                    <td style="padding: 15px 10px; text-align: center; border: 1px solid #333;">{{$tanggal}}</td>
                    <th style="padding: 15px 10px; text-align: center; border: 1px solid #333;">Judul Buku</th>
                    <td style="padding: 15px 10px; text-align: center; border: 1px solid #333;">{{$judul}}</td>
                    </tr>
                    <tr>
                    <th style="padding: 15px 10px; text-align: center; border: 1px solid #333;">Kasir</th>
                    <td style="padding: 15px 10px; text-align: center; border: 1px solid #333;">{{$username}}</td>
                    <th style="padding: 15px 10px; text-align: center; border: 1px solid #333;">Total Harga</th>
                    <td style="padding: 15px 10px; text-align: center; border: 1px solid #333;">{{$total_harga}}</td>
                    <th style="padding: 15px 10px; text-align: center; border: 1px solid #333;">Jumlah Beli</th>
                    <td style="padding: 15px 10px; text-align: center; border: 1px solid #333;">{{$jumlah_beli}}</td>
                    </tr>
                    <tr>
                    <th style="padding: 15px 10px; text-align: center; border: 1px solid #333;">Bayar</th>
                    <td style="padding: 15px 10px; text-align: center; border: 1px solid #333;">{{$bayar}}</td>
                    <th style="padding: 15px 10px; text-align: center; border: 1px solid #333;">Kembalian</th>
                    <td style="padding: 15px 10px; text-align: center; border: 1px solid #333;" colspan="3">{{$kembalian}}</td>
                    </tr>
                </table>
    </div>
</body>
</html>