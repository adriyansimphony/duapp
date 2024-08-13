<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class DepartemenController extends Controller
{
    public function index(){
        $departemen = DB::table('departemen')->orderBy('kode_dept')->get();
        return view('departemen.index',compact('departemen'));
    }

    public function store(Request $request){
        $kode_dept = $request->kode_dept;
        $nama_dept = $request->nama_dept;
        $data = [
            'kode_dept' => $kode_dept,
            'nama_dept' => $nama_dept
        ];

        $cek = DB::table('departemen')->where('kode_dept',$kode_dept)->count();
        if($cek>0){
            return Redirect::back()->with(['warning'=>'Data dengan kode dept. '.$kode_dept.' sudah ada']);
        }
        $simpan = DB::table('departemen')->insert($data);
        if($simpan){
            return Redirect::back()->with(['success'=>'Data berhasil disimpan']);
        }else {
            return Redirect::back()->with(['warning'=>'Data gagal disimpan']);

        }
    }

    public function edit(Request $request){
        $kode_dept = $request->kode_dept;
        $departemen = DB::table('departemen')->where('kode_dept',$kode_dept)->first();
        return view('departemen.edit',compact('departemen'));
    }

    public function update($kode_dept, Request $request){
        $nama_dept = $request->nama_dept;
        $data = [
            'nama_dept'=>$nama_dept
        ];

        $update = DB::table('departemen')->where('kode_dept',$kode_dept)->update($data);
        if($update){
            return Redirect::back()->with(['success'=>'Data berhasil diupdate']);
        }else {
            return Redirect::back()->with(['warning'=>'Data gagal diupdate']);

        }
    }
    
    public function delete($kode_dept){
        $hapus = DB::table('departemen')->where('kode_dept',$kode_dept)->delete();
        if($hapus){
            return Redirect::back()->with(['success'=>'Data berhasil dihapus']);
        }else {
            return Redirect::back()->with(['warning'=>'Data gagal dihapus']);
        }

    }
}
