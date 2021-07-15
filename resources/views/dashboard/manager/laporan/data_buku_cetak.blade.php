<!doctype html>
<html lang="en">
<head>
    <title>Fema's Bookstore</title>
</head>
<body style="margin: 20px 0 0 0; padding: 0; box-sizing: border-box;">
    <div>
        <table style="margin-left: auto; margin-right: auto;">
            <tr>
                <td>
                    <img src="{{public_path('/img/logo.png')}}" width="130" height="130">
                </td>
                <td style="padding: 0 15px 0 0;">
                    <center>
                        <font size="4" style="font-family: Times New Roman">Laporan Data Buku</font><br>
                        <font size="5" style="line-height: 35px; font-family: Times New Roman">Fema's Bookstore</font><br>
                        <font size="2" style="font-family: Times New Roman"><i>Desa Cimande Hilir, Kec. Caringin Kab. Bogor, Jawa Barat (0231)050120</i></font>
                    </center>
                </td>
            </tr>
        </table>
    </div>
    <hr>
    <center>
        <table style="border-collapse: collapse; margin: 25px 0; font-size: 13px; font-family: sans-serif; margin-left: auto; margin-right: auto;" border="1">
            <thead style="background: #333; color: #fff; text-align: center; font-weight: bold;">
                <tr>
                    <th style="padding: 15px 5px;">No</th>
                    <th style="padding: 15px 5px;">Kode Buku</th>
                    <th style="padding: 15px 5px;">Judul</th>
                    <th style="padding: 15px 5px;">No ISBN</th>
                    <th style="padding: 15px 5px;">Penulis</th>
                    <th style="padding: 15px 5px;">Penerbit</th>
                    <th style="padding: 15px 5px;">Tahun</th>
                    <th style="padding: 15px 5px;">Stok</th>
                    <th style="padding: 15px 5px;">Harga Pokok</th>
                    <th style="padding: 15px 5px;">Harga Jual</th>
                    <th style="padding: 15px 5px;">PPN</th>
                    <th style="padding: 15px 5px;">Diskon</th>
                </tr>
            </thead>
                <tbody style="text-align: center;">
                    @foreach ($books as $book)
                    <tr style="border-bottom: 1px solid #333">
                        <td style="padding: 8px 5px;">{{$no++}}</td>
                        <td style="padding: 8px 5px;">{{$book->buku_kode}}</td>
                        <td style="padding: 8px 5px;">{{$book->judul}}</td>
                        <td style="padding: 8px 5px;">{{$book->noisbn}}</td>
                        <td style="padding: 8px 5px;">{{$book->penulis}}</td>
                        <td style="padding: 8px 5px;">{{$book->penerbit}}</td>
                        <td style="padding: 8px 5px;">{{$book->tahun}}</td>
                        <td style="padding: 8px 5px;">{{$book->stok}}</td>
                        <td style="padding: 8px 5px;">{{$book->harga_pokok}}</td>
                        <td style="padding: 8px 5px;">{{$book->harga_jual}}</td>
                        <td style="padding: 8px 5px;">{{$book->ppn}}</td>
                        <td style="padding: 8px 5px;">{{$book->diskon}}</td>
                    </tr>
                    @endforeach
                    <tr>
                        <td colspan="2" style="text-align: center; font-weight: bold; padding: 8px 0">Jumlah</td>
                        <th colspan="10" style="text-align: left; padding: 8px 0 8px 20px;">{{$total}}</th>
                    </tr>
                </tbody>
        </table>
    </center>
    <div style="margin-left: 70%">
        <table>
            <tr>
                <td>Di Cetak Oleh : <br><br><br><br>{{ Auth::guard('manager')->user()->name }}<br><br>( <i>{{ now()->day }} - {{ now()->month }} - {{ now()->year }}</i> )</td>
            </tr>
        </table>
    </div>
</body>
</html>