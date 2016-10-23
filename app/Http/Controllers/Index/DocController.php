<?php

namespace App\Http\Controllers\Index;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class DocController extends Controller
{
    public function getIndex()
    {
        return view('index.doc.index');
    }

    public function getLnmp7(){
        return view('index.doc.lnmp7');
    }
}
