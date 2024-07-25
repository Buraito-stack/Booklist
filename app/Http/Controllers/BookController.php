<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BookController extends Controller
{
    /**
     * Display a listing of books with optional search and pagination.
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $list = $request->input('list', 10);
        $search = $request->input('search');

        $booksQuery = Book::query();

        // Apply search filters
        if ($search) {
            $booksQuery->where('name', 'like', '%' . $search . '%')
                       ->orWhereHas('author', function ($query) use ($search) {
                           $query->where('name', 'like', '%' . $search . '%');
                       });
        }

        // Apply pagination and sorting
        $books = $booksQuery->orderBy('average_rating', 'desc')
                            ->paginate($list);

        // Log for debugging
        Log::info('Books index view rendered', ['book_count' => $books->count()]);

        return view('books.index', compact('books'));
    }

    /**
     * Show the form for rating a book.
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function rate(Request $request)
    {
        $authors = Author::all();
        
        // Filter books based on selected author
        $booksQuery = Book::query();
        if ($request->has('author_id') && $request->input('author_id') != '') {
            $booksQuery->where('author_id', $request->input('author_id'));
        }

        $books = $booksQuery->get();

        // Log for debugging
        Log::info('Rate book view rendered', ['author_count' => $authors->count(), 'book_count' => $books->count()]);

        return view('books.rate', compact('authors', 'books'));
    }

    /**
     * Store a newly created rating for a book.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeRating(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'rating' => 'required|integer|min:1|max:10',
        ]);

        $book = Book::find($request->book_id);

        // Update the book's average rating
        $totalRatings = $book->ratings->count();
        $sumRatings = $book->ratings->sum('rating');
        $newAverageRating = ($sumRatings + $request->rating) / ($totalRatings + 1);

        $book->average_rating = $newAverageRating;
        $book->save();

        // Log for debugging
        Log::info('Book rating stored', [
            'book_id' => $book->id,
            'new_rating' => $newAverageRating,
        ]);

        return redirect()->route('books.index')->with('success', 'Rating successfully added.');
    }
}
