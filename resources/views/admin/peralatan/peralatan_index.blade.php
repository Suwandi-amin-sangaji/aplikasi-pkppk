@extends('layouts.template_admin')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <h5 class="card-header">Data Peralatan</h5>

                <div class="card-body">
                    <div class="d-flex justify-content-between mb-4">
                        <a href="{{ route('peralatan.create') }}" class="btn btn-primary">Tambah Data</a>
                        {!! Form::open(['method' => 'GET', 'class' => 'd-flex']) !!}
                            {!! Form::text('search', request('search'), ['class' => 'form-control mr-2', 'placeholder' => 'Search...']) !!}
                            <button type="submit" class="btn btn-primary btn-sm">Search</button>
                        {!! Form::close() !!}
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Compartment</th>
                                    <th>Nama Item</th>
                                    <th>Jumlah</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($peralatan as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->compartment->name }}</td>
                                        <td>{{ $item->item }}</td>
                                        <td>{{ $item->jumlah }}</td>

                                        <td>
                                            {!! Form::open([
                                                'route' => ['peralatan.destroy', $item->id], // Perbaikan disini
                                                'method' => 'DELETE',
                                                'onsubmit' => 'return confirm("Apakah anda yakin ingin menghapus data ini?")',
                                            ]) !!}
                                            <a href="{{ route('peralatan.edit', $item->id) }}"
                                                class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>
                                            <!-- Perbaikan disini -->

                                            <button type="submit" class="btn btn-danger btn-sm"><i
                                                    class="fa fa-trash"></i></button>
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach

                                @if ($peralatan->isEmpty())
                                    <!-- Menggunakan isEmpty() untuk mengecek apakah koleksi kosong -->
                                    <tr>
                                        <td colspan="5">Data komponen peralatan tidak ditemukan</td>
                                    </tr>
                                @endif

                            </tbody>
                        </table>
                    </div>
                    <div class="mt-3 text-right">
                        {!! $peralatan->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
