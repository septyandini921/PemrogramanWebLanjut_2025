@extends('layouts.template')
 
 @section('content')
     <div class="card card-outline card-primary">
         <div class="card-header">
             <h3 class="card-title">Daftar Barang</h3>
             <div class="card-tools">
                 <a class="btn btn-sm btn-primary mt-1" href="{{ url('barang/create') }}">Tambah Barang</a>
             </div>
         </div>
         <div class="card-body">
             @if (session('success'))
                 <div class="alert alert-success">{{ session('success') }}</div>
             @endif
 
             @if (session('error'))
                 <div class="alert alert-danger">{{ session('error') }}</div>
             @endif
 
             <table class="table table-bordered table-striped table-hover table-sm" id="table_barang">
                 <thead>
                     <tr>
                         <th>No</th>
                         <th>Kode Barang</th>
                         <th>Nama Barang</th>
                         <th>Harga Beli</th>
                         <th>Harga Jual</th>
                         <th>Aksi</th>
                     </tr>
                 </thead>
             </table>
         </div>
     </div>
 @endsection
 
 @push('js')
 <script>
     $(document).ready(function () {
     $('#table_barang').DataTable({
         processing: true,
         serverSide: true,
         ajax: {
             url: "{{ route('barang.list') }}", // Pastikan route ini benar
             type: "POST", // HARUS POST sesuai dengan route yang terdaftar
             headers: {
                 'X-CSRF-TOKEN': '{{ csrf_token() }}' // Kirim CSRF token
             }
         },
         columns: [
             { data: 'barang_id', name: 'barang_id' },
             { data: 'barang_kode', name: 'barang_kode' },
             { data: 'barang_nama', name: 'barang_nama' },
             { data: 'harga_beli', name: 'harga_beli' },
             { data: 'harga_jual', name: 'harga_jual' },
             { data: 'aksi', name: 'aksi', orderable: false, searchable: false }
         ]
     });
 });
 </script>
 @endpush