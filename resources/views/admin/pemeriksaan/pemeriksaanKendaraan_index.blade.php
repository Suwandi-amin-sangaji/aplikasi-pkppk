@extends('layouts.template_admin')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <h5 class="card-header">Data Pemeriksaan Kendaraan Oleh Petugas</h5>

                <div class="card-body">
                    <div class="d-flex justify-content-between mb-4">
                        {!! Form::open(['method' => 'GET', 'class' => 'd-flex']) !!}
                        {!! Form::text('search', request('search'), ['class' => 'form-control mr-2', 'placeholder' => 'Search...']) !!}
                        {!! Form::date('start_date', request('start_date'), ['class' => 'form-control mr-2']) !!}
                        {!! Form::date('end_date', request('end_date'), ['class' => 'form-control mr-2']) !!}
                        <button type="submit" class="btn btn-primary btn-sm mr-2">Search</button>
                        {!! Form::close() !!}
                        <div>
                            <a href="{{ route($routeCetakKendaraan, array_merge(request()->all(), ['format' => 'pdf'])) }}"
                                class="btn btn-danger btn-sm mr-2">Print PDF</a>
                            <a href="{{ route('export-pemeriksaan-kendaraan', array_merge(request()->all(), ['format' => 'excel'])) }}"
                                class="btn btn-success btn-sm">Print Excel</a>
                        </div>
                    </div>


                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Operator</th>
                                    <th>Asisten</th>
                                    <th>Waktu</th>
                                    <th>Hari/Tanggal</th>
                                    <th>Jenis Kendaraan</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pemeriksaan as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->nama_operator }}</td>
                                        <td>{{ $item->nama_asisten }}</td>
                                        <td>{{ $item->waktu }}</td>
                                        <td>{{ $item->tanggal }}</td>
                                        <td>{{ $item->kendaraan->jenis }}</td>
                                        <td>
                                            @if ($item->status == 'baru')
                                                <span class="badge bg-label-warning me-1">{{ $item->status }}</span>
                                                {!! Form::open([
                                                    'route' => ['pemeriksaan-kendaraan-admin.verifikasi', $item->id],
                                                    'method' => 'POST',
                                                    'style' => 'display:inline',
                                                ]) !!}
                                                <button type="submit" class="btn btn-primary btn-sm"><i
                                                        class="fa fa-check"></i></button>
                                                {!! Form::close() !!}
                                            @else
                                                <span class="badge bg-label-success me-1">{{ $item->status }}</span>
                                            @endif
                                        </td>

                                        <td>
                                            {!! Form::open([
                                                'route' => ['pemeriksaan-kendaraan-admin.destroy', $item->id],
                                                'method' => 'DELETE',
                                                'onsubmit' => 'return confirm("Apakah anda yakin ingin menghapus data ini?")',
                                            ]) !!}
                                            <a href="{{ route('pemeriksaan-kendaraan-admin.show', $item->id) }}"
                                                class="btn btn-secondary btn-sm"><i class="fa fa-eye"> </i></a>

                                            <a href="{{ route('pemeriksaan-kendaraan-admin.edit', $item->id) }}"
                                                class="btn btn-warning btn-sm"><i class="fa fa-edit"> </i></a>

                                            <button type="submit" class="btn btn-danger btn-sm"> <i class="fa fa-trash">
                                                </i></button>
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
                    {!! $pemeriksaan->links() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
