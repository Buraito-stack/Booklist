<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book List</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Book List</h1>
        <form method="GET" action="{{ route('books.index') }}" class="mb-4">
            <div class="form-row align-items-center">
                <div class="col-auto">
                    <label for="list" class="sr-only">List shown</label>
                    <select name="list" id="list" class="form-control mb-2">
                        @for ($i = 10; $i <= 100; $i += 10)
                            <option value="{{ $i }}"{{ request('list') == $i ? ' selected' : '' }}>{{ $i }}</option>
                        @endfor
                    </select>
                </div>
                <div class="col-auto">
                    <label for="search" class="sr-only">Search</label>
                    <input type="text" name="search" id="search" class="form-control mb-2" value="{{ request('search') }}" placeholder="Search...">
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary mb-2">Submit</button>
                </div>
            </div>
        </form>
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>No</th>
                    <th>Book Name</th>
                    <th>Category Name</th>
                    <th>Author Name</th>
                    <th>Average Rating</th>
                    <th>Voter</th>
                </tr>
            </thead>
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
                    <td colspan="6" class="text-center">No books found</td>
                </tr>
            @endforelse
            </tbody>
        </table>
        <div class="pagination justify-content-center">
            {{ $books->appends(request()->query())->links('pagination::bootstrap-4') }}
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
