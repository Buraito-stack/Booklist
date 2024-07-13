<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $list = $request->input('list', 10); 
        $search = $request->input('search');
    
        $booksQuery = Book::query();
    
        // Search
        if ($search) {
            $booksQuery->where('name', 'like', '%' . $search . '%')
                       ->orWhereHas('author', function ($query) use ($search) {
                           $query->where('name', 'like', '%' . $search . '%');
                       });
        }
    
        // Paginate
        $books = $booksQuery->orderBy('average_rating', 'desc')
                            ->paginate($list);
    
        return view('books.index', compact('books'));
    }
    
    public function rate()
    {
        $authors = Author::with('books')->get();
        return view('books.rate', compact('authors'));
    }

    public function storeRating(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'rating' => 'required|integer|min:1|max:10',
        ]);

        $book = Book::find($request->book_id);
        $book->voter += 1;
        $book->average_rating = ($book->average_rating * ($book->voter - 1) + $request->rating) / $book->voter;
        $book->save();

        return redirect()->route('books.index');
    }
}
