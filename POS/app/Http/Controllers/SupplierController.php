<?php

namespace App\Http\Controllers;

use App\Models\SupplierModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class SupplierController extends Controller
{
    // Menampilkan halaman daftar supplier
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Supplier',
            'list' => ['Home', 'Supplier']
        ];

        $page = (object) [
            'title' => 'Daftar Supplier yang tersedia dalam sistem'
        ];

        $activeMenu = 'supplier'; // Set menu yang sedang aktif
        
        $supplier = SupplierModel::all(); 
        return view('supplier.index', compact('breadcrumb', 'supplier', 'page', 'activeMenu'));

    }

    public function getSuppliers(Request $request) 
    {
        if ($request->ajax()) {
            $data = SupplierModel::select('supplier_id', 'supplier_nama', 'supplier_telepon', 'supplier_alamat');
    
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('aksi', function ($supplier) {
                    $btn = '<button onclick="modalAction(\''.url('/supplier/'.$supplier->supplier_id.'/show_ajax').'\')" class="btn btn-info btn-sm">Detail</button>';
                    $btn .= '<button onclick="modalAction(\''.url('/supplier/'.$supplier->supplier_id.'/edit_ajax').'\')" class="btn btn-warning btn-sm">Edit</button>';
                    $btn .= '<button onclick="modalAction(\''.url('/supplier/'.$supplier->supplier_id.'/delete_ajax').'\')" class="btn btn-danger btn-sm">Hapus</button>';
    
                    return $btn;
                })
                ->rawColumns(['aksi']) // Memastikan tombol HTML dieksekusi dengan benar
                ->make(true);
        }
    }
    


    // Menampilkan halaman tambah supplier
    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah Supplier',
            'list' => ['Home', 'Supplier', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Tambah Supplier Baru'
        ];

        $activeMenu = 'supplier';

        return view('supplier.create', compact('breadcrumb', 'page', 'activeMenu'));
    }

    // Menyimpan data supplier baru
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'supplier_kode' => 'required|string|unique:m_supplier,supplier_kode|max:50',
            'supplier_nama' => 'required|string|max:100',
            'supplier_alamat' => 'nullable|string',
            'supplier_telepon' => 'nullable|string|max:20',
        ]);
    
        SupplierModel::create($validatedData);
    
        return response()->json([
            'success' => true,
            'message' => 'Data Supplier berhasil ditambahkan'
        ]);
    }
    

    // Menampilkan halaman edit supplier
    public function edit($id)
    {
        $supplier = SupplierModel::findOrFail($id);

        $breadcrumb = (object) [
            'title' => 'Edit Supplier',
            'list' => ['Home', 'Supplier', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit Data Supplier'
        ];

        $activeMenu = 'supplier';

        return view('supplier.edit', compact('breadcrumb', 'page', 'supplier', 'activeMenu'));
    }

    // Menyimpan perubahan data supplier
    public function update(Request $request, $id)
    {
        $request->validate([
            'supplier_kode' => 'required|string|max:50|unique:m_supplier,supplier_kode,' . $id . ',supplier_id',
            'supplier_nama' => 'required|string|max:100',
            'supplier_alamat' => 'nullable|string',
            'supplier_telepon' => 'nullable|string|max:20',
        ]);

        $supplier = SupplierModel::findOrFail($id);
        $supplier->update([
            'supplier_kode' => $request->supplier_kode,
            'supplier_nama' => $request->supplier_nama,
            'supplier_alamat' => $request->supplier_alamat,
            'supplier_telepon' => $request->supplier_telepon,
        ]);

        return redirect('/supplier')->with('success', 'Data Supplier berhasil diperbarui');
    }

    // Menghapus data supplier
    public function destroy($id)
    {
        $supplier = SupplierModel::find($id);

        if (!$supplier) {
            return redirect('/supplier')->with('error', 'Data Supplier tidak ditemukan');
        }

        try {
            $supplier->delete();
            return redirect('/supplier')->with('success', 'Data Supplier berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('/supplier')->with('error', 'Data Supplier gagal dihapus karena masih terkait dengan data lain');
        }
    }

    // Menampilkan detail supplier
    public function show($id)
    {
        $supplier = SupplierModel::findOrFail($id);

        $breadcrumb = (object) [
            'title' => 'Detail Supplier',
            'list' => ['Home', 'Supplier', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail Supplier'
        ];

        $activeMenu = 'supplier';

        return view('supplier.show', compact('breadcrumb', 'page', 'supplier', 'activeMenu'));
    }

    public function create_ajax()
    {
        return view('supplier.create_ajax');
    }

    public function store_ajax(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'supplier_kode' => 'required|string|min:3|max:20|unique:m_supplier,supplier_kode',
            'supplier_nama' => 'required|min:3|max:100',
            'supplier_telepon' => 'required|min:10|max:15|regex:/^[0-9\-\+ ]*$/',
            'supplier_alamat' => 'required|min:5|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'msgField' => $validator->errors(),
                'message' => 'Validasi gagal'
            ], 422);
        }

        SupplierModel::create([
            'supplier_kode' => $request->supplier_kode,
            'supplier_nama' => $request->supplier_nama,
            'supplier_telepon' => $request->supplier_telepon,
            'supplier_alamat' => $request->supplier_alamat,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Supplier berhasil ditambahkan'
        ]);
    }


    public function edit_ajax($id)
    {
        $supplier = SupplierModel::find($id);
        return view('supplier.edit_ajax', ['supplier' => $supplier]);
    }

    public function update_ajax(Request $request, $id)
    {
        // Cari supplier berdasarkan ID
        $supplier = SupplierModel::find($id);
        if (!$supplier) {
            return response()->json(['status' => false, 'message' => 'Supplier tidak ditemukan']);
        }

        // Validasi input
        $validator = Validator::make($request->all(), [
            'supplier_kode' => 'required|string|max:50|unique:m_supplier,supplier_kode,' . $id . ',supplier_id',
            'supplier_nama' => 'required|string|max:100',
            'supplier_alamat' => 'nullable|string',
            'supplier_telepon' => 'nullable|string|max:20',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'msgField' => $validator->errors(),
                'message' => 'Validasi gagal. Periksa kembali input Anda.'
            ]);
        }

        try {
            // Update hanya kolom yang diizinkan
            $supplier->update($request->only(['supplier_kode', 'supplier_nama', 'supplier_alamat', 'supplier_telepon']));

            return response()->json([
                'status' => true,
                'message' => 'Data berhasil diperbarui'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Terjadi kesalahan saat update: ' . $e->getMessage()
            ]);
        }
    }


    public function delete_ajax($id)
    {
        $supplier = SupplierModel::find($id);

        if ($supplier) {
            $supplier->delete();
            return response()->json(['status' => true, 'message' => 'Data berhasil dihapus']);
        }

        return response()->json(['status' => false, 'message' => 'Data tidak ditemukan']);
    }

    public function confirm_ajax($id)
    {
        $supplier = SupplierModel::find($id);
        return view('supplier.confirm_ajax', ['supplier' => $supplier]);
    }
}