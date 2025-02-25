<!DOCTYPE html> 
<html> 
<head>
    <title>Item List</title> 
</head>
<body>
    <h1>Items</h1>
    
    @if(session('success'))<!-- Menampilka pesan sukses -->
        <p>{{ session('success') }}</p> <!-- Menampilkan pesan sukses yang disimpan di session -->
    @endif

    <!-- direct link ke halaman tambah item -->
    <a href="{{ route('items.create') }}">Add Item</a>

    <ul>
        <!-- loop menampilkan daftar -->
        @foreach ($items as $item)
            <li>
                <!-- Menampilkan nama item -->
                {{ $item->name }} - 
                <!-- Link untuk menuju halaman edit item berdasarkan ID item -->
                <a href="{{ route('items.edit', $item) }}">Edit</a>
                
                <!-- Form untuk menghapus item dengan metode DELETE -->
                <form action="{{ route('items.destroy', $item) }}" method="POST" style="display:inline;">
                    @csrf <!-- token CSRF  -->
                    @method('DELETE') <!-- method DELETE untuk menghapus item -->
                    <button type="submit">Delete</button> <!-- Tombol untuk menghapus item -->
                </form>
            </li>
        @endforeach
    </ul>

</body>
</html>