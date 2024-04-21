@extends('layouts.template_admin')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <h5 class="card-header">{{ $title }}</h5>

                <div class="card-body">
                    <a href="{{ route('petugas.create') }}" class="btn btn-primary btn-sm mb-4">Tambah Data</a>
                    <div class="table-responsive">
                        <table class="table  table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Akses</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($petugas as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->phone }}</td>
                                        <td>{{ $item->akses }}</td>
                                        <td>
                                            {!! Form::open([
                                                'route' => ['petugas.destroy', $item->id],
                                                'method' => 'DELETE',
                                                'onsubmit' => 'return confirm("Apakah anda yakin ingin menghapus data ini?")',
                                            ]) !!}
                                            <a href="{{ route('petugas.edit', $item->id) }}"
                                                class="btn btn-success btn-sm"><i class="fa fa-edit"> </i></a>
                                            {{-- {!! Form::submit('Hapus', ['class' => 'btn btn-danger btn-sm']) !!} --}}
                                            <button type="submit" class="btn btn-danger btn-sm"> <i class="fa fa-trash">
                                                </i></button>
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                    @empty($item)
                                        <tr>
                                            <td colspan="5">Data petugas tidak ditemukan</td>
                                        </tr>
                                    @endempty
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {!! $petugas->links() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
