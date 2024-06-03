@extends('layouts.template_admin')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <h5 class="card-header">{{ $title }}</h5>

                <div class="card-body">

                    <div class="d-flex justify-content-between mb-4">
                        <a href="{{ route('kegiatan.create') }}" class="btn btn-primary">Tambah Data</a>
                        {!! Form::open(['method' => 'GET', 'class' => 'd-flex']) !!}
                            {!! Form::text('search', request('search'), ['class' => 'form-control mr-2', 'placeholder' => 'Search...']) !!}
                            <button type="submit" class="btn btn-primary btn-sm">Search</button>
                        {!! Form::close() !!}
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="myTable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Komponen Kegiatan</th>
                                    <th>Jenis Kendaraan</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kegiatan as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->nama }}</td>
                                        <td>{{ $item->kendaraan->plat .' '. $item->kendaraan->jenis }}</td>
                                        <td>
                                            {!! Form::open([
                                                'route' => ['kegiatan.destroy', $item->id],
                                                'method' => 'DELETE',
                                                'onsubmit' => 'return confirm("Apakah anda yakin ingin menghapus data ini?")',
                                            ]) !!}
                                            <a href="{{ route('kegiatan.edit', $item->id) }}"
                                                class="btn btn-success btn-sm"><i class="fa fa-edit"> </i></a>

                                            <button type="submit" class="btn btn-danger btn-sm"> <i class="fa fa-trash">
                                                </i></button>
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                    @empty($item)
                                        <tr>
                                            <td colspan="5">Data komponen kegiatan tidak ditemukan</td>
                                        </tr>
                                    @endempty
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-3 text-right">
                        {!! $kegiatan->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
