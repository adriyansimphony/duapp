<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class PelangganController extends Controller
{
    public function index(){
        $pelanggan = DB::table('pelanggan')->orderBy('kode_pelanggan')->get();
        return view('pelanggan.index', compact('pelanggan'));
    }

    public function store(Request $request){
        $kode_pelanggan = $request->kode_pelanggan;
        $nama_pelanggan = $request->nama_pelanggan;
        $lokasi_pelanggan = $request->lokasi_pelanggan;
        $radius_pelanggan = $request->radius_pelanggan;

        try {
            $data = [
                'kode_pelanggan'=> $kode_pelanggan,
                'nama_pelanggan'=> $nama_pelanggan,
                'lokasi_pelanggan'=> $lokasi_pelanggan,
                'radius_pelanggan'=> $radius_pelanggan
            ];
            DB::table('pelanggan')->insert($data);
            return Redirect::back()->with(['success'=>'Data berhasil disimpan']);
        } catch (\Exception $e) {
            return Redirect::back()->with(['warning'=>'Data gagal disimpan']);
        }
    }

    public function edit(Request $request){
        $kode_pelanggan = $request->kode_pelanggan;
        $pelanggan = DB::table('pelanggan')->where('kode_pelanggan', $kode_pelanggan)->first();
        return view('pelanggan.edit',compact('pelanggan'));
    }

    public function update(Request $request){
        $kode_pelanggan = $request->kode_pelanggan;
        $nama_pelanggan = $request->nama_pelanggan;
        $lokasi_pelanggan = $request->lokasi_pelanggan;
        $radius_pelanggan = $request->radius_pelanggan;

        try {
            $data = [
                'nama_pelanggan'=> $nama_pelanggan,
                'lokasi_pelanggan'=> $lokasi_pelanggan,
                'radius_pelanggan'=> $radius_pelanggan
            ];
            DB::table('pelanggan')
            ->where('kode_pelanggan', $kode_pelanggan)
            ->update($data);
            return Redirect::back()->with(['success'=>'Data berhasil disimpan']);
        } catch (\Exception $e) {
            return Redirect::back()->with(['warning'=>'Data gagal disimpan']);
        }
    }

    public function delete($kode_pelanggan){
        $hapus = DB::table('pelanggan')->where('kode_pelanggan',$kode_pelanggan)->delete();
        if($hapus){
            return Redirect::back()->with(['success'=>'Data berhasil dihapus']);
        }else {
            return Redirect::back()->with(['warning'=>'Data gagal dihapus']);
        }

    }
}
