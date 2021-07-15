<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Distributor;
use App\Models\Pasok;
use PDF;

class pasokController extends Controller
{
    public function index()
    {
        $books = Book::all();
        $distributors = Distributor::all();
        $datas = Pasok::orderBy('id', 'desc')->simplePaginate(5);
        return view('dashboard.admin.pasok.index', compact('books','distributors','datas'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function add(Request $request)
    {
        $book = Book::where('buku_kode',$request->buku_kode)->get();
        foreach($book as $bk){
            $stok = $bk->stok;
            $id = $bk->id;
        }
        $new_stok = $stok+$request->jumlah;
        $request->validate([
            'buku_kode'=>'required',
            'kode_distributor'=>'required',
            'jumlah'=>'required',
            'tanggal'=>'required',
        ]);
        $set_stok = Book::find($id);
        $set_stok->stok = $new_stok;
        $set_stok->save();
        $pasok = new Pasok();
        $pasok->buku_kode = $request->buku_kode;
        $pasok->kode_distributor = $request->kode_distributor;
        $pasok->jumlah = $request->jumlah;
        $pasok->tanggal = $request->tanggal;
        $pasok->save();
        return redirect()->back()->with('success', 'berhasil menambahkan data');
    }

    public function edit($pasok_id)
    {
        $data = Pasok::where('id', $pasok_id)->firstOrFail();
        $distributors = Distributor::all();
        $books = Book::all();
        // dd($data->distributor['nama_distributor']);
        return view('dashboard.admin.pasok.pasok_edit', compact('data','distributors','books'));
    }

    public function update(Request $request, $pasok_id)
    {
        $request->validate([
            'buku_kode' => 'required',
            'kode_distributor' => 'required',
            'jumlah' => 'required',
            'tanggal' => 'required',
        ]);
        $data = Pasok::where('id', $pasok_id)->firstOrFail();
        $data->update($request->all());
        return redirect()->route('admin.pasok')->with('success', 'berhasil mengubah data');
    }

    public function destroy($pasok_id)
    {
        $data = Pasok::where('id', $pasok_id);
        $data->delete();
        return redirect()->back()->with('success', 'berhasil menghapus data');
    }

    public function pasokFilter()
    {
        $data = Distributor::all();
        return view('dashboard.admin.pasok.pasok_filter', compact('data'));
    }

    public function pasokFilterReady($nama_distributor)
    {
        $distri = Distributor::where('nama_distributor', $nama_distributor)->get();
        foreach($distri as $dt){
            $id= $dt->kode_distributor;
        }
        $data_pasok = Pasok::where('kode_distributor',$id)->get();
        $total = count($data_pasok);
        $no = 1;
        $nama = $nama_distributor;
        return view('dashboard.admin.pasok.pasok_filter_result', compact('data_pasok', 'total', 'no', 'nama'));
    }

    public function pasokFilterCetak($nama)
    {
        $distri = Distributor::where('nama_distributor', $nama)->get();
        foreach ($distri as $dt) {
            $id = $dt->kode_distributor;
        }
        $data_pasok = Pasok::where('kode_distributor', $id)->get();
        $no = 1;
        $total = count($data_pasok);
        $nama = $nama;
        $pdf = PDF::loadView('dashboard.admin.pasok.filter_cetak', compact('data_pasok', 'total', 'no', 'nama'));
        return $pdf->download('pasok_per_distributor.pdf');
    }

    public function allData()
    {
        $datas = Pasok::orderBy('id', 'desc')->simplePaginate(5);
        $no = 1;
        $total = count($datas);
        return view('dashboard.admin.pasok.all_data', compact('datas','no','total'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function cetakAll()
    {
        $datas = Pasok::all();
        $no = 1;
        $total = count($datas);
        $pdf = PDF::loadView('dashboard.admin.pasok.cetak_data', compact('datas', 'total', 'no'));
        return $pdf->download('data_pasok.pdf');
    }

    public function searchData(Request $request)
    {
        $from = $request->from;
        $until = $request->until;
        $datas = Pasok::where('tanggal', '>=', $from)->where('tanggal','<=',$until)->get();
        $no = 1;
        $total = count($datas);
        return view('dashboard.admin.pasok.data_pasok_search', compact('datas', 'no', 'total', 'from', 'until'));
    }

    public function searchDataCetak(Request $request)
    {
        $from = $request->from;
        $until = $request->until;
        $datas = Pasok::where('tanggal', '>=', $from)->where('tanggal', '<=', $until)->get();
        $no = 1;
        $total = count($datas);
        $pdf = PDF::loadView('dashboard.admin.pasok.pasok_search_cetak', compact('datas', 'no', 'total', 'from', 'until'));
        return $pdf->download('data_pasok_pertanggal.pdf');
    }

    public function searchPasok(Request $request)
    {
        $until = $request->until;
        $datas = Pasok::where('tanggal',$until)->simplePaginate(5);
        $books = Book::all();
        $distributors = Distributor::all();
        return view('dashboard.admin.pasok.index', compact('datas', 'distributors', 'books'));
    }
}
