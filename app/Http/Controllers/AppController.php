<?php

namespace App\Http\Controllers;

use App\Buku;
use Illuminate\Http\Request;

class AppController extends Controller
{
    public function index()
    {
        $data = [
            'book' => Buku::all()
        ];

        return view('front.pages.index', $data);
    }
}
