<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index() {
        return 'Selamat Datang';
    }

    public function about() {
        return '2341760087 Nimas Septiandini'; 
    }

    public function articles($id) {
        return 'Halaman artiker dengan ID ' . $id;
    }
}
