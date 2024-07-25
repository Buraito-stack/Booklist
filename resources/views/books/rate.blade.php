<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rate a Book</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container {
            margin-top: 20px;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Library</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('books.index') }}">Book List</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('top-authors') }}">List of Authors</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('books.rate') }}">Rate a Book</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container">
        <h1 class="text-center mb-4">Rate a Book</h1>
        @if ($authors->isEmpty())
            <p class="text-center">No authors found.</p>
        @else
            <form action="{{ route('books.rate') }}" method="GET">
                <div class="form-group">
                    <label for="author">Select Author</label>
                    <select id="author" class="form-control" name="author_id" required>
                        <option value="">Select an author</option>
                        @foreach ($authors as $author)
                            <option value="{{ $author->id }}" {{ request('author_id') == $author->id ? 'selected' : '' }}>
                                {{ $author->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Filter Books</button>
            </form>

            <form action="{{ route('books.storeRating') }}" method="POST" class="mt-4">
                @csrf
                <div class="form-group">
                    <label for="book">Select Book</label>
                    <select id="book" class="form-control" name="book_id" required>
                        <option value="">Select a book</option>
                        @foreach ($books as $book)
                            <option value="{{ $book->id }}">{{ $book->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="rating">Rating (1-10)</label>
                    <input type="number" id="rating" class="form-control" name="rating" min="1" max="10" required>
                </div>
                <button type="submit" class="btn btn-primary">Submit Rating</button>
            </form>
        @endif
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
