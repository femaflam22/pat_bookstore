<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use App\Models\Book;
use PDF;

class bukuController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        if($search !== ""){
            $books = Book::where('judul', 'LIKE', "%{$search}%")->simplePaginate(5);
        }
        else{
            $books = Book::orderBy('buku_kode', 'asc')->simplePaginate(5);
        }
        return view('dashboard.admin.buku.index', compact('books'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function add(Request $request)
    {
        $request->validate([
            'judul'=>'required',
            'noisbn'=>'required|min:8|max:13',
            'penulis'=>'required|min:4',
            'penerbit'=>'required|min:5',
            'tahun'=>'required|numeric',
            'stok'=>'required|numeric',
            'harga_pokok'=>'required|numeric',
            'harga_jual'=>'required|numeric',
            'ppn'=>'required|numeric',
            'diskon'=>'required|numeric',
        ]);

        $book = new Book;
        $id = $book->id+1;
        $book_id = Helper::IDGenerator(new Book, 'buku_kode', 5, 'BK', $id);
        $book->buku_kode = $book_id;
        $book->judul = $request->judul;
        $book->noisbn = $request->noisbn;
        $book->penulis = $request->penulis;
        $book->penerbit = $request->penerbit;
        $book->tahun = $request->tahun;
        $book->stok = $request->stok;
        $book->harga_pokok = $request->harga_pokok;
        $book->harga_jual = $request->harga_jual;
        $book->ppn = $request->ppn;
        $book->diskon = $request->diskon;
        $book->save();
        return redirect()->back()->with('success', 'berhasil menambahkan data');
    }

    public function edit($book_id)
    {
        $data = Book::where('id', $book_id)->firstOrFail();
        return view('dashboard.admin.buku.buku_edit', compact('data'));
    }

    public function update(Request $request, $buku)
    {
        $request->validate([
            'judul' => 'required',
            'noisbn' => 'required|min:13',
            'penulis' => 'required|min:4',
            'penerbit' => 'required|min:5',
            'tahun' => 'required|numeric',
            'stok' => 'required|numeric',
            'harga_pokok' => 'required|numeric',
            'harga_jual' => 'required|numeric',
            'ppn' => 'required|numeric',
            'diskon' => 'required|numeric',
        ]);
        $data = Book::where('id', $buku)->firstOrFail();
        $data->update($request->all());
        return redirect()->route('admin.buku')->with('success', 'berhasil mengubah data');
    }

    public function destroy($buku)
    {
        $data = Book::where('id', $buku)->firstOrFail();
        $data->delete();
        return redirect()->back()->with('success', 'berhasil menghapus data');
    }

    public function bookFilter()
    {
        $books = Book::select('penulis')->distinct()->get();
        return view('dashboard.admin.buku.buku_filter', compact('books'));
    }

    public function bookFilterReady($penulis)
    {
        $books = Book::where('penulis',$penulis)->get();
        $total = count($books);
        $no = 1;
        $penulis = $penulis;
        return view('dashboard.admin.buku.buku_filter_result', compact('books','total', 'no', 'penulis'));
    }

    public function bookFilterCetak($penulis)
    {
        $books = Book::where('penulis', $penulis)->get();
        $no = 1;
        $total = count($books);
        $penulis = $penulis;
        $pdf = PDF::loadView('dashboard.admin.buku.filter_cetak', compact('books','no','total','penulis'));
        return $pdf->download('buku_per_penulis.pdf');
    }

    public function allData()
    {
        $hitung = Book::all();
        $datas = Book::orderBy('buku_kode','asc')->simplePaginate(5);
        $no = 1;
        $total = count($hitung);
        return view('dashboard.admin.buku.data', compact('datas', 'no', 'total'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function cetakData()
    {
        $books = Book::all();
        $no = 1;
        $total = count($books);
        $pdf = PDF::loadView('dashboard.admin.buku.data_cetak', compact('books', 'no', 'total'));
        return $pdf->download('data_buku.pdf');
    }

    public function searchData(Request $request)
    {
        $search = $request->search;
        $datas = Book::where('judul', 'LIKE', "%{$search}%")->get();
        $no = 1;
        $total = count($datas);
        return view('dashboard.admin.buku.data_search', compact('datas', 'no', 'total', 'search'));
    }

    public function cetakSearchData($judul)
    {
        $books = Book::where('judul',$judul)->get();
        $no = 1;
        $total = count($books);
        $pdf = PDF::loadView('dashboard.admin.buku.data_cetak', compact('books', 'no', 'total'));
        return $pdf->download('data_buku_search.pdf');
    }

    public function orderData()
    {
        $books = Book::all();
        $datas = Book::orderBy('stok','asc')->simplePaginate(5);
        $no = 1;
        $total = count($books);
        return view('dashboard.admin.buku.data_order', compact('datas', 'no', 'total'))-> with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function cetakDataOrder()
    {
        $books = Book::orderBy('stok','asc')->get();
        $no = 1;
        $total = count($books);
        $pdf = PDF::loadView('dashboard.admin.buku.data_cetak', compact('books', 'no', 'total'));
        return $pdf->download('data_buku_terurut.pdf');
    }

    public function bukuTakterjual()
    {
        $books = Book::where('terjual', 0)->simplePaginate(5);
        $no = 1;
        $total = count($books);
        return view('dashboard.admin.buku.data_takterjual', compact('books','no','total'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function searchBukuTakterjual(Request $request)
    {
        $search = $request->search;
        $books = Book::where('judul', 'LIKE', "%{$search}%")->get();
        $no = 1;
        $total = count($books);
        return view('dashboard.admin.buku.data_takterjual_search', compact('books', 'no', 'total'));
    }

    public function bukuTakterjualCetak()
    {
        $books = Book::where('terjual', 0)->get();
        $no = 1;
        $total = count($books);
        $pdf = PDF::loadView('dashboard.admin.buku.takterjual_cetak', compact('books', 'no', 'total'));
        return $pdf->download('data_buku_takterjual.pdf');
    }

    public function bukuTerjual()
    {
        $books = Book::where('terjual', '>', 0)->orderBy('stok', 'desc')->simplePaginate(5);
        $no = 1;
        $total = count($books);
        return view('dashboard.admin.buku.data_terjual', compact('books', 'no', 'total'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function bukuTerjualSearch(Request $request)
    {
        $search = $request->search;
        $books = Book::where('judul', 'LIKE', "%{$search}%")->get();
        $no = 1;
        $total = count($books);
        return view('dashboard.admin.buku.data_terjual_search', compact('books', 'no', 'total'));
    }

    public function bukuTerjualCetak()
    {
        $books = Book::where('terjual', '>', 0)->get();
        $no = 1;
        $total = count($books);
        $pdf = PDF::loadView('dashboard.admin.buku.terjual_cetak', compact('books', 'no', 'total'));
        return $pdf->download('data_buku_terjual.pdf');
    }
}
