<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {  
        return view('dashboard.home.index');
    }
    public function listTblUser()
    {
        $tbluser = DB::select("CALL getTbluserdata()");
        echo "<pre>";
        print_r($tbluser);
    }
    public function singleTblUser($id)
    {
    }
}
