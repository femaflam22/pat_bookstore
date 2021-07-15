<?php

namespace App\Http\Controllers\manager;

use App\Helpers\Helper;
use App\Helpers\UserKode;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Penjualan;
use App\Models\Book;
use App\Models\Distributor;
use App\Models\Pasok;
use PDF;

class managerController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'telp' => 'required',
            'status' => 'required',
            'username' => 'required|unique:users,username|max:15|min:8',
            'password' => 'required|min:8|max:15',
            'akses' => 'required'
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->address = $request->address;
        $user->telp = $request->telp;
        $user->status = $request->status;
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->akses = $request->akses;
        $getUser = User::all();
        $id = count($getUser);
        if($user->akses == 'Kasir'){
            $user->kode_user = UserKode::IDGenerator(new User, 'kode_user', 4, 'KS', $id);
            $save = $user->save();
        } else if($user->akses == 'Admin') {
            $user->kode_user = UserKode::IDGenerator(new User, 'kode_user', 4, 'AD', $id);
            $save = $user->save();
        } else {
            $user->kode_user = UserKode::IDGenerator(new User, 'kode_user', 4, 'MN', $id);
            $save = $user->save();
        }

        if ($save) {
            return redirect()->back()->with('success', 'Akun berhasil didaftarkan!');
        } else {
            return redirect()->back()->with('fail', 'Gagal membuat Akun, coba ulang!');
        }
    }

    public function check(Request $request)
    {
        $request->validate([
            'username' => 'required|exists:users,username|max:15|min:8',
            'password' => 'required|min:8|max:15',
            'akses' => 'required'
        ], [
            'username.exists' => "This username doesn't exists"
        ]);

        $users = $request->only('username', 'password', 'akses');
        if ($request->akses === 'Manager') {
            if (Auth::guard('manager')->attempt($users)) {
                return redirect()->route('manager.home');
            } else {
                return redirect()->route('manager.login')->with('fail', "Gagal login, periksa dan coba lagi!");
            }
        } else {
            return redirect()->route('manager.login')->with('error', "Gagal, pastikan datamu benar dan kamu bagian manager!");
        }
    }

    public function logout()
    {
        Auth::guard('manager')->logout();
        return redirect('/');
    }

    public function ubahPassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'password' => 'required|min:8|max:15|confirmed',
        ]);

        $currentPassword = auth::user()->password;
        $old_password = $request->old_password;
        if (Hash::check($old_password, $currentPassword)) {
            auth()->user()->update([
                'password' => bcrypt($request->password),
            ]);
            return redirect()->back()->with('success', 'Password berhasil diubah');
        } else {
            return redirect()->back()->with('fail', 'Gagal mengubah password, periksa dan coba lagi!');
        }
    }

    public function getFaktur()
    {
        $datas = Penjualan::orderBy('kode_faktur', 'desc')->limit(1)->get();
        return view('dashboard.manager.laporan.struk', compact('datas'));
    }

    public function cetakFaktur()
    {
        $datas = Penjualan::orderBy('kode_faktur', 'desc')->limit(1)->get();
        foreach ($datas as $data) {
            $kode_faktur = $data->kode_faktur;
            $tanggal = $data->tanggal;
            $username = $data->getKasir['name'];
            $judul = $data->book['judul'];
            $jumlah_beli = $data->jumlah_beli;
            $total_harga = $data->total_harga;
            $bayar = $data->bayar;
            $kembalian = $data->kembalian;
        }
        $pdf = PDF::loadView('dashboard.manager.laporan.struk_cetak', compact('kode_faktur', 'tanggal', 'username', 'judul', 'jumlah_beli', 'total_harga', 'bayar', 'kembalian'));
        return $pdf->download('struk_pembelian.pdf');
    }

    public function dataPenjualan()
    {
        $hitung = Penjualan::all();
        $datas = Penjualan::latest()->simplePaginate(10);
        $no = 1;
        $total = count($hitung);
        return view('dashboard.manager.laporan.data_penjualan', compact('datas', 'no', 'total'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function cetakPenjualan()
    {
        $datas = Penjualan::all();
        $no = 1;
        $total = count($datas);
        $pdf = PDF::loadView('dashboard.manager.laporan.data_penjualan_cetak', compact('datas', 'no', 'total'));
        return $pdf->download('data_pembelian.pdf');
    }

    public function searchPenjualan(Request $request)
    {
        $until = $request->until;
        $datas = Penjualan::where('tanggal', $until)->get();
        $total = count($datas);
        $no = 1;
        return view('dashboard.manager.laporan.penjualan_filter', compact('datas', 'no', 'total', 'until'));
    }

    public function cetakPenjualanFilter($tanggal)
    {
        $datas = Penjualan::where('tanggal', $tanggal)->get();
        $no = 1;
        $total = count($datas);
        $pdf = PDF::loadView('dashboard.manager.laporan.data_penjualan_cetak', compact('datas', 'no', 'total'));
        return $pdf->download('data_pembelian_filter.pdf');
    }

    public function dataBuku()
    {
        $hitung = Book::all();
        $datas = Book::orderBy('buku_kode', 'asc')->simplePaginate(5);
        $no = 1;
        $total = count($hitung);
        return view('dashboard.manager.laporan.data_buku', compact('datas', 'no', 'total'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function searchBuku(Request $request)
    {
        $search = $request->search;
        $datas = Book::where('judul', 'LIKE', "%{$search}%")->get();
        $no = 1;
        $total = count($datas);
        return view('dashboard.manager.laporan.data_buku_search', compact('datas', 'no', 'total', 'search'));
    }

    public function cetakBuku()
    {
        $books = Book::all();
        $no = 1;
        $total = count($books);
        $pdf = PDF::loadView('dashboard.manager.laporan.data_buku_cetak', compact('books', 'no', 'total'));
        return $pdf->download('data_buku.pdf');
    }

    public function orderDataBuku()
    {
        $books = Book::all();
        $datas = Book::orderBy('stok', 'asc')->simplePaginate(5);
        $no = 1;
        $total = count($books);
        return view('dashboard.manager.laporan.data_buku_order', compact('datas', 'no', 'total'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function cetakBukuOrder()
    {
        $books = Book::orderBy('stok', 'asc')->get();
        $no = 1;
        $total = count($books);
        $pdf = PDF::loadView('dashboard.manager.laporan.data_buku_cetak', compact('books', 'no', 'total'));
        return $pdf->download('data_buku_terurut.pdf');
    }

    public function cetakBukuSearch($judul)
    {
        $books = Book::where('judul',$judul)->get();
        $no = 1;
        $total = count($books);
        $pdf = PDF::loadView('dashboard.manager.laporan.data_buku_cetak', compact('books', 'no', 'total'));
        return $pdf->download('data_buku_search.pdf');
    }

    public function filterPenulis()
    {
        $books = Book::select('penulis')->distinct()->get();;
        return view('dashboard.manager.laporan.filter_penulis', compact('books'));
    }

    public function filterPenulisResult($penulis)
    {
        $books = Book::where('penulis', $penulis)->get();
        $total = count($books);
        $no = 1;
        $penulis = $penulis;
        return view('dashboard.manager.laporan.filter_penulis_result', compact('books', 'total', 'no', 'penulis'));
    }

    public function filterPenulisCetak($penulis)
    {
        $books = Book::where('penulis', $penulis)->get();
        $no = 1;
        $total = count($books);
        $penulis = $penulis;
        $pdf = PDF::loadView('dashboard.manager.laporan.filter_penulis_cetak', compact('books', 'no', 'total', 'penulis'));
        return $pdf->download('buku_per_penulis.pdf');
    }

    public function bukuTakterjual()
    {
        $books = Book::where('terjual', 0)->simplePaginate(5);
        $no = 1;
        $total = count($books);
        return view('dashboard.manager.laporan.buku_takterjual', compact('books', 'no', 'total'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function bukuTakterjualSearch(Request $request)
    {
        $search = $request->search;
        $books = Book::where('judul', 'LIKE', "%{$search}%")->get();
        $no = 1;
        $total = count($books);
        return view('dashboard.manager.laporan.buku_takterjual_search', compact('books', 'no', 'total'));
    }

    public function bukuTakterjualCetak()
    {
        $books = Book::where('terjual', 0)->get();
        $no = 1;
        $total = count($books);
        $pdf = PDF::loadView('dashboard.manager.laporan.buku_takterjual_cetak', compact('books', 'no', 'total'));
        return $pdf->download('data_buku_takterjual.pdf');
    }

    public function bukuTerjual()
    {
        $books = Book::where('terjual', '>', 0)->orderBy('stok', 'desc')->simplePaginate(5);
        $no = 1;
        $total = count($books);
        return view('dashboard.manager.laporan.buku_terjual', compact('books', 'no', 'total'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function bukuTerjualSearch(Request $request)
    {
        $search = $request->search;
        $books = Book::where('judul', 'LIKE', "%{$search}%")->get();
        $no = 1;
        $total = count($books);
        return view('dashboard.manager.laporan.buku_terjual_search', compact('books', 'no', 'total'));
    }

    public function bukuTerjualCetak()
    {
        $books = Book::where('terjual', '>', 0)->orderBy('stok', 'desc')->simplePaginate(5);
        $no = 1;
        $total = count($books);
        $pdf = PDF::loadView('dashboard.manager.laporan.buku_terjual_cetak', compact('books', 'no', 'total'));
        return $pdf->download('data_buku_terjual.pdf');
    }

    public function dataPasok()
    {
        $datas = Pasok::orderBy('id', 'desc')->simplePaginate(5);
        $no = 1;
        $total = count($datas);
        return view('dashboard.manager.laporan.data_pasok', compact('datas', 'no', 'total'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function searchPasok(Request $request)
    {
        $from = $request->from;
        $until = $request->until;
        $datas = Pasok::where('tanggal', '>=', $from)->where('tanggal', '<=', $until)->get();
        $no = 1;
        $total = count($datas);
        return view('dashboard.manager.laporan.data_pasok_search', compact('datas', 'no', 'total', 'from', 'until'));
    }

    public function cetakPasok()
    {
        $datas = Pasok::all();
        $no = 1;
        $total = count($datas);
        $pdf = PDF::loadView('dashboard.manager.laporan.data_pasok_cetak', compact('datas', 'total', 'no'));
        return $pdf->download('data_pasok.pdf');
    }

    public function cetakPasokSearch(Request $request)
    {
        $from = $request->from;
        $until = $request->until;
        $datas = Pasok::where('tanggal', '>=', $from)->where('tanggal', '<=', $until)->get();
        $no = 1;
        $total = count($datas);
        $pdf = PDF::loadView('dashboard.manager.laporan.data_pasok_search_cetak', compact('datas', 'no', 'total', 'from', 'until'));
        return $pdf->download('data_pasok_pertanggal.pdf');
    }

    public function pasokFilter()
    {
        $data = Distributor::all();
        return view('dashboard.manager.laporan.filter_pasok', compact('data'));
    }

    public function pasokFilterResult($nama_distributor)
    {
        $distri = Distributor::where('nama_distributor', $nama_distributor)->get();
        foreach ($distri as $book) {
            $kode = $book->kode_distributor;
        }
        $data_pasok = Pasok::where('kode_distributor', $kode)->get();
        $total = count($data_pasok);
        $no = 1;
        $nama = $nama_distributor;
        return view('dashboard.manager.laporan.filter_pasok_result', compact('data_pasok', 'total', 'no', 'nama'));
    }

    public function cetakFilterPasok($nama)
    {
        $distri = Distributor::where('nama_distributor', $nama)->get();
        foreach ($distri as $dt) {
            $id = $dt->kode_distributor;
        }
        $datas = Pasok::where('kode_distributor', $id)->get();
        $no = 1;
        $total = count($datas);
        $nama = $nama;
        $pdf = PDF::loadView('dashboard.manager.laporan.filter_pasok_cetak', compact('datas', 'total', 'no', 'nama'));
        return $pdf->download('pasok_per_distributor.pdf');
    }

    public function getUser()
    {
        $datas = User::orderBy('name', 'asc')->simplePaginate(5);
        $no = 1;
        $total = count($datas);
        return view('dashboard.manager.laporan.data_user', compact('datas','no','total'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function cetakUser()
    {
        $datas = User::all();
        $no = 1;
        $total = count($datas);
        $pdf = PDF::loadView('dashboard.manager.laporan.data_user_cetak', compact('datas', 'total', 'no'));
        return $pdf->download('data_user.pdf');
        // return view('dashboard.manager.laporan.data_user_cetak', compact('datas', 'total', 'no'));
    }

    public function searchUser(Request $request)
    {
        $search = $request->search;
        $datas = User::where('name','LIKE', "%{$search}%")->get();
        $no = 1;
        $total = count($datas);
        return view('dashboard.manager.laporan.data_user_search', compact('datas', 'no', 'total', 'search'));
    }

    public function searchUserCetak($nama)
    {
        $datas = User::where('name', 'LIKE', "%{$nama}%")->get();
        $no = 1;
        $total = count($datas);
        $pdf = PDF::loadView('dashboard.manager.laporan.data_user_cetak', compact('datas', 'total', 'no'));
        return $pdf->download('data_user.pdf');
    }

    public function editUser()
    {
        $datas = User::all();
        return view('dashboard.manager.user_edit', compact('datas'));
    }

    public function editUserSelected(Request $request)
    {
        $data = User::where('username', $request->username)->get();
        foreach($data as $dt){
            $id = $dt->id;
        }
        return redirect()->route('manager.user.update',$id);
    }

    public function updateUser($id)
    {
        $data = User::where('id', $id)->get();
        $id_user = $id;
        return view('dashboard.manager.register_edit', compact('data', 'id_user'));
    }

    public function updated(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'telp' => 'required',
            'status' => 'required',
            'akses' => 'required'
        ]);
        $data = User::find($request->id);
        $data->name = $request->name;
        $data->address = $request->address;
        $data->telp = $request->telp;
        $data->status = $request->status;
        $data->akses = $request->akses;
        $data->save();
        return redirect()->route('manager.user.edit')->with('success', 'berhasil mengubah data user');
    }

    public function deleteUser($id)
    {
        User::where('id',$id)->delete();
        return redirect()->back()->with('success', 'berhasil menghapus data user');
    }
}
