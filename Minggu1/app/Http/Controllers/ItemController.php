<?php
namespace App\Http\Controllers; //import kelas dan namespace
use App\Models\Item;            // Menggunakan model Item 
use Illuminate\Http\Request;    // class Request untuk menangani input form

class ItemController extends Controller // deklarasi class ItemController, extends Controller
{
    public function index() //show all item
    {
        $items = Item::all(); // Mengambil data dari tabel items
        return view('items.index', compact('items')); // Mengirim data ke view
    }

    public function create() //menampilkan form
    {
        return view('items.create'); // Mengembalikan halaman ke halaman form untuk membuat item baru
    }

    public function store(Request $request) //Menyimpan item baru ke DB
    {
        $request->validate([ // Validasi input untuk pengisian nama dan deskripsi, wajib diisi
            'name' => 'required', 
            'description' => 'required', 
        ]);

        // masuk ke atribut yang diizinkan
         Item::create($request->only(['name', 'description']));  // Menyimpan data ke tabel 'items' 
        return redirect()->route('items.index')->with('success', 'Item added successfully.'); // redirect ke halaman index dengan pesan sukses
    }

    public function show(Item $item) // Menampilkan detail item berdasarkan ID.
    {
        return view('items.show', compact('item'));  // Mengembalikan tampilan untuk menampilkan detail item
    }

    //  Menampilkan form untuk mengedit item.
    public function edit(Item $item)
    {
        return view('items.edit', compact('item')); // Mengembalikan tampilan untuk form edit item
    }

    // update data item ke database.
    public function update(Request $request, Item $item)
    {
        // Validasi input
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);
         
        // kondisi sehingga hanya bisa memasukkan atribut yang diizinkan
         $item->update($request->only(['name', 'description']));
        return redirect()->route('items.index')->with('success', 'Item updated successfully.'); 
    }

    public function destroy(Item $item)  // Delete item dari database.
    {

       $item->delete(); // Menghapus item dari database
       return redirect()->route('items.index')->with('success', 'Item deleted successfully.'); // Menghapus item dari database
    }
}