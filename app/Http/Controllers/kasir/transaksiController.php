<?php

namespace App\Http\Controllers\kasir;

use App\Helpers\Faktur;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\User;
use App\Models\Penjualan;
use App\Models\Buy;
use PDF;

class transaksiController extends Controller
{
    public function index()
    {
        $datas = Book::all();
        $users = User::where('akses','Kasir')->get();
        return view('dashboard.kasir.penjualan.index', compact('datas', 'users'));
    }

    public function check(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'jumlah_beli' => 'required|numeric',
            'id_kasir' => 'required',
        ]);
        $book = Book::where('judul', $request->judul)->get();
        foreach ($book as $bk) {
            $stok = $bk->stok;
        }
        if ($request->jumlah_beli > $stok) {
            return redirect()->route('kasir.penjualan')->with('fail', "Stok tidak cukup, stok tertisa tinggal {$stok}");
        }
        else{
            $buy = Penjualan::all();
            $id = count($buy);
            $faktur_kode = Faktur::IDGenerator(new Buy, 'kode_faktur', 8, 'FK', $id);
            Buy::create([
                'kode_faktur' => $faktur_kode,
                'judul' => $request->judul,
                'jumlah_beli' => $request->jumlah_beli,
                'kasir' => $request->id_kasir,
            ]);
            return redirect()->route('kasir.pembelian.add', $faktur_kode)->with('success', 'Silahkan lanjutkan proses pembelian. Abaikan 6 input pertama');
        }
    }

    public function confirmForm($kode)
    {
        $datas = Buy::where('kode_faktur',$kode)->get();
        foreach($datas as $dt){
            $book = $dt->judul;
            $jumlah = $dt->jumlah_beli;
        }
        $kode_buku = Book::where('judul', $book)->get();
        foreach($kode_buku as $kd){
            $kode = $kd->buku_kode;
            $harga = $kd->harga_jual;
            $diskon = $kd->diskon;
            $ppn = $kd->ppn;
        }
        $new_diskon = $harga*$diskon/100;
        $total = ($harga*$jumlah)+$ppn-$new_diskon;
        return view('dashboard.kasir.penjualan.transaksi', compact('datas', 'kode', 'total'));
    }

    public function checkOut(Request $request)
    {
        $request->validate([
            'bayar' => 'required',
            'tanggal' => 'required',
        ]);
        $book = Book::where('buku_kode', $request->buku_kode)->get();
        foreach ($book as $bk) {
            $stok = $bk->stok;
            $id = $bk->id;
        }
        $new_stok = $stok - $request->jumlah_beli;
        $bayar = $request->bayar;
        $total = $request->total_harga;
        $kembalian = $bayar - $total;
        Penjualan::create([
            'kode_faktur' => $request->kode_faktur,
            'buku_kode' => $request->buku_kode,
            'id_kasir' => $request->id_kasir,
            'jumlah_beli' => $request->jumlah_beli,
            'bayar' => $bayar,
            'kembalian' => $kembalian,
            'total_harga' => $total,
            'tanggal' => $request->tanggal,
        ]);
        $set_stok = Book::find($id);
        $set_stok->stok = $new_stok;
        $set_stok->save();
        $datas = Penjualan::where('kode_faktur', $request->kode_faktur)->get();
        return view('dashboard.kasir.penjualan.struk', compact('datas'));
    }

    public function struk()
    {
        $datas = Penjualan::orderBy('kode_faktur', 'desc')->first()->get();
        foreach($datas as $data){
            $kode_faktur = $data->kode_faktur;
            $tanggal = $data->tanggal;
            $username = $data->kasir['name'];
            $judul = $data->book['judul'];
            $jumlah_beli = $data->jumlah_beli;
            $total_harga = $data->total_harga;
            $bayar = $data->bayar;
            $kembalian = $data->kembalian;
        }
        return view('dashboard.kasir.penjualan.struk_cek', compact('kode_faktur','tanggal','username','judul','jumlah_beli','total_harga','bayar','kembalian'));
    }

    public function cetakStruk()
    {
        $datas = Penjualan::orderBy('kode_faktur', 'desc')->first()->get();
        foreach ($datas as $data) {
            $kode_faktur = $data->kode_faktur;
            $tanggal = $data->tanggal;
            $username = $data->kasir['name'];
            $judul = $data->book['judul'];
            $jumlah_beli = $data->jumlah_beli;
            $total_harga = $data->total_harga;
            $bayar = $data->bayar;
            $kembalian = $data->kembalian;
        }
        $pdf = PDF::loadView('dashboard.kasir.penjualan.struk_cetak', compact('kode_faktur', 'tanggal', 'username', 'judul', 'jumlah_beli', 'total_harga', 'bayar', 'kembalian'));
        return $pdf->download('struk_pembelian.pdf');
    }

    public function allData()
    {
        $hitung = Penjualan::all();
        $datas = Penjualan::latest()->simplePaginate(10);
        $no = 1;
        $total = count($hitung);
        return view('dashboard.kasir.penjualan.data', compact('datas', 'no', 'total'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function cetakData()
    {
        $datas = Penjualan::all();
        $no = 1;
        $total = count($datas);
        $pdf = PDF::loadView('dashboard.kasir.penjualan.data_cetak', compact('datas', 'no', 'total'));
        return $pdf->download('data_pembelian.pdf');
    }

    public function searchData(Request $request)
    {
        $until = $request->until;
        $datas = Penjualan::where('tanggal', $until)->get();
        $total = count($datas);
        $no = 1;
        return view('dashboard.kasir.penjualan.data_filter', compact('datas', 'no', 'total','until'));
    }

    public function cetakDataFilter($tanggal)
    {
        $datas = Penjualan::where('tanggal', $tanggal)->get();
        $no = 1;
        $total = count($datas);
        $pdf = PDF::loadView('dashboard.kasir.penjualan.data_cetak', compact('datas', 'no', 'total'));
        return $pdf->download('data_pembelian_filter.pdf');
    }
}
