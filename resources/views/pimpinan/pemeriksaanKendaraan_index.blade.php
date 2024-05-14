@extends('layouts.template_pimpinan')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <h5 class="card-header">Verifikasi Pemeriksaan Kendaraan Oleh Petugas</h5>

                <div class="card-body">
                    {{-- buat serach Data --}}
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Operator</th>
                                    <th>Asisten</th>
                                    <th>Waktu</th>
                                    <th>Tanggal</th>
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
                                        <td>
                                            @if ($item->status == 'baru')
                                                <span class="badge bg-label-warning me-1">{{ $item->status }}</span>
                                                {!! Form::open(['route' => ['pemeriksaan-kendaraan-pimpinan.verifikasi', $item->id], 'method' => 'POST', 'style' => 'display:inline']) !!}
                                                    <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-check"></i></button>
                                                {!! Form::close() !!}
                                            @else
                                                <span class="badge bg-label-success me-1">{{ $item->status }}</span>
                                            @endif
                                        </td>

                                        <td>
                                            {{-- {!! Form::open([
                                                'route' => ['pemeriksaan-kendaraan-pimpinan.destroy', $item->id],
                                                'method' => 'DELETE',
                                                'onsubmit' => 'return confirm("Apakah anda yakin ingin menghapus data ini?")',
                                            ]) !!} --}}
                                            <a href="{{ route('pemeriksaan-kendaraan-pimpinan.show', $item->id) }}"
                                                class="btn btn-secondary btn-sm"><i class="fa fa-eye"> </i></a>

                                                {{-- <a href="{{ route('pemeriksaan-kendaraan-pimpinan.edit', $item->id) }}"
                                                    class="btn btn-warning btn-sm"><i class="fa fa-edit"> </i></a> --}}

                                            {{-- <button type="submit" class="btn btn-danger btn-sm"> <i class="fa fa-trash">
                                                </i></button> --}}
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
                    {!! $pemeriksaan->links() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
