<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Distributor;
use App\Helpers\Distri;

class distributorController extends Controller
{

    public function index(Request $request)
    {
        $search = $request->search;
        if ($search !== "") {
            $distributors = Distributor::where('nama_distributor', 'LIKE', "%{$search}%")->simplePaginate(5);
        } else {
            $distributors = Distributor::latest()->simplePaginate(5);
        }
        return view('dashboard.admin.distributor.distributor', compact('distributors'));
    }

    public function addDistributor(Request $request)
    {
        $request->validate([
            'nama_distributor' => 'required|min:5',
            'alamat' => 'required',
            'telpon' => 'required',
        ]);

        $dtbt = new Distributor();
        $dtbt->nama_distributor = $request->nama_distributor;
        $dtbt->alamat = $request->alamat;
        $dtbt->telpon = $request->telpon;
        $getUser = Distributor::all();
        $id = count($getUser);
        $dtbt->kode_distributor = Distri::IDGenerator(new Distributor(), 'kode_user', 4, 'DB', $id);
        $save = $dtbt->save();
        return redirect()->back()->with('success', 'berhasil menambahkan data');
    }

    public function edit($distributor)
    {
        $data = Distributor::where('id', $distributor)->firstOrFail();
        // dd($data->nama_distributor);
        return view('dashboard.admin.distributor.distributor_edit', compact('data'));
    }

    public function update(Request $request, $distributor)
    {
        $request->validate([
            'nama_distributor' => 'required|min:5',
            'alamat' => 'required',
            'telpon' => 'required',
        ]);
        $data = Distributor::where('id', $distributor)->firstOrFail();
        $data->update($request->all());
        return redirect()->route('admin.distributor')->with('success', 'berhasil mengubah data');
    }

    public function destroy($distributor)
    {
        $data = Distributor::where('id', $distributor)->firstOrFail();
        $data->delete();
        return redirect()->back()->with('success', 'berhasil menghapus data');
    }
}
