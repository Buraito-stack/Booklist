<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rate a Book</title>
</head>
<body>
    <h1>Rate a Book</h1>
    <form method="POST" action="{{ route('books.storeRating') }}">
        @csrf
        <label for="book_id">Book:</label>
        <select name="book_id" id="book_id">
            @foreach ($authors as $author)
                <optgroup label="{{ $author->name }}">
                    @foreach ($author->books as $book)
                        <option value="{{ $book->id }}">{{ $book->name }}</option>
                    @endforeach
                </optgroup>
            @endforeach
        </select>
        <label for="rating">Rating:</label>
        <select name="rating" id="rating">
            @for ($i = 1; $i <= 10; $i++)
                <option value="{{ $i }}">{{ $i }}</option>
            @endfor
        </select>
        <button type="submit">Submit</button>
    </form>
</body>
</html>
