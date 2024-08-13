<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\Stmt\TryCatch;

class KaryawanController extends Controller
{
    public function index(){
        $karyawan = DB::table('karyawan')->orderBy('nama_lengkap')
        ->join('departemen','karyawan.kode_dept','=','departemen.kode_dept')
        ->get();

        $departemen = DB::table('departemen')->get();
        $presensi = DB::table('pelanggan')->orderBy('kode_pelanggan')->get();
        return view('karyawan.index', compact('karyawan','departemen','presensi'));
    }

    public function store(Request $request){
        $nik = $request->nik;
        $nama_lengkap = $request->nama_lengkap;
        $jabatan = $request->jabatan;
        $no_hp = $request->no_hp;
        $kode_dept = $request->kode_dept;
        $password = Hash::make('12345');
        $kode_pelanggan = $request->kode_pelanggan;
        if($request->hasFile('foto')){
            $foto = $nik.".".$request->file('foto')->getClientOriginalExtension();
        }else{
            $foto = null;
        }

        try {
            $data =[
                'nik'=>$nik,
                'nama_lengkap'=>$nama_lengkap,
                'jabatan'=>$jabatan,
                'no_hp'=>$no_hp,
                'kode_dept'=>$kode_dept,
                'foto'=>$foto,
                'password'=>$password,
                'kode_pelanggan'=>$kode_pelanggan
            ];
            $simpan = DB::table('karyawan')->insert($data);
            if($simpan){
                if($request->hasFile('foto')){
                    $folderPath = "public/uploads/karyawan/";
                    $request->file('foto')->storeAs($folderPath,$foto);
                }
                return Redirect::back()->with(['success'=>'Data berhasil disimpan']);
            }
        } catch (\Exception $e) {
            //throw $th;
            // dd($e);
            if($e->getCode()==23000){
                $message = " (Data dengan NIK ".$nik." sudah ada)";
            }
            return Redirect::back()->with(['warning'=>'Data gagal disimpan'.$message]);
        }
    }

    public function edit(Request $request){
        $nik = $request->nik;
        $departemen = DB::table('departemen')->get();
        $karyawan = DB::table('karyawan')->where('nik',$nik)->first();
        $presensi = DB::table('pelanggan')->orderBy('kode_pelanggan')->get();
        return view('karyawan.edit', compact('departemen','karyawan','presensi'));
    }

    public function update($nik,Request $request){
        $nik = $request->nik;
        $nama_lengkap = $request->nama_lengkap;
        $jabatan = $request->jabatan;
        $no_hp = $request->no_hp;
        $kode_dept = $request->kode_dept;
        $kode_pelanggan = $request->kode_pelanggan;
        // $password = Hash::make('12345');
        $old_foto = $request->old_foto;
        if($request->hasFile('foto')){
            $foto = $nik.".".$request->file('foto')->getClientOriginalExtension();
        }else{
            $foto = $old_foto;
        }

        // if(empty($request->password)){
        //     $data = [
        //         'nama_lengkap'=>$nama_lengkap,
        //         'jabatan'=>$jabatan,
        //         'no_hp'=>$no_hp,
        //         'kode_dept'=>$kode_dept,
        //         'foto'=>$foto,
        //         'kode_pelanggan'=>$kode_pelanggan
        //         ] ;
        //     }else {
        //         $data = [
        //             'nama_lengkap'=>$nama_lengkap,
        //             'jabatan'=>$jabatan,
        //             'no_hp'=>$no_hp,
        //             'kode_dept'=>$kode_dept,
        //             'foto'=>$foto,
        //             'password'=>$password,
        //             'kode_pelanggan'=>$kode_pelanggan
        //     ] ;
        // } salah abaikan saja

        try {
            $data =[
                'nama_lengkap'=>$nama_lengkap,
                'jabatan'=>$jabatan,
                'no_hp'=>$no_hp,
                'kode_dept'=>$kode_dept,
                'foto'=>$foto,
                // 'password'=>$password,
                'kode_pelanggan'=>$kode_pelanggan
            ];
            $update = DB::table('karyawan')->where('nik',$nik)->update($data);
            if($update){
                if($request->hasFile('foto')){
                    $folderPath = "public/uploads/karyawan/";
                    $folderPathOld = "public/uploads/karyawan/".$old_foto;
                    Storage::delete($folderPathOld);
                    $request->file('foto')->storeAs($folderPath,$foto);
                }
                return Redirect::back()->with(['success'=>'Data berhasil diupdate']);
            }
        } catch (\Exception $e) {
            //throw $th;
            // dd($e);
            return Redirect::back()->with(['warning'=>'Data gagal diupdate']);
        }
    }

    public function delete($nik){
        $delete = DB::table('karyawan')->where('nik',$nik)->delete();
        if($delete){
            return Redirect::back()->with(['success'=>'Data berhasil dihapus']);
        }else{
            return Redirect::back()->with(['warning'=>'Data gagal dihapus']);
            
        }
    }
    
}
