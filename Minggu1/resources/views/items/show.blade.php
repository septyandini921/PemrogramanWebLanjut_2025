<!DOCTYPE html>
<html>

<head>
    <title>Item List</title>
</head>

<body>
    <h1>Items</h1>

    @if (session('success')) <!-- kondisi jika sukses-->
        <p>{{ session('success') }}</p>
    @endif

    <a href="{{ route('items.create') }}">Add Item</a> <!-- direct ke halaman tambah item -->

    <ul>
        @foreach ($items as $item) <!-- loop menampilkan list-->
            <li>
                {{ $item->name }} -
                <a href="{{ route('items.edit', $item) }}">Edit</a> <!-- link direct ke halaman edit-->
                <form action="{{ route('items.destroy', $item) }}" method="POST" style="display:inline;">
                    @csrf <!-- token CSRF -->
                    @method('DELETE') <!-- method DELETE untuk menghapus item -->
                    <button type="submit">Delete</button> <!-- submit button -->
                </form>
            </li>
        @endforeach
    </ul>

</body>

</html>