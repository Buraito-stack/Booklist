<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book List</title>
</head>
<body>
    <h1>Book List</h1>
    <form method="GET" action="{{ route('books.index') }}">
        <label for="list">List shown:</label>
        <select name="list" id="list">
            @for ($i = 10; $i <= 100; $i += 10)
                <option value="{{ $i }}">{{ $i }}</option>
            @endfor
        </select>
        <label for="search">Search:</label>
        <input type="text" name="search" id="search" value="{{ request('search') }}">
        <button type="submit">Submit</button>
    </form>
    <table border="1">
        <thead>
            <tr>
                <th>No</th>
                <th>Book Name</th>
                <th>Category Name</th>
                <th>Author Name</th>
                <th>Average Rating</th>
                <th>Voter</th>
            </tr>
            <tbody>
            @forelse($books as $book)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $book->name }}</td>
                    <td>{{ $book->category->name }}</td>
                    <td>{{ $book->author->name }}</td>
                    <td>{{ $book->average_rating }}</td>
                    <td>{{ $book->voter }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">No books found</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    {{ $books->appends(request()->query())->links('pagination::bootstrap-4') }}
</body>
</html>
