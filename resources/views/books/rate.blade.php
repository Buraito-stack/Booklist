<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rate a Book</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-900">
    <nav class="bg-white shadow-md py-4 px-6">
        <div class="container mx-auto flex justify-between items-center">
            <a href="#" class="text-xl font-bold text-blue-600">Library</a>
            <ul class="flex space-x-6">
                <li><a href="{{ route('books.index') }}" class="hover:text-blue-500">Book List</a></li>
                <li><a href="{{ route('top-authors') }}" class="hover:text-blue-500">List of Authors</a></li>
                <li><a href="{{ route('books.rate') }}" class="hover:text-blue-500">Rate a Book</a></li>
            </ul>
        </div>
    </nav>

    <div class="container mx-auto mt-10 p-6 bg-white shadow-lg rounded-lg">
        <h1 class="text-2xl font-bold text-center mb-6">Rate a Book</h1>
        @if ($authors->isEmpty())
            <p class="text-center text-gray-500">No authors found.</p>
        @else
            <form action="{{ route('books.rate') }}" method="GET" class="mb-6">
                <div class="mb-4">
                    <label for="author" class="block text-sm font-medium text-gray-700">Select Author</label>
                    <select id="author" class="w-full mt-1 p-2 border rounded-lg focus:ring focus:ring-blue-300" name="author_id" required>
                        <option value="">Select an author</option>
                        @foreach ($authors as $author)
                            <option value="{{ $author->id }}" {{ request('author_id') == $author->id ? 'selected' : '' }}>
                                {{ $author->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-500">Filter Books</button>
            </form>

            <form action="{{ route('books.storeRating') }}" method="POST" class="mt-4">
                @csrf
                <div class="mb-4">
                    <label for="book" class="block text-sm font-medium text-gray-700">Select Book</label>
                    <select id="book" class="w-full mt-1 p-2 border rounded-lg focus:ring focus:ring-blue-300" name="book_id" required>
                        <option value="">Select a book</option>
                        @foreach ($books as $book)
                            <option value="{{ $book->id }}">{{ $book->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label for="rating" class="block text-sm font-medium text-gray-700">Rating (1-10)</label>
                    <input type="number" id="rating" class="w-full mt-1 p-2 border rounded-lg focus:ring focus:ring-blue-300" name="rating" min="1" max="10" required>
                </div>
                <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-500">Submit Rating</button>
            </form>
        @endif
    </div>
</body>
</html>
