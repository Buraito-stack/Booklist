<?php
namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AuthorController extends Controller
{
    public function index()
    {
        try {
            $authors = Author::all();

            return view('authors.index', compact('authors'));
        } catch (\Exception $e) {
            // Log pesan kesalahan dengan detail
            Log::error('Error fetching authors: ' . $e->getMessage());
            
            // Kembalikan response dengan pesan kesalahan yang sesuai
            return back()->withErrors('There was an error fetching the authors. Please try again later.');
        }
    }
}
