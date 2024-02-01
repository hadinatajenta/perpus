<?php

namespace App\Http\Controllers;

use App\Models\KategoriBuku;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function kategori():View
    {
        $categories = KategoriBuku::paginate(15);
        return view('Admin.kategori', compact('categories'));
    }

    //  create kategori
    public function create_kategori(Request $request)
    {
        $validated = $request->validate([
            'kategori' => 'required|min:4'
        ]); 

        $categories = new KategoriBuku([
            'kategori' => $request->kategori
        ]);
        $categories->save();

        return redirect()->back()->with('success','Berhasil menambahkan kategori baru!');
    }

    public function edit_kategori(Request $request, $id)
    {
        $edit = KategoriBuku::findOrFail($id);
        
        if($edit){
            $edit->kategori = $request->kategori;
            $edit->save();
            return redirect()->back()->with('success','Kategori diperbaharui');
        }else{
            return redirect()->back()->with('error','Kategori tidak ditemukan');
        }
    }

    public function delete_kategori($id){
        $categories = KategoriBuku::findOrFail($id);

        if(!$categories){
            return redirect()->back()->with('error','Tidak menemukan Kategori!');
        }

        $categories->delete();
        return redirect()->back()->with('success','Berhasil menghapus Kategori');
    }
}
