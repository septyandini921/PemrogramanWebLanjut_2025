<!DOCTYPE html> 
<html> 
<head>
    <title>Item List</title> 
</head>
<body>
    <h1>Items</h1> 

    @if(session('success'))<!-- kondisi jika pesan sukses -->
        <p>{{ session('success') }}</p> <!-- kondisi jika success -->
    @endif

    <a href="{{ route('items.create') }}">Add Item</a> <!-- direct ke halaman tambah item -->

    <ul>
        @foreach ($items as $item) <!-- loop setiap item di variabel $items -->
            <li>
                {{ $item->name }} - <!-- Menampilkan nama item -->

                <a href="{{ route('items.edit', $item) }}">Edit</a> <!-- Link direct menuju halaman edit item -->

                <!-- Formulir hapus item, dengan metode POST dan DELETE -->
                <form action="{{ route('items.destroy', $item) }}" method="POST" style="display:inline;">
                    @csrf <!--  token CSRF -->
                    @method('DELETE') <!-- Method delete digunakan untuk menghapus item -->
                    <button type="submit">Delete</button> 
                </form>
            </li>
        @endforeach
    </ul>

</body>
</html>