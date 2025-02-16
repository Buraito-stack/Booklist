<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book List</title>
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
        <h1 class="text-2xl font-bold text-center mb-6">Book List</h1>
        <form method="GET" action="{{ route('books.index') }}" class="mb-6 flex flex-col md:flex-row md:space-x-4">
            <div class="flex-1">
                <label for="list" class="block text-sm font-medium text-gray-700">List shown</label>
                <select name="list" id="list" class="w-full mt-1 p-2 border rounded-lg focus:ring focus:ring-blue-300">
                    @for ($i = 10; $i <= 100; $i += 10)
                        <option value="{{ $i }}"{{ request('list') == $i ? ' selected' : '' }}>{{ $i }}</option>
                    @endfor
                </select>
            </div>
            <div class="flex-1">
                <label for="search" class="block text-sm font-medium text-gray-700">Search</label>
                <input type="text" name="search" id="search" class="w-full mt-1 p-2 border rounded-lg focus:ring focus:ring-blue-300" value="{{ request('search') }}" placeholder="Search...">
            </div>
            <div class="flex items-end">
                <button type="submit" class="mt-6 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-500">Submit</button>
            </div>
        </form>

        <div class="overflow-x-auto">
            <table class="w-full border-collapse border rounded-lg shadow-sm">
                <thead class="bg-blue-600 text-white">
                    <tr>
                        <th class="py-3 px-4">No</th>
                        <th class="py-3 px-4">Book Name</th>
                        <th class="py-3 px-4">Category Name</th>
                        <th class="py-3 px-4">Author Name</th>
                        <th class="py-3 px-4">Average Rating</th>
                        <th class="py-3 px-4">Voter</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($books as $book)
                        <tr class="border-b hover:bg-gray-100">
                            <td class="py-3 px-4 text-center">{{ $loop->iteration }}</td>
                            <td class="py-3 px-4">{{ $book->name }}</td>
                            <td class="py-3 px-4">{{ $book->category->name }}</td>
                            <td class="py-3 px-4">{{ $book->author->name }}</td>
                            <td class="py-3 px-4 text-center">{{ $book->average_rating }}</td>
                            <td class="py-3 px-4 text-center">{{ $book->voter }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-4 text-center text-gray-500">No books found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-6 flex justify-center">
            {{ $books->appends(request()->query())->links() }}
        </div>
    </div>
</body>
</html>
