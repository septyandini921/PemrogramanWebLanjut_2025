<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LevelModel;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class LevelController extends Controller
{
    // Menampilkan halaman daftar level
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Level',
            'list' => ['Home', 'Level']
        ];

        $page = (object) [
            'title' => 'Daftar Level yang tersedia dalam sistem'
        ];

        $activeMenu = 'level'; // Set menu yang sedang aktif
        
        $level = LevelModel::all();

        return view('level.index', compact('breadcrumb', 'level', 'page', 'activeMenu'));
    }

    public function getLevels(Request $request)
    {
        if ($request->ajax()) {
            $data = LevelModel::select('level_id', 'level_kode', 'level_name');

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('aksi', function ($level) {
                    $btn = '<button onclick="modalAction(\''.url('/level/'.$level->level_id.'/show_ajax').'\')" class="btn btn-info btn-sm">Detail</button>';
                    $btn .= '<button onclick="modalAction(\''.url('/level/'.$level->level_id.'/edit_ajax').'\')" class="btn btn-warning btn-sm">Edit</button>';
                    $btn .= '<button onclick="modalAction(\''.url('/level/'.$level->level_id.'/delete_ajax').'\')" class="btn btn-danger btn-sm">Hapus</button>';

                    return $btn;
                })
                ->rawColumns(['aksi']) // Pastikan kolom aksi diproses sebagai HTML
                ->make(true);
        }
    }



    // Menampilkan halaman tambah level
    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah Level',
            'list' => ['Home', 'Level', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Tambah Level Baru'
        ];

        $activeMenu = 'level';

        return view('level.create', compact('breadcrumb', 'page', 'activeMenu'));
    }

    // Menyimpan data level baru
    public function store(Request $request)
    {
        $request->validate([
            'level_kode' => 'required|string|unique:m_level,level_kode',
            'level_name' => 'required|string'
        ]);

        LevelModel::create([
            'level_kode' => $request->level_kode,
            'level_name' => $request->level_name
        ]);

        return redirect('/level')->with('success', 'Data Level berhasil ditambahkan');
    }

    // Menampilkan halaman edit level
    public function edit($id)
    {
        $level = LevelModel::findOrFail($id);

        $breadcrumb = (object) [
            'title' => 'Edit Level',
            'list' => ['Home', 'Level', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit Data Level'
        ];

        $activeMenu = 'level';

        return view('level.edit', compact('breadcrumb', 'page', 'level', 'activeMenu'));
    }

    // Menyimpan perubahan data level
    public function update(Request $request, $id)
    {
        $request->validate([
            'level_kode' => 'required|string|unique:m_level,level_kode,' . $id . ',level_id',
            'level_name' => 'required|string'
        ]);

        $level = LevelModel::findOrFail($id);
        $level->update([
            'level_kode' => $request->level_kode,
            'level_name' => $request->level_name
        ]);

        return redirect('/level')->with('success', 'Data Level berhasil diperbarui');
    }

    // Menghapus data level
    public function destroy($id)
    {
        $level = LevelModel::find($id);

        if (!$level) {
            return redirect('/level')->with('error', 'Data Level tidak ditemukan');
        }

        try {
            $level->delete();
            return redirect('/level')->with('success', 'Data Level berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('/level')->with('error', 'Data Level gagal dihapus karena masih terkait dengan data lain');
        }
    }

    public function show($id)
    {
    $level = LevelModel::findOrFail($id);

    $breadcrumb = (object) [
        'title' => 'Detail Level',
        'list' => ['Home', 'Level', 'Detail']
    ];

    $page = (object) [
        'title' => 'Detail Level'
    ];

    $activeMenu = 'level';

    return view('level.show', compact('breadcrumb', 'page', 'level', 'activeMenu'));
    }

    public function create_ajax()
    {
        return view('level.create_ajax'); // Menampilkan view untuk form tambah level via AJAX
    }

    public function store_ajax(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'level_kode' => 'required|string|min:3|unique:m_level,level_kode',
                'level_name' => 'required|string|max:100',
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi Gagal',
                    'errors' => $validator->errors(),
                ], 422);
            }

            LevelModel::create([
                'level_kode' => $request->level_kode,
                'level_name' => $request->level_name,
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Data level berhasil disimpan'
            ]);
        }

        return response()->json(['status' => false, 'message' => 'Invalid request'], 400);
    }

    public function edit_ajax(string $id)
    {
        $level = LevelModel::find($id);

        if (!$level) {
            return response()->json(['status' => false, 'message' => 'Data tidak ditemukan'], 404);
        }

        return view('level.edit_ajax', ['level' => $level]);
    }

    public function update_ajax(Request $request, $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'level_kode' => 'required|max:10|unique:m_level,level_kode,' . $id . ',level_id',
                'level_name' => 'required|max:100'
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi gagal.',
                    'msgField' => $validator->errors()
                ]);
            }

            $level = LevelModel::find($id);

            if ($level) {
                $level->update($request->all());
                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil diperbarui'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data tidak ditemukan'
                ]);
            }
        }

        return redirect('/');
    }

    public function delete_ajax(Request $request, $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $level = LevelModel::find($id);

            if ($level) {
                $level->delete();

                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil dihapus'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data tidak ditemukan'
                ]);
            }
        }

        return redirect('/');
    }

    public function confirm_ajax(string $id)
    {
        $level = LevelModel::find($id);

        if (!$level) {
            return response()->json(['status' => false, 'message' => 'Data tidak ditemukan'], 404);
        }

        return view('level.confirm_ajax', ['level' => $level]);
    }




}

