<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LaporanmasukController extends Controller
{
    public function laporanmasuk(){
        return view('laporanmasuk.index');
    }
}
