<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Mahasiswa;

use Illuminate\Support\Facades\DB;

class MahasiswaController extends Controller
{
    public function index(){
        $mahasiswa = Mahasiswa::all();
        return view('mahasiswa.index', compact('mahasiswa'));
    }

    public function create(){
        return view('mahasiswa.create');
    }

    public function store(Request $request){
        //Validasi Input
        $request -> validate([
            'nim' => 'required',
            'nama' => 'required',
            'email' => 'required',
            'jurusan' => 'required',
        ]);

        //Cara 1
        // $mahasiswa = Mahasiswa::create($request->all());


        //Cara 2 (ORM Eloquent SAVE)
        // $mahasiswa = new Mahasiswa;
        // $mahasiswa->nim = $request->nim;
        // $mahasiswa->nama = $request->nama;
        // $mahasiswa->email = $request->email;
        // $mahasiswa->jurusan = $request->jurusan;
        // $mahasiswa->save();

        //Cara 3
        DB::table('mahasiswa')->insert([
            'nim' => $request->nim,
            'nama' => $request->nama,
            'email' => $request->email,
            'jurusan' => $request->jurusan,
        ]);

        return redirect()->route('mahasiswa')->with("success", "Mahasiswa berhasil ditambahkan");
    }

    public function edit($id){
        $mhs = Mahasiswa::find($id);
        return view('mahasiswa.edit', compact('mhs'));
    }

    public function update(Request $request, $id){
        $request -> validate([
            'nim' => 'required',
            'nama' => 'required',
            'email' => 'required',
            'jurusan' => 'required',
        ]);

        $update = [
            'nim' => $request->nim,
            'nama' => $request->nama,
            'email' => $request->email,
            'jurusan' => $request->jurusan,
        ];
        Mahasiswa::whereId($id)->update($update);

        return redirect()->route("mahasiswa")->with('success','Mahasiswa updated successfully');
    }

    public function destroy($id){
        $mhs  = Mahasiswa::find($id);
        $mhs -> delete();
        return redirect()->route('mahasiswa')->with('success', 'Mahasiswa deleted successfully');
    }
}
