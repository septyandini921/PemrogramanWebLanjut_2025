<!DOCTYPE html> 
<html lang="en"> 
<head>
    <title>Add Items</title> 
</head>
<body>
    <h1>Add Item</h1> 

    <!-- Membuat form dengan method POST  -->
    <form action="{{ route('items.store') }}" method="POST">
        @csrf <!--  token CSRF  -->
        
        <!-- Label untuk input nama item -->
        <label for="name">Name:</label>
        
        <!-- Input teks untuk nama item yang wajib diisi -->
        <input type="text" name="name" required>
        <br>

        <label for="description">Description</label>
        
        <!-- deskripsi item yang wajib diisi -->
        <textarea name="description" required></textarea>
        <br>

        <!-- submit form -->
        <button type="submit">Add Item</button>
    </form>

    <!-- kembali ke halaman index -->
    <a href="{{ route('items.index') }}">Back to List</a>

</body>
</html>