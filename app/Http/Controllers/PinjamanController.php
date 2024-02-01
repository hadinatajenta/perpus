<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class PinjamanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function halaman_pinjaman():View
    {
        return view('Admin.peminjaman');
    }
}
