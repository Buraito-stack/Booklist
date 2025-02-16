<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of Authors</title>
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
        <h1 class="text-2xl font-bold text-center mb-6">List of Authors</h1>
        <div class="overflow-x-auto">
            <table class="w-full border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="border border-gray-300 px-4 py-2">No</th>
                        <th class="border border-gray-300 px-4 py-2">Author Name</th>
                        <th class="border border-gray-300 px-4 py-2">Total Votes</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($authors as $index => $author)
                        <tr class="hover:bg-gray-100">
                            <td class="border border-gray-300 px-4 py-2 text-center">{{ $index + 1 }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $author->name }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-center">{{ $author->books->sum('voter') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
