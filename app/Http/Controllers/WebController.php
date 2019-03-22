<?php

namespace App\Http\Controllers;

use App\Exports\FbExport;
use Maatwebsite\Excel\Facades\Excel;



class WebController extends Controller
{


    function index(){
        return view('index');
    }

    public function export()
    {
        return Excel::download(new FbExport, 'users.xlsx');
    }
}
