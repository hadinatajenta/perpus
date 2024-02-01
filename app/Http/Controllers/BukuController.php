<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\KategoriBuku;
use DateTime;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class BukuController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function halaman_buku():View
    {
        $buku = Buku::paginate(10);
        $kategori = KategoriBuku::all();
        return view('Admin.buku', compact('buku', 'kategori'));
    }

    public function create_buku(Request $request)
    {
    
        // merubah format tanggal dari DD-MM-YYYY ke DD-MM-YYYY YYYY-MM-DD
        $tahun_terbit= DateTime::createFromFormat('d/m/Y', $request->tahun_terbit);
        $formattanggal = $tahun_terbit ? $tahun_terbit->format('Y-m-d') : null;

        // Masukkan data buku   
        $buku = new Buku([
            'buku' => $request->buku,
            'pengarang' => $request->pengarang,
            'ISBN' => $request->ISBN,
            'penerbit' => $request->penerbit,
            'tahun_terbit' => $formattanggal,
            'kategori_id' => $request->kategori_id,
            'stock_buku' => '1'
        ]);
        $buku->save();


        // tambahkan jumlah buku pada kategori 
        if($buku->save()){
            $kategori_id = KategoriBuku::find($request->kategori_id);
            $kategori_id->jumlah_buku +=1;
            $kategori_id->save();
        }
        return redirect()->back()->with('success','Berhasil menambahkan buku baru');
    }

    public function edit_buku(Request $request, $id)
    {
        $edit = Buku::findOrFail($id);
        if ($edit) {
            // Cek apakah kategori berubah
            $kategoriLama = $edit->kategori_id;
            $kategoriBaru = $request->kategori_id;
    
            $edit->buku = $request->buku;
            $edit->pengarang = $request->pengarang;
            $edit->ISBN = $request->ISBN;
            $edit->penerbit = $request->penerbit;
            $edit->tahun_terbit = $request->tahun_terbit; 
            $edit->kategori_id = $kategoriBaru;
            $edit->stock_buku = $request->stock_buku;
            $edit->save();
    
            // Jika kategori berubah, perbarui jumlah buku di kedua kategori
            if ($kategoriLama !== $kategoriBaru) {
                $kategoriLamaModel = KategoriBuku::find($kategoriLama);
                $kategoriBaruModel = KategoriBuku::find($kategoriBaru);
    
                if ($kategoriLamaModel && $kategoriBaruModel) {
                    $kategoriLamaModel->jumlah_buku -= 1;
                    $kategoriBaruModel->jumlah_buku += 1;
    
                    $kategoriLamaModel->save();
                    $kategoriBaruModel->save();
                }
            }
    
            return redirect()->back()->with('success', 'Berhasil memperbarui data buku');
        }else{
            return redirect()->back()->with('error','Gagal, buku tidak ditemukan!');
        }
    }

    public function delete($id)
    {
        $books = Buku::findOrFail($id);
        $kategori = KategoriBuku::findOrFail($books->kategori_id);
        if($books){
            $books->delete();
            $kategori->jumlah_buku -=1;
            $kategori->save();
            return redirect()->back()->with('success','berhasil menghapus buku!');
        }else{
            return redirect()->back()->with('error','buku tidak ditemukan!');
        }
    }
}
