<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of Authors</title>
</head>
<body>
    <h1>List of Authors</h1>
    <table border="1">
        <thead>
            <tr>
                <th>No</th>
                <th>Author Name</th>
                <th>Total Votes</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($authors as $index => $author)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $author->name }}</td>
                    <td>{{ $author->books->sum('voter') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
