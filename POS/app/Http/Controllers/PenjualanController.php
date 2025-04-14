<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use Illuminate\Http\Request;



class PenjualanController extends Controller
{
    public function index()
    {
        return view('penjualan.index');
    }

    public function getPenjualan(Request $request)
    {
        $penjualan = Penjualan::query();
        
        return datatables()->of($penjualan)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $btn = '<a href="'.route('penjualan.show', $row->penjualan_id).'" class="btn btn-info btn-sm">View</a>';
                $btn .= '<a href="'.route('penjualan.edit', $row->penjualan_id).'" class="btn btn-warning btn-sm mx-2">Edit</a>';
                $btn .= '<form action="'.route('penjualan.destroy', $row->penjualan_id).'" method="POST" style="display:inline">
                            '.csrf_field().'
                            '.method_field('DELETE').'
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                          </form>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function create()
    {
        return view('penjualan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'pembeli' => 'required',
            'penjualan_kode' => 'required|unique:t_penjualan',
            'penjualan_tanggal' => 'required|date',
        ]);

        Penjualan::create($request->all());

        return redirect()->route('penjualan.index')
                         ->with('success', 'Transaksi penjualan berhasil ditambahkan');
    }

    // Method lainnya (show, edit, update, destroy) bisa diimplementasikan sesuai kebutuhan
}