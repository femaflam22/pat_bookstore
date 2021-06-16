<!doctype html>
<html lang="en">
<head>
    <title>Manager</title>
</head>
<body>
    <h2 style="text-align: center;">Data Buku</h2>
    <div class="konten">
        <table style="text-align: center;" border="1">
            <thead class="thead-light">
                <tr>
                    <th>No</th>
                    <th>Kode Buku</th>
                    <th>Judul</th>
                    <th>No ISBN</th>
                    <th>Penulis</th>
                    <th>Penerbit</th>
                    <th>Tahun</th>
                    <th>Stok</th>
                    <th>Harga Pokok</th>
                    <th>Harga Jual</th>
                    <th>PPN</th>
                    <th>Diskon</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($books as $book)
                    <tr>
                    <td>{{$no++}}</td>
                    <td>{{$book->buku_kode}}</td>
                    <td>{{$book->judul}}</td>
                    <td>{{$book->noisbn}}</td>
                    <td>{{$book->penulis}}</td>
                    <td>{{$book->penerbit}}</td>
                    <td>{{$book->tahun}}</td>
                    <td>{{$book->stok}}</td>
                    <td>{{$book->harga_pokok}}</td>
                    <td>{{$book->harga_jual}}</td>
                    <td>{{$book->ppn}}</td>
                    <td>{{$book->diskon}}</td>
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