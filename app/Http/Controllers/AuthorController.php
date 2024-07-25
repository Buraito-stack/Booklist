<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index()
    {
        // Mengambil top authors berdasarkan jumlah buku
        $authors = Author::withCount('books') // Mengambil jumlah buku untuk setiap author
                          ->orderBy('books_count', 'desc') // Mengurutkan berdasarkan jumlah buku
                          ->take(10) // Ambil 10 top authors
                          ->get();

        return view('authors.index', compact('authors'));
    }
}
