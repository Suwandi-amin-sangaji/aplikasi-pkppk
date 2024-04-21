@extends('layouts.template_admin')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <h5 class="card-header">{{ $title }}</h5>

                <div class="card-body">
                    <a href="{{ route('kendaraan.create') }}" class="btn btn-primary btn-sm mb-4">Tambah Data</a>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Jenis Kendaraan</th>
                                    <th>Plat Nomor</th>
                                    <th>Merek</th>
                                    <th>Jumlah</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kendaraan as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->jenis }}</td>
                                        <td>{{ $item->plat }}</td>
                                        <td>{{ $item->merk }}</td>
                                        <td>{{ $item->jumlah }}</td>
                                        <td>
                                            {!! Form::open([
                                                'route' => ['kendaraan.destroy', $item->id],
                                                'method' => 'DELETE',
                                                'onsubmit' => 'return confirm("Apakah anda yakin ingin menghapus data ini?")',
                                            ]) !!}
                                            <a href="{{ route('kendaraan.edit', $item->id) }}"
                                                class="btn btn-success btn-sm"><i class="fa fa-edit"> </i></a>

                                            <button type="submit" class="btn btn-danger btn-sm"> <i class="fa fa-trash">
                                                </i></button>
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                    @empty($item)
                                        <tr>
                                            <td colspan="5">Data Kendaraan tidak ditemukan</td>
                                        </tr>
                                    @endempty
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {!! $kendaraan->links() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
