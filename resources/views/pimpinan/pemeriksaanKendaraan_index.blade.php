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
                                    <th>Jenis Kendaraan</th>
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
                                        <td>{{ $item->kendaraan->jenis }}</td>
                                        <td>{{ $item->nama_operator }}</td>
                                        <td>{{ $item->nama_asisten }}</td>
                                        <td>{{ $item->waktu }}</td>
                                        <td>{{ $item->tanggal }}</td>
                                        <td>
                                            @if ($item->status == 'baru')
                                                <span class="badge bg-label-warning me-1">{{ $item->status }}</span>
                                                <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#signatureModal{{ $item->id }}">
                                                    <i class="fa fa-pencil"></i> Tanda Tangan
                                                </button>

                                                <!-- Signature Modal -->
                                                <div class="modal fade" id="signatureModal{{ $item->id }}"
                                                    tabindex="-1" aria-labelledby="signatureModalLabel{{ $item->id }}"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title"
                                                                    id="signatureModalLabel{{ $item->id }}">Tanda
                                                                    Tangan Pemeriksaan</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                {!! Form::open([
                                                                    'route' => ['pemeriksaan-kendaraan-pimpinan.sign', $item->id],
                                                                    'method' => 'POST',
                                                                    'files' => true,
                                                                ]) !!}
                                                                <div class="mb-3">
                                                                    {!! Form::label('signature', 'Tanda Tangan') !!}
                                                                    {!! Form::file('signature', ['class' => 'form-control']) !!}
                                                                </div>
                                                                <button type="submit" class="btn btn-primary">Simpan Tanda
                                                                    Tangan</button>
                                                                {!! Form::close() !!}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @elseif ($item->status == 'ditandatangani')
                                                <span class="badge bg-label-info me-1">{{ $item->status }}</span>
                                                {!! Form::open([
                                                    'route' => ['pemeriksaan-kendaraan-pimpinan.verifikasi', $item->id],
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
                                            <a href="{{ route('pemeriksaan-kendaraan-pimpinan.show', $item->id) }}"
                                                class="btn btn-secondary btn-sm"><i class="fa fa-eye"> </i></a>
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
