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
                        <font size="4" style="font-family: Times New Roman">Laporan Data Pasok Per Distributor</font><br>
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
                    <th style="padding: 15px 5px;">Nama Distributor</th>
                    <th style="padding: 15px 5px;">Judul</th>
                    <th style="padding: 15px 5px;">No ISBN</th>
                    <th style="padding: 15px 5px;">Penulis</th>
                    <th style="padding: 15px 5px;">Penerbit</th>
                    <th style="padding: 15px 5px;">Harga Jual</th>
                    <th style="padding: 15px 5px;">Stok</th>
                    <th style="padding: 15px 5px;">Jumlah Pasok</th>
                    <th style="padding: 15px 5px;">Tanggal</th>
                </tr>
            </thead>
                <tbody style="text-align: center;">
                    @foreach ($data_pasok as $data)
                    <tr style="border-bottom: 1px solid #333">
                        <td style="padding: 8px 5px;">{{$no++}}</td>
                        <td style="padding: 8px 5px;">{{$data->distributor['nama_distributor']}}</td>
                        <td style="padding: 8px 5px;">{{$data->book['judul']}}</td>
                        <td style="padding: 8px 5px;">{{$data->book['noisbn']}}</td>
                        <td style="padding: 8px 5px;">{{$data->book['penulis']}}</td>
                        <td style="padding: 8px 5px;">{{$data->book['penerbit']}}</td>
                        <td style="padding: 8px 5px;">{{$data->book['harga_jual']}}</td>
                        <td style="padding: 8px 5px;">{{$data->book['stok']}}</td>
                        <td style="padding: 8px 5px;">{{$data->jumlah}}</td>
                        <td style="padding: 8px 5px;">{{$data->tanggal}}</td>
                    </tr>
                    @endforeach
                    <tr>
                        <td colspan="2" style="text-align: center; font-weight: bold; padding: 8px 0">Jumlah</td>
                        <th colspan="8" style="text-align: left; padding: 8px 0 8px 20px;">{{$total}}</th>
                    </tr>
                </tbody>
        </table>
    </center>
    <div style="margin-left: 70%">
        <table>
            <tr>
                <td>Di Cetak Oleh : <br><br><br><br>{{ Auth::guard('admin')->user()->name }}<br><br>( <i>{{ now()->day }} - {{ now()->month }} - {{ now()->year }}</i> )</td>
            </tr>
        </table>
    </div>
</body>
</html>